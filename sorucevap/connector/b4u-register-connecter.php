<?php

/**
 * Class RegisterConnector
 * @author Ayse Akcan
 */
class RegisterConnector{
    /**
     * yeni bir user icin Question2Answer sitesinin user ı olusturulur.
     * @param $email : kullanıcı maili
     * @param $password : siteye giris icin gerekli parola
     * @param $handle : essiz olması gereken bir nickName
     * @param $ip  : kullanıcının ip si
     */
    public function createAccount($email,$password,$handle,$ip){
        require_once '../qa-config.php';
        require_once '../qa-include/qa-base.php';
        $level = 0;

        require_once QA_INCLUDE_DIR.'util/string.php';
        require_once QA_INCLUDE_DIR.'db/users.php';

        $salt=isset($password) ? qa_random_alphanum(16) : null;

        qa_db_query_sub(
            'INSERT INTO ^users (created, createip, email, passsalt, passcheck, level, handle, loggedin, loginip) '.
            'VALUES (NOW(), COALESCE(INET_ATON($), 0), $, $, UNHEX($), #, $, NOW(), COALESCE(INET_ATON($), 0))',
            $ip, $email, $salt, isset($password) ? qa_db_calc_passcheck($password, $salt) : null, (int)$level, $handle, $ip
        );
    }
    /**
     * varolan bir kullanıcıyı qa'dan siler.
     * @param $userid : qa_users tablosundaki userid verisi
     */
    public function deleteAccount($userid){
        require_once '../qa-include/qa-base.php';

        require_once QA_INCLUDE_DIR.'db/votes.php';
        require_once QA_INCLUDE_DIR.'db/users.php';
        require_once QA_INCLUDE_DIR.'db/post-update.php';
        require_once QA_INCLUDE_DIR.'db/points.php';
        require_once QA_INCLUDE_DIR.'app/users.php';

        $postids=qa_db_uservoteflag_user_get($userid); // posts this user has flagged or voted on, whose counts need updating

        qa_db_user_delete($userid);
        qa_db_uapprovecount_update();
        qa_db_userpointscount_update();

        foreach ($postids as $postid) { // hoping there aren't many of these - saves a lot of new SQL code...
            qa_db_post_recount_votes($postid);
            qa_db_post_recount_flags($postid);
        }

        $postuserids=qa_db_posts_get_userids($postids);

        foreach ($postuserids as $postuserid)
            qa_db_points_update_ifuser($postuserid, array('avoteds','qvoteds', 'upvoteds', 'downvoteds'));
    }
    /**
     * kullanıcının parolasını degistirir.
     * @param $userid : qa_users tablosundaki userid verisi
     * @param $innewpassword : yeni yazilacak parola
     */
    public function changePassword($userid,$innewpassword){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users-edit.php';
        require_once QA_INCLUDE_DIR.'app/users.php';
        require_once QA_INCLUDE_DIR.'db/selects.php';
        require_once QA_INCLUDE_DIR.'db\users.php';

        qa_db_user_set_password($userid, $innewpassword);
    }
    /**
     * kullanıcının nickName ni degistirir.
     * @param $userid : qa_users tablosundaki userid verisi
     * @param $inhandle : yeni yazilacak nickName
     */
    public function changeHandle($userid,$inhandle){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users-edit.php';
        require_once QA_INCLUDE_DIR.'app/users.php';
        require_once QA_INCLUDE_DIR.'db/selects.php';
        require_once QA_INCLUDE_DIR.'db\users.php';

        qa_db_user_set($userid, 'handle', $inhandle);
    }
    /**
     * kullanıcının mail hesabini degistirir.
     * @param $userid : qa_users tablosundaki userid verisi
     * @param $inemail : yeni yazilacak mail hesabi
     */
    public function changeEmail($userid,$inemail){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users-edit.php';
        require_once QA_INCLUDE_DIR.'app/users.php';
        require_once QA_INCLUDE_DIR.'db/selects.php';
        require_once QA_INCLUDE_DIR.'db\users.php';

        qa_db_user_set($userid, 'email', $inemail);
    }
    /**
     * istenilen kullanıcının userid sini dondurur.
     * @param $handle : istenilen id deki kullanıcının nickName i
     */
    public function getUserid($handle):int{
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'db/users.php';

        $handleuserids=qa_db_user_get_handle_userids(array($handle));
        if (count($handleuserids)==1)
            return reset($handleuserids);
    }
    /**
     * sisteme giris yapar.
     * @param $handle : sisteme giricek kullanıcının nickName
     * @param $password : sisteme giricek kullanıcının parolası
     */
    public function login($handle,$password){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users.php';

        require_once QA_INCLUDE_DIR.'app/limits.php';

        require_once QA_INCLUDE_DIR.'db/users.php';
        require_once QA_INCLUDE_DIR.'db/selects.php';

        $matchusers=qa_db_user_find_by_handle($handle);

        if (count($matchusers)==1) { // if matches more than one (should be impossible), don't log in
            $inuserid = $matchusers[0];
            $userinfo = qa_db_select_with_pending(qa_db_user_account_selectspec($inuserid, true));

            if (strtolower(qa_db_calc_passcheck($password, $userinfo['passsalt'])) == strtolower($userinfo['passcheck'])) { // login and redirect
                require_once QA_INCLUDE_DIR . 'app/users.php';

                qa_set_logged_in_user($inuserid, $userinfo['handle'],false);
            }
        }
    }
    /**
     * sistemden  cıkıs yapar.
     */
    public function logout(){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users.php';
        if (qa_is_logged_in())
            qa_set_logged_in_user(null);
    }
    /**
     * qa_users da level=100 olan kisiler admindir.Bu fonksiyon sisteme admin girisini sağlar
     * bu sayede post ve kullanıcılara el ile mudahale arayüz ile saglanır.
     */
    public function adminLogin(){
        require_once '../qa-include/qa-base.php';
        require_once QA_INCLUDE_DIR.'app/users.php';

        require_once QA_INCLUDE_DIR.'app/limits.php';

        require_once QA_INCLUDE_DIR.'db/users.php';
        require_once QA_INCLUDE_DIR.'db/selects.php';

        $matchusers=qa_db_user_find_by_handle('aysakcan');

        if (count($matchusers)==1) { // if matches more than one (should be impossible), don't log in
            $inuserid = $matchusers[0];
            $userinfo = qa_db_select_with_pending(qa_db_user_account_selectspec($inuserid, true));

            if (strtolower(qa_db_calc_passcheck('asd321', $userinfo['passsalt'])) == strtolower($userinfo['passcheck'])) { // login and redirect
                require_once QA_INCLUDE_DIR . 'app/users.php';

                qa_set_logged_in_user($inuserid, $userinfo['handle'],false);
            }
        }
    }

}
