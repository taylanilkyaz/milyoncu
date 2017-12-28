<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
if (isset($_GET['product_name']) && !isset($_GET['count'])) {
    $productDatabaseObj = new ProductDatabase();
    $commentDatabaseObj = new CommentDatabase();
    $product = $productDatabaseObj->getProductByName($_GET['product_name']);
    $comments = $commentDatabaseObj->getAllCommentsForProduct($product->getId());
    $commentModelObj = [];
    for ($i = 0; $i < count($comments); $i++) {
        array_push($commentModelObj, Comment::__constructByMysqliRow($comments[$i]));
    }
    $userDatabaseObj = new UserDatabase();

    $str = "";
    for ($j = 0; $j < count($commentModelObj); $j++) {
        $commentObj = $commentModelObj[$j];
        /**
         * @var $commentObj Comment
         */
        $comment_id = $commentObj->getİd();
        $user_id = $commentObj->getUserİd();
        $title = $commentObj->getTitle();
        $add_time = $commentObj->getAddTime();
        $content = $commentObj->getContent();
        $user_name = $userDatabaseObj->getCustomerName($commentObj->getUserİd());
        $rate = $commentObj->getRating();
        $str .= <<<HTML
        <tr>
            <td>
                <div class="comment">
                    <div class="content">
                        <a class="author">
                            ${title}
                            </a>
                        <div class="ui tiny star rating" data-rating="${rate}" data-max-rating="5" style="margin-right: 2%"></div>
HTML;
        if ($user_id == $_SESSION['id']) {
            $str .= <<<HTML
            <button class="ui icon button" id="delete-comment" style="background: white" data-value="${comment_id}">
                <i class="red trash outline icon" style="font-size: 1.3em"></i>
            </button>
HTML;
        }

        $str .= <<<HTML
                        
                        <div class="metadata">
                            <div class="date">
                                ${add_time}
                                </div>
                        </div>
                        <div class="text">
                            ${content}
                        </div>
                        <a class="author-class">${user_name}</a>
                    </div>
                </div>
            </td>
        </tr>
HTML;

    }

    echo $str;
}
if (isset($_GET['count'])) {
    $productDatabaseObj = new ProductDatabase();
    $commentDatabaseObj = new CommentDatabase();
    $product = $productDatabaseObj->getProductByName($_GET['product_name']);
    $commentCount = $commentDatabaseObj->getTotalCommentCount($product->getId());
    echo $commentCount;
}



