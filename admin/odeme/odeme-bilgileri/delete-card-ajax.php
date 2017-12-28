<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
$user_id = $_SESSION['id'];

if(isset($_POST['cardId'])){
    $cardId = $_POST['cardId'];
    $storedCardDatabase = new StoredCardDatabase();
    $card = $storedCardDatabase->getStoredCardByID($cardId);

    $cardStore = new CardStore();

    $cardStore->delete_card($card->getCardToken(),$card->getCardUserKey());
    $storedCardDatabase->deleteStoredCardByID($cardId);
}
