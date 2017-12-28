<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
if (isset($_GET['commentID'])) {
    $comment_id = $_GET['commentID'];
    $commentDatabaseObj = new CommentDatabase();
    $user_id = $commentDatabaseObj->getUserIDForComment($comment_id);
    if ($user_id == $_SESSION['id']){
        $commentDatabaseObj->deleteComment($comment_id);
    }
}



