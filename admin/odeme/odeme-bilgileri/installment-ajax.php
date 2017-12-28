<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
require_once('../iyzico-b4u/config.php');
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';

$user_id = $_SESSION['id'];
$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id);
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = $totalPrice + doubleval($cargoPrice);

$request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
$cardId = -1;

$type = $_POST['type'];

if($type == "normalPay"){
    $ccNumber = $_POST['ccNumber'];
    $ccSurname = $_POST['ccSurname'];
    $ccDate = $_POST['ccDate'];
    $ccCode =$_POST['ccCode'];

    /**
     * Taksit Bilgileri
     */

    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setConversationId("123456789");
    $request->setBinNumber(substr(str_replace(' ', '', $ccNumber),0,6));
    $request->setPrice($fullPrice);
}else if($type == "storedPay"){
    $cardId = $_POST['cardId'];
    $storedCardDatabase = new StoredCardDatabase();
    $storedCard = $storedCardDatabase->getStoredCardByID($cardId);


    /**
     * Taksit Bilgileri
     */

    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setBinNumber($storedCard->getBinNumber());
    $request->setPrice($fullPrice);
}





$installmentInfo = \Iyzipay\Model\InstallmentInfo::retrieve($request, Config::options());


/**
 * @var Iyzipay\Model\InstallmentDetail $installmentDetail
 */
$installmentDetail = $installmentInfo->getInstallmentDetails()[0];


$installmentPrices = $installmentDetail->getInstallmentPrices();
?>

<style>
    #bonus-card-image-row-id{
        background-color: #9CC435;
    }
    #world-card-image-row-id{
        background-color: #650C6F;
    }
    #axess-card-image-row-id{
        background-color: #EFA222;
    }
    #cardFinans-card-image-row-id{
        background-color: #103993;
    }
    #maximum-card-image-row-id{
        background-color: #C12A72;
    }
    #advantage-card-image-row-id{
        background-color: #F77B00;
    }
    #paraf-card-image-row-id{
        background-color: #00DDFF;
    }
    #halkbank-card-image-row-id{
        background-color: #005494
    }
    #akbank-card-image-row-id{
        background-color: #EF3125;
    }
    #yapikredi-card-image-row-id{
        background-color: #FCFEFB;
    }
    #vakifbank-card-image-row-id{
        background-color: #FCFEFC;
    }

    #bonus-card-logo-id {
        border: 0;
        margin-left: 15%;
    }
    #world-card-logo-id{
        border: 0;
        margin-left: 12%;
    }
    #axess-card-logo-id {
        border: 0;
        margin-left: 15%;
    }
    #cardFinans-card-logo-id {
        border: 0;
        margin-left: 15%;
    }
    #maximum-card-logo-id {
        border: 0;
        margin-left: 35%;
    }
    #advantage-card-logo-id {
        border: 0;
        margin-left: 15%;
    }
    #paraf-card-logo-id {
        border: 0;
        margin-left: 15%;
    }
    #halkbank-card-logo-id{
        border: 0;
        margin-left: 15%;
    }
    #akbank-card-logo-id{
        border: 0;
        margin-left: 15%;
    }
    #yapikredi-card-logo-id{
        border: 0;
        margin-left: 15%;
    }
    #vakifbank-card-logo-id{
        border: 0;
        margin-left: 15%;
    }
</style>

<table class="ui celled structured table">
    <thead>
    <tr>
        <h3 class="ui header"> Taksit Sayısını Seç</h3>
        <?php
        $cardFamilyName = strtolower($installmentDetail->getCardFamilyName());
        //echo $cardFamilyName;
        switch($cardFamilyName){
            case "axess":
                echo ' <th colspan="3" id="axess-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/axess.png" id="axess-card-logo-id">';
                break;
            case "bonus":
                echo ' <th colspan="3" id="bonus-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/bonus.png" id="bonus-card-logo-id">';
                break;
            case "world":
                echo ' <th colspan="3" id="world-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/world.png" id="world-card-logo-id">';
                break;
            case "maximum":
                echo ' <th colspan="3" id="maximum-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/maximum.png" id="maximum-card-logo-id">';
                break;
            case "cardfinans":
                echo ' <th colspan="3" id="cardFinans-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/cardFinans.png" id="cardFinans-card-logo-id">';
                break;
            case "paraf":
                echo ' <th colspan="3" id="paraf-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/paraf.png" id="paraf-card-logo-id">';
                break;
            case "advantage":
                echo ' <th colspan="3" id="advantage-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/paraf.png" id="advantage-card-logo-id">';
                break;
            case "advantage":
                echo ' <th colspan="3" id="advantage-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/paraf.png" id="advantage-card-logo-id">';
                break;
            case "neo":
                echo ' <th colspan="3" id="akbank-card-image-row-id">';
                echo '<img src="/assets/images/credit-card-logo/akbank.png" id="akbank-card-logo-id">';
                break;

            default:
                if(strpos($cardFamilyName, 'halkbank') !== false){
                    echo ' <th colspan="3" id="halkbank-card-image-row-id">';
                    echo '<img src="/assets/images/credit-card-logo/halkbank.png" id="halkbank-card-logo-id">';
                }else if(strpos($cardFamilyName, 'cardfinans') !== false){
                    echo ' <th colspan="3" id="cardFinans-card-image-row-id">';
                    echo '<img src="/assets/images/credit-card-logo/cardFinans.png" id="cardFinans-card-logo-id">';
                }else if(strpos($cardFamilyName, 'advantage') !== false){
                    echo ' <th colspan="3" id="advantage-card-image-row-id">';
                    echo '<img src="/assets/images/credit-card-logo/advantage.png" id="advantage-card-logo-id">';
                }else if(strpos($cardFamilyName, 'vakıfbank') !== false){
                    echo ' <th colspan="3" id="vakifbank-card-image-row-id">';
                    echo '<img src="/assets/images/credit-card-logo/vakifbank.png" id="vakifbank-card-logo-id">';
                }else if(strpos($cardFamilyName, 'tlcard') !== false){
                    echo ' <th colspan="3" id="yapikredi-card-image-row-id">';
                    echo '<img src="/assets/images/credit-card-logo/yapikredi.jpg" id="yapikredi-card-logo-id">';
                }
                break;
        }
        ?>

        </th>
    </tr>
    <tr>
        <th>Taksit Sayısı</th>
        <th>Taksit Tutarı</th>
        <th>Toplam Tutar</th>
    </tr>


    </thead>
    <tbody>
    <?php

    /**
     * @var Iyzipay\Model\InstallmentPrice $installmentPrice
     */
    foreach ($installmentPrices as $installmentPrice){ ?>

        <tr>
            <td>
                <div id="installment-radio-checkbox" class="ui radio checkbox">
                    <input class="installment-checkbox" type="radio" name="frequency" checked="">
                    <label><?php echo $installmentPrice->getInstallmentNumber() ?> </label>
                </div>
            </td>
            <td ><?php echo $installmentPrice->getInstallmentPrice() ?> </td>
            <td ><?php echo $installmentPrice->getTotalPrice() ?> </td>
        </tr>



    <?php } ?>

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
                            <img src="//media.iyzico.com/f/assets/images/content/logo.svg?v=v2.0.18" alt="iyzico" >
                            <h2>Kart Saklama ile Tek Tıkla Ödeme Hazır</h2>
                            <p>
                                İyzico'nun PCI-DSS sertifikası sayesinde müşterilerimize her seferinde kart bilgilerini girme zahmetinden kurtarıp, alışverişi kolaylaştırıyoruz.
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


<?php
$installmentStatus = $installmentInfo->getStatus();

/**
 * 1 0
 */
$installmentForce3ds = $installmentDetail->getForce3ds();
?>
