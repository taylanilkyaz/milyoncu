<?php
require $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'system-header.php';


$object = new UserDatabase();
//user tarafından düzenlenen kullanıcı işlemleri
if (isset($_POST['first-name']) &&
    isset($_POST['last-name']) &&
    isset($_POST['e-mail']) &&
    isset($_POST['phone-number']) &&
    isset($_POST['tc-no']) &&
    isset($_POST['father-first']) &&
    isset($_POST['mother-first']) &&
    isset($_POST['mother-maiden'])
) {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $e_mail = $_POST['e-mail'];
    $phone_number = $_POST['phone-number'];
    $tc = $_POST['tc-no'];
    $father_first = $_POST['father-first'];
    $mother_first = $_POST['mother-first'];
    $mother_maiden = $_POST['mother-maiden'];

    $object->editUserByUser($first_name,$last_name,$e_mail,$phone_number,
        $tc,$father_first,$mother_first,$mother_maiden,$_SESSION['id']);

    redirect('/admin/edituser/index.php');
}
