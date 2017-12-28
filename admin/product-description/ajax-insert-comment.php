<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
if (isset($_GET['title']) && isset($_GET['content']) &&
    isset($_GET['bool']) && isset($_GET['product_id']) && isset($_GET['rating'])) {
    $title = htmlspecialchars($_GET['title'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_GET['content'], ENT_QUOTES, 'UTF-8');
    $bool = htmlspecialchars($_GET['bool'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['id'];
    $rating = $_GET['rating'];
    $product_id = $_GET['product_id'];
    $commentDatabaseObj = new CommentDatabase();
    if (strcmp($bool,"true")==0){
        $commentModelObj = new Comment(null,$product_id,$user_id,$title,$content,null,$rating);
        $commentDatabaseObj->insertComment($commentModelObj);
    }   else{
        $commentModelObj = new Comment(null,$product_id,null,$title,$content,null,$rating);
        $commentDatabaseObj->insertComment($commentModelObj);
    }
}



