<div id="odeme-bilgileri-top-content-id" class="ui fluid container"  >
    <div id="steps-id" class="ui stackable centered grid"  >
        <div class="middle aligned fourteen wide center aligned column"   >
            <div  class="ui tablet stackable steps" >
                <div  class="step">
                    <i class="truck icon"></i>
                    <div class="content" >
                        <div class="title">Teslimat Bilgileri</div>
                    </div>
                </div>

                <div  class="active step">
                    <i class="payment icon"></i>
                    <div class="content">
                        <div class="title">Ödeme Bilgileri</div>
                    </div>
                </div>

                <div  class="disabled step">
                    <i class="info icon"></i>
                    <div class="content">
                        <div class="title">Sipariş Özeti</div>
                    </div>
                </div>

                <div  class="disabled step">
                    <i class="checkmark icon"></i>
                    <div class="content">
                        <div class="title">Sipariş Tamamlandı</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="top-content-2" class="ui fluid container">

    <?php

        $userId = $_SESSION['id'];
        $storedCardDatabase = new StoredCardDatabase();
        $storedCardArray = $storedCardDatabase->getStoredCardByUserID($userId);

        if(isset($_POST['normalPay'])){?>

            <div class="ui stackable grid">
                <div class="row">
                    <div class="three wide column"></div>
                    <div id="first-detail" class="middle aligned nine wide center aligned column"  >
                        <div class="card-wrapper"></div>
                        <div class="ui large form" id="payment-information-form" >
                            <div id = "page-content-id" class="content">

                                <div id="credit-bank-card-id" class="ui top attached tabular menu">
                                    <div  class="ui segment">
                                        <a class="item">
                                            Kredi/Banka Kartı
                                        </a>
                                    </div>
                                </div>

                                <div class="ui bottom attached segment">

                                    <div class="inline fields" style="">
                                        <div class="sixteen wide field">
                                            <label>Kart Numarası</label>
                                            <input id="credit-card-number" placeholder="Kart Numarası" type="tel" name="number" maxlength="19">
                                            <img style="margin: 0 12px" id="inter-type" class="tooltip-tipsy" src="/assets/images/keyboard.svg"  >
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Kart Üzerindeki İsim</label>
                                            <input id="credit-card-name-surname" placeholder="Ad/Soyad" type="text" name="name">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Son Kullanma Tarihi</label>
                                            <input id="last-date" placeholder="MM/YY" type="tel" name="expiry">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Güvenlik Kodu</label>
                                            <input id="security-code" placeholder="CVC" type="number" name="cvc" >
                                            <i class="circular info icon " title="Kredi kartınızın arkasındaki imza alanında bulunan rakamların son 3 hanesi, Amex kartlar için ise son 4 hanesidir."></i>
                                        </div>
                                    </div>

                                    <div class="field">

                                        <button name="action" value="geri" id="payment-information-back-button-id" class="ui blue button">
                                            <i class="left arrow icon"></i>
                                            Geri Gel
                                        </button>

                                        <button name="action" value="ileri" id="payment-information-next-button-id" class="ui blue button">
                                            Devam Et
                                            <i class="right arrow icon"></i>
                                        </button>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div  class="row">
                    <div class="three wide column"></div>

                    <div id="installment-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="list-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="pay-with-stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>
                </div>

            </div>

        <?php }
        /**
         * Eğer kayıtlı kart yoksa.
         */
        else if(count($storedCardArray) == 0){?>

            <div class="ui stackable grid">
                <div class="row">
                    <div class="three wide column"></div>
                    <div id="first-detail" class="middle aligned nine wide center aligned column"  >
                        <div class="card-wrapper"></div>
                        <div class="ui large form" id="payment-information-form" >
                            <div id = "page-content-id" class="content">

                                <div id="credit-bank-card-id" class="ui top attached tabular menu">
                                    <div  class="ui segment">
                                        <a class="item">
                                            Kredi/Banka Kartı
                                        </a>
                                    </div>
                                </div>

                                <div class="ui bottom attached segment">

                                    <div class="inline fields" style="">
                                        <div class="sixteen wide field">
                                            <label>Kart Numarası</label>
                                            <input id="credit-card-number" placeholder="Kart Numarası" type="tel" name="number" maxlength="19">
                                            <img style="margin: 0 12px" id="inter-type" class="tooltip-tipsy" src="/assets/images/keyboard.svg"  >
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Kart Üzerindeki İsim</label>
                                            <input id="credit-card-name-surname" placeholder="Ad/Soyad" type="text" name="name">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Son Kullanma Tarihi</label>
                                            <input id="last-date" placeholder="MM/YY" type="tel" name="expiry">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="sixteen wide field">
                                            <label>Güvenlik Kodu</label>
                                            <input id="security-code" placeholder="CVC" type="number" name="cvc" >
                                            <i class="circular info icon " title="Kredi kartınızın arkasındaki imza alanında bulunan rakamların son 3 hanesi, Amex kartlar için ise son 4 hanesidir."></i>
                                        </div>
                                    </div>

                                    <div class="field">

                                        <button name="action" value="geri" id="payment-information-back-button-id" class="ui blue button">
                                            <i class="left arrow icon"></i>
                                            Geri Gel
                                        </button>

                                        <button name="action" value="ileri" id="payment-information-next-button-id" class="ui blue button">
                                            Devam Et
                                            <i class="right arrow icon"></i>
                                        </button>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div  class="row">
                    <div class="three wide column"></div>

                    <div id="installment-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="list-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="pay-with-stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>
                </div>

            </div>

        <?php } /**
         * Eğer  kayıtlı kart varsa
         */
        else {
            $storedCardDb = new StoredCardDatabase();
            $cardStore = new CardStore();
            $user_id = $_SESSION['id'];

            $obj = $storedCardDb->getStoredCardByUserID($user_id);
            $cardUserKey = $obj[0]->getCardUserKey();
            $cardStore->list_card($cardUserKey);
            ?>

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
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input style="display: none;" name="normalPay"  value="">
                        <button class="ui button" >Normal Öde</button>
                    </form>
                </div>

                <div  class="nine wide center aligned  centered column">
                    <div class="three wide column"></div>

                    <div id="installment-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="list-card-detail" class="middle aligned eight wide center aligned column">

                    </div>

                    <div id="pay-with-stored-card-detail" class="middle aligned eight wide center aligned column">

                    </div>
                </div>


            </div>


        <?php } ?>





</div>