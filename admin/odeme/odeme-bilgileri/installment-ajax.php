<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';

$user_id = $_SESSION['id'];
$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id);
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = $totalPrice + doubleval($cargoPrice);

$cardId = -1;

$type = $_POST['type'];

if($type == "normalPay"){
    $ccNumber = $_POST['ccNumber'];
    $ccSurname = $_POST['ccSurname'];
    $ccDate = $_POST['ccDate'];
    $ccCode =$_POST['ccCode'];


}else if($type == "storedPay"){
    $cardId = $_POST['cardId'];
    $storedCardDatabase = new StoredCardDatabase();
    $storedCard = $storedCardDatabase->getStoredCardByID($cardId);

}

?>

<table class="ui celled structured table">
    <tbody>
    <tr>
        <td  colspan="3">
            <?php if($type == "normalPay"){?>
                <div id="payment-information-pay-button-id" class="ui blue right floated  button">
                    Ödemeyi Gerçekleştir
                    <i class="right arrow icon"></i>
                </div>
                <div id="payment-information-save-button-id" class="ui blue right floated  button">
                    <i class="credit card alternative icon"></i>
                    Kartı Kaydet
                </div>

                <div id="store-card-dimmer" class="ui page dimmer">
                    <div class="content">
                        <div class="center">
                            <h2>Kart Saklama ile Tek Tıkla Ödeme Hazır</h2>
                            <p>
                                Kartınız Kaydedildi
                            </p>
                        </div>
                    </div>
                </div>
            <?php } else if($type == "storedPay"){?>

                <div id="payment-information-stored-card-button-id" data-cardId="<?php echo $cardId; ?>" class="ui blue right floated  button">
                    Ödemeyi Gerçekleştir
                    <i class="right arrow icon"></i>
                </div>

            <?php } ?>
        </td>
    </tr>
    </tbody>
</table>

