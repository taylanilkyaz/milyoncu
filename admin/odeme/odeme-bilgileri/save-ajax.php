<?php
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';

$storedCardDb = new StoredCardDatabase();

$user_id = $_SESSION['id'];

$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id) ;
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = doubleval($totalPrice) + doubleval($cargoPrice);

$basketList = $dashboard->getAllBasketAsProductArr($user_id);

$ccNumber = $_POST['ccNumber'];
$ccSurname = $_POST['ccSurname'];
$ccDate = $_POST['ccDate'];
$ccCode =$_POST['ccCode'];
$type = $_POST['type'];
$selectedInsallmentNumber = $_POST['selectedInstallmentNumber'];

$hideCCCode = substr($ccNumber,0,2)."************" .substr($ccNumber,-2);

$ccNumber = str_replace(" ","",$ccNumber);
$ccSurname = preg_replace('!\s+!', ' ', $ccSurname);
$ccDate = str_replace(" ","",$ccDate);
$ccMonth = explode("/",$ccDate)[0];
$ccYear = explode("/",$ccDate)[1];
$selectedInsallmentNumber = intval($selectedInsallmentNumber);

$cardStore = new CardStore();

/**
 * Eğer kullanıcının sistemde kartı varsa
 */

/**
 * Eğer kullanıcı sisteme ilk kez kart kayıt ediyorsa
 */

if($type == "store"){
$storedCard = new StoredCard();
$card = $cardStore->create_user_and_add_card("test1@gmail.com","1","paraf", $ccSurname,  $ccNumber, $ccMonth, $ccYear);

$storedCard->setUserId($user_id);
$storedCard->setCardToken($card->getCardToken());
$storedCard->setCardUserKey($card->getCardUserKey());
$storedCard->setCardAlias($card->getCardAlias());
$storedCard->setBinNumber($card->getBinNumber());
$storedCard->setCardHolderName($ccSurname);

$storedCardDb->insert($storedCard);
}

if($type == "list"){
    /**
     * @var $obj StoredCard[]
     */
    $obj = $storedCardDb->getStoredCardByUserID($user_id);
    $cardUserKey = $obj[0]->getCardUserKey();
    $cardStore->list_card($cardUserKey);?>

    <div class="ui stackable centered grid">

        <div class="nine wide center aligned  centered column">
            <h1> Kredi ve ya Banka Kartları</h1>
            <span>Kartlar İyzico Güvencesiyle hızlı ödeme seçeneği için kaydolmaktadır.</span>
        </div>


        <div class="nine wide center aligned  centered column">
            <table class="ui celled striped table">
                <tbody>

                <?php
                foreach ($obj as $userCard){?>
                        <tr>
                            <td>
                                <b><?php echo $userCard->getCardHolderName();?></b>&nbsp;&nbsp;<span><b><?php echo $userCard->getBinNumber();?></b>****** **** ****</span>
                                <p class="small"><?php echo $userCard->getCardAlias();?>&nbsp;<?php echo $userCard->getAddDatetime(). " tarihinde eklendi";?></p>
                            </td>
                            <td>
                                <button data-id="<?php echo $userCard->getId(); ?>" class="ui button" >
                                    Kayıtlı Kart İle Öde
                                </button>
                            </td>
                            <td class="center aligned"><i data-id="<?php echo $userCard->getId(); ?>" class="remove big circle icon"></i></button></td>

                        </tr>

                <?php  } ?>
                </tbody>
            </table>
        </div>

    </div>

<?php  } ?>