<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
$object = new UserDatabase();
if (isset($_GET['option']) && isset($_GET['key'])) {

    $method = $_GET['option'];
    $searchKey = $_GET['key'];
    $users = [];
    if ($method == 3) {
        $users = $object->getUserByEmail($searchKey);
    } else if ($method == 2) {
        $users = $object->getUserByPhone($searchKey);
    } else if ($method == 1) {
        $users = $object->getUserByLastName($searchKey);
    } else if ($method == 0) {
        $users = $object->getUserByName($searchKey);
    }
    echo getHTMLFormat($users);

} else if (isset($_GET['option'])) {
    $users = $object->getUserById();
    echo getHTMLFormat($users);
}   else if (isset($_GET['id'])){
    $user = $object->getOneUserById($_GET['id']);
    echo getHTMLFormatModal($user);
}

function getHTMLFormatModal($user){
    /**
     * @var $user User
     */
    $str = "";
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $e_mail = $user->getEMail();
    $phone_number = $user->getPhoneNumber();
    $id = $user->getId();

    $str.=<<<HTML
                <div class="three wide column">Kullanıcı Özellikleri</div>
                <div class="three wide column">Kullanıcı Bilgileri</div>
                <div class="ten wide column"></div>
                <!--
                dinamik olarak doldurulacak, id numaraları artan sırada verilmeli

                -->
                <div class="row">
                    <div class="three wide column">İsim:</div>
                    <div class="five wide column"><input style="width:250px" type="text" value="${firstName}"></div>
                </div>

                <div class="row">
                    <div class="three wide column">Soyisim:</div>
                    <div class="five wide column"><input style="width:250px" type="text" value="${lastName}"></div>
                </div>

                <div class="row">
                    <div class="three wide column">Telefon Numarası:</div>
                    <div class="five wide column"><input style="width:250px" type="text" value="${phone_number}"></div>
                </div>

                <div class="row">
                    <div class="three wide column">E-Mail Adresi:</div>
                    <div class="five wide column"><input style="width:250px" type="text" value="${e_mail}"></div>
                </div>
                
                <div class="row" style="display: none">
                    <input type="text" value="${id}">
                </div>
                
HTML;

    return $str;

}

function getHTMLFormat($users){
    $str = "";
    foreach ($users as $user){
        /**
         * @var $user User
         */
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $e_mail = $user->getEMail();
        $phone_number = $user->getPhoneNumber();
        $id = $user->getId();
        $str .= <<<HTML
            <tr>
                <td>${firstName}</td>
                <td>${lastName}</td>
                <td>${e_mail}</td>
                <td>${phone_number}</td>
                <td><button class="ui labeled icon button" id="editButton"> <i class="edit icon"></i> Düzenle </button></td>
                <td><button class="ui labeled icon button" id="orderButton"> <i class="shop icon"></i> Siparişler </button></td>
                <td class="id-container" style="display: none;">${id}</td>
            </tr>
HTML;
    }

    return $str;
}