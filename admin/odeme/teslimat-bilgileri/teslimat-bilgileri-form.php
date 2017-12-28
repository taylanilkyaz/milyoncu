<?php


//TODO CRON JOB olarak eklenecek
/**
 * Dolar try güncellemesi için gerekli
 * $var = new ExchangeRateDatabase();
    $var->updateExchangeRate();
 */
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';

$user_id = $_SESSION['id'];
$dashboard = new Buy();
$relationObj = new AddressUserRelation();
$addressObj = new AddressDatabase();
$bool = $relationObj->isAddressExists($user_id);
$totalPrice = floor($dashboard->getAllBasketTotalPrice($user_id));
$cargoPrice = $dashboard->getAllCargoPrice($user_id) ;
$fullPrice = doubleval($totalPrice) + doubleval($cargoPrice);
$totalProductCount = 0;
$basketList = $dashboard->getAllBasketAsProductArr($user_id);

foreach ($basketList as $item){
    /**
     *  @var $item Product
     */
    $totalProductCount+=$item->getCount();
}
?>

<div id="teslim-bilgileri-page-id">
    <div id="teslimat-bilgileri-top-content-id" class="ui fluid container">
        <div class="ui tablet stackable steps" id="steps-id">
            <div class="active step">
                <i class="truck icon"></i>
                <div class="content">
                    <div class="title">Teslimat Bilgileri</div>
                </div>
            </div>

            <div class="disabled step">
                <i class="payment icon"></i>
                <div class="content">
                    <div class="title">Ödeme Bilgileri</div>
                </div>
            </div>

            <div class="disabled step">
                <i class="info icon"></i>
                <div class="content">
                    <div class="title">Sipariş Özeti</div>
                </div>
            </div>

            <div class="disabled step">
                <i class="checkmark icon"></i>
                <div class="content">
                    <div class="title">Sipariş Tamamlandı</div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="top-content-2" class="ui fluid container">
    <form class="ui large form" id="shipping-information-form" action="database-process.php">
        <div class="ui stackable centered grid" id="centered-information-menu">
            <div class="row">
                <div class="two wide computer one wide tablet column"></div>
                <div id="shipping-information-table-id" class="center aligned seven wide computer ten wide tablet column">
                    <?php
                    if ($bool){
                        ?>
                        <div id="segment-id" class="ui segment">
                            <div id="top-content-2" class="ui fluid container">
                                <div class="header"><h1 id="first-screen-h1-id">Teslimat Bilgileri</h1></div>
                                <div class="meta">
                                    <span class="date"><h4>Lütfen teslimat adres bilgilerinizi ve teslimat seçeneğini belirtin.</h4></span>
                                </div>
                                <div class="ui inverted divider"></div>
                                <div class="two fields">
                                    <div class="field">
                                        <div class="header">Kargo Adresi</div>
                                        <div class="ui selection dropdown" id="cargo-dropdown">
                                            <input type="hidden" name="cargoAddress">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">
                                                Kargo Adresi Seçiniz
                                            </div>
                                            <div class="menu" id="cargo-menu">
                                                <?php
                                                $all_cargo_address = $addressObj->getAllCargoAddress($user_id);
                                                for($i=0 ; $i<count($all_cargo_address) ; $i++){
                                                    $one_cargo_address = $all_cargo_address[$i];
                                                    /**
                                                     * @var $one_cargo_address Address
                                                     */
                                                    ?>
                                                    <div class="item" data-value="<?php echo $one_cargo_address['cargo_address_id']; ?>"><?php
                                                        echo $one_cargo_address['address_name'];
                                                        echo "<br>";
                                                        echo $one_cargo_address['cargoAddress']." ".$one_cargo_address['district']." ".$one_cargo_address['county']
                                                        ."/".$one_cargo_address['city']."/".$one_cargo_address['country'];
                                                        echo "<br>";
                                                        echo $one_cargo_address['firstname']." ".$one_cargo_address['lastname'].
                                                            " - ".$one_cargo_address['phoneNumber'];
                                                        ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <a href="#" id="add-new-cargo-address" >+Yeni Adres Ekle</a>
                                    </div>
                                    <div class="field">
                                        <div class="header">Fatura Adresi</div>
                                        <div class="ui selection dropdown" id="bill-dropdown">
                                            <input type="hidden" name="billAddress">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">
                                                Fatura Adresi Seçiniz
                                            </div>
                                            <div class="menu" id="bill-menu">
                                                    <?php
                                                    $all_bill_address = $addressObj->getAllBillAddress($user_id);
                                                    for($i=0 ; $i<count($all_bill_address) ; $i++){
                                                        $one_bill_address = $all_bill_address[$i];
                                                        /**
                                                         * @var $one_cargo_address Address
                                                         */
                                                        ?>
                                                        <div class="item" data-value="<?php echo $one_bill_address['bill_address_id'];?>"><?php
                                                            echo $one_bill_address['address_name'];
                                                            echo "<br>";
                                                            echo $one_bill_address['billingAddress']." ".$one_bill_address['district']." ".$one_bill_address['county']
                                                                ."/".$one_bill_address['city']."/".$one_bill_address['country'];
                                                            echo "<br>";
                                                            echo $one_bill_address['firstname']." ".$one_bill_address['lastname'].
                                                                " - ".$one_bill_address['phoneNumber'];
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <a href="#" id="add-new-bill-address" >+Yeni Adres Ekle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }   else{
                        ?>
                        <div id="segment-id" class="ui segment">
                            <div class="content">
                                <h2 class="ui header">
                                    <div class="ui dividing header">
                                        Bu Adresi Kullanın
                                        <div class="sub header">
                                            Fatura bilgileri için lütfen aşağıdaki formu doldurunuz.
                                        </div>
                                    </div>
                                </h2>

                                <h4 id="personal-information-header-id" class="ui dividing header">Kişisel Bilgiler</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İsim</label>
                                        <input name="firstName" type="text" placeholder="İsim" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Soyisim</label>
                                        <input name="lastName" type="text" placeholder="Soyisim" maxlength="51">
                                    </div>
                                </div>

                                <h4 id="shipping-information-header-id" class="ui dividing header">Teslimat Adresi
                                    Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Adres Adı</label>
                                        <input name="addressName" type="text" placeholder="Adres Adı" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Ülke</label>
                                        <div class="ui fluid search selection dropdown" id="country-selector">
                                            <input type="hidden" name="country">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">
                                                Ülke seçiniz
                                            </div>
                                            <div class="menu">
                                                <div class="item" data-value="Afganistan"><i class="af flag"></i>Afganistan</div>
                                                <div class="item" data-value="Aland Adaları"><i class="ax flag"></i>Aland Adaları</div>
                                                <div class="item" data-value="Arnavutluk"><i class="al flag"></i>Arnavutluk</div>
                                                <div class="item" data-value="Cezayir"><i class="dz flag"></i>Cezayir</div>
                                                <div class="item" data-value="Amerikan Samoası"><i class="as flag"></i>Amerikan Samoası
                                                </div>
                                                <div class="item" data-value="Andora"><i class="ad flag"></i>Andora</div>
                                                <div class="item" data-value="Angola"><i class="ao flag"></i>Angola</div>
                                                <div class="item" data-value="Anguilla"><i class="ai flag"></i>Anguilla</div>
                                                <div class="item" data-value="Antigua"><i class="ag flag"></i>Antigua</div>
                                                <div class="item" data-value="Arjantin"><i class="ar flag"></i>Arjantin</div>
                                                <div class="item" data-value="Ermenistan"><i class="am flag"></i>Ermenistan</div>
                                                <div class="item" data-value="Aruba"><i class="aw flag"></i>Aruba</div>
                                                <div class="item" data-value="Avustralya"><i class="au flag"></i>Avustralya</div>
                                                <div class="item" data-value="Avusturya"><i class="at flag"></i>Avusturya</div>
                                                <div class="item" data-value="Azerbeycan"><i class="az flag"></i>Azerbeycan</div>
                                                <div class="item" data-value="Bahamalar"><i class="bs flag"></i>Bahamalar</div>
                                                <div class="item" data-value="Bahreyn"><i class="bh flag"></i>Bahreyn</div>
                                                <div class="item" data-value="Bangladeş"><i class="bd flag"></i>Bangladeş</div>
                                                <div class="item" data-value="Barbados"><i class="bb flag"></i>Barbados</div>
                                                <div class="item" data-value="Belarus"><i class="by flag"></i>Belarus(Beyaz
                                                    Rusya)
                                                </div>
                                                <div class="item" data-value="Belçika"><i class="be flag"></i>Belçika</div>
                                                <div class="item" data-value="Belize"><i class="bz flag"></i>Belize</div>
                                                <div class="item" data-value="Benin"><i class="bj flag"></i>Benin</div>
                                                <div class="item" data-value="Bermuda"><i class="bm flag"></i>Bermuda</div>
                                                <div class="item" data-value="Butan"><i class="bt flag"></i>Butan</div>
                                                <div class="item" data-value="Bolivya"><i class="bo flag"></i>Bolivya</div>
                                                <div class="item" data-value="Bosna"><i class="ba flag"></i>Bosna</div>
                                                <div class="item" data-value="Botsvana"><i class="bw flag"></i>Botsvana</div>
                                                <div class="item" data-value="Buvet Adaları"><i class="bv flag"></i>Buvet Adaları</div>
                                                <div class="item" data-value="Brezilya"><i class="br flag"></i>Brezilya</div>
                                                <div class="item" data-value="Bulgaristan"><i class="bg flag"></i>Bulgaristan</div>
                                                <div class="item" data-value="Kamboçya"><i class="kh flag"></i>Kamboçya</div>
                                                <div class="item" data-value="Kamerun"><i class="cm flag"></i>Kamerun</div>
                                                <div class="item" data-value="Kanada"><i class="ca flag"></i>Kanada</div>
                                                <div class="item" data-value="Orta Afrika
                                                    Cumhuriyeti"><i class="cf flag"></i>Orta Afrika
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="Çad"><i class="td flag"></i>Çad</div>
                                                <div class="item" data-value="Şili"><i class="cl flag"></i>Şili</div>
                                                <div class="item" data-value="Çin"><i class="cn flag"></i>Çin</div>
                                                <div class="item" data-value="Noel Adası"><i class="cx flag"></i>Noel Adası</div>
                                                <div class="item" data-value="Kolombiya"><i class="co flag"></i>Kolombiya</div>
                                                <div class="item" data-value="Komoros"><i class="km flag"></i>Komoros</div>
                                                <div class="item" data-value="Kongo"><i class="cd flag"></i>Kongo</div>
                                                <div class="item" data-value="Kosta Rika"><i class="cr flag"></i>Kosta Rika</div>
                                                <div class="item" data-value="Fildişi Sahili"><i class="ci flag"></i>Fildişi Sahili
                                                </div>
                                                <div class="item" data-value="Hırvatistan"><i class="hr flag"></i>Hırvatistan</div>
                                                <div class="item" data-value="Kuba"><i class="cu flag"></i>Kuba</div>
                                                <div class="item" data-value="Güney Kıbrıs Rum
                                                    Cumhuriyeti"><i class="cy flag"></i>Güney Kıbrıs Rum
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="Çekya"><i class="cz flag"></i>Çekya</div>
                                                <div class="item" data-value="Danimarka"><i class="dk flag"></i>Danimarka</div>
                                                <div class="item" data-value="Cibuti"><i class="dj flag"></i>Cibuti</div>
                                                <div class="item" data-value="Dominica"><i class="dm flag"></i>Dominica</div>
                                                <div class="item" data-value="Dominik Cumhuriyeti"><i class="do flag"></i>Dominik Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="Elvador"><i class="ec flag"></i>Elvador</div>
                                                <div class="item" data-value="Mısır"><i class="eg flag"></i>Mısır</div>
                                                <div class="item" data-value="El Salvador"><i class="sv flag"></i>El Salvador</div>
                                                <div class="item" data-value="İngiltere"><i class="gb flag"></i>İngiltere</div>
                                                <div class="item" data-value="Ekvator Ginesi"><i class="gq flag"></i>Ekvator Ginesi
                                                </div>
                                                <div class="item" data-value="Eritre"><i class="er flag"></i>Eritre</div>
                                                <div class="item" data-value="Estonya"><i class="ee flag"></i>Estonya</div>
                                                <div class="item" data-value="Etyopya"><i class="et flag"></i>Etyopya</div>
                                                <div class="item" data-value="Avrupa Birliği"><i class="eu flag"></i>Avrupa Birliği
                                                </div>
                                                <div class="item" data-value="Finlandiya"><i class="fi flag"></i>Finlandiya</div>
                                                <div class="item" data-value="fr"><i class="fr flag"></i>Fransa</div>
                                                <div class="item" data-value="Fransız Guyanası"><i class="gf flag"></i>Fransız Guyanası
                                                </div>
                                                <div class="item" data-value="Gürcistan"><i class="ge flag"></i>Gürcistan</div>
                                                <div class="item" data-value="Almanya"><i class="de flag"></i>Almanya</div>
                                                <div class="item" data-value="Gana"><i class="gh flag"></i>Gana</div>
                                                <div class="item" data-value="Cebelitarık"><i class="gi flag"></i>Cebelitarık</div>
                                                <div class="item" data-value="Yunanistan"><i class="gr flag"></i>Yunanistan</div>
                                                <div class="item" data-value="Grönland"><i class="gl flag"></i>Grönland</div>
                                                <div class="item" data-value="Gine"><i class="gn flag"></i>Gine</div>
                                                <div class="item" data-value="Haiti"><i class="ht flag"></i>Haiti</div>
                                                <div class="item" data-value="Honduras"><i class="hn flag"></i>Honduras</div>
                                                <div class="item" data-value="Hong Kong"><i class="hk flag"></i>Hong Kong</div>
                                                <div class="item" data-value="Macaristan"><i class="hu flag"></i>Macaristan</div>
                                                <div class="item" data-value="İzlanda"><i class="is flag"></i>İzlanda</div>
                                                <div class="item" data-value="Hindistan"><i class="in flag"></i>Hindistan</div>
                                                <div class="item" data-value="Endonezya"><i class="id flag"></i>Endonezya</div>
                                                <div class="item" data-value="İran"><i class="ir flag"></i>İran</div>
                                                <div class="item" data-value="Irak"><i class="iq flag"></i>Irak</div>
                                                <div class="item" data-value="İrlanda"><i class="ie flag"></i>İrlanda</div>
                                                <div class="item" data-value="İsrail"><i class="il flag"></i>İsrail</div>
                                                <div class="item" data-value="İtalya"><i class="it flag"></i>İtalya</div>
                                                <div class="item" data-value="Jameyika"><i class="jm flag"></i>Jameyika</div>
                                                <div class="item" data-value="Japonya"><i class="jp flag"></i>Japonya</div>
                                                <div class="item" data-value="Ürdün"><i class="jo flag"></i>Ürdün</div>
                                                <div class="item" data-value="Kazakistan"><i class="kz flag"></i>Kazakistan</div>
                                                <div class="item" data-value="Kenya"><i class="ke flag"></i>Kenya</div>
                                                <div class="item" data-value="Kiribati"><i class="ki flag"></i>Kiribati</div>
                                                <div class="item" data-value="Kuveyt"><i class="kw flag"></i>Kuveyt</div>
                                                <div class="item" data-value="Kırgızistan"><i class="kg flag"></i>Kırgızistan</div>
                                                <div class="item" data-value="Laos"><i class="la flag"></i>Laos</div>
                                                <div class="item" data-value="Letonya"><i class="lv flag"></i>Letonya</div>
                                                <div class="item" data-value="Lübnan"><i class="lb flag"></i>Lübnan</div>
                                                <div class="item" data-value="Lesotho"><i class="ls flag"></i>Lesotho</div>
                                                <div class="item" data-value="Liberya"><i class="lr flag"></i>Liberya</div>
                                                <div class="item" data-value="Libya"><i class="ly flag"></i>Libya</div>
                                                <div class="item" data-value="Lichtenstein"><i class="li flag"></i>Lichtenstein</div>
                                                <div class="item" data-value="Litvanya"><i class="lt flag"></i>Litvanya</div>
                                                <div class="item" data-value="Luxembourg"><i class="lu flag"></i>Luxembourg</div>
                                                <div class="item" data-value="Makedonya"><i class="mk flag"></i>Makedonya</div>
                                                <div class="item" data-value="Maldivler"><i class="mv flag"></i>Maldivler</div>
                                                <div class="item" data-value="Mali"><i class="ml flag"></i>Mali</div>
                                                <div class="item" data-value="Malta"><i class="mt flag"></i>Malta</div>
                                                <div class="item" data-value="mq"><i class="mq flag"></i>Martinik</div>
                                                <div class="item" data-value="mr"><i class="mr flag"></i>Moritanya</div>
                                                <div class="item" data-value="mu"><i class="mu flag"></i>Mauritius</div>
                                                <div class="item" data-value="yt"><i class="yt flag"></i>Mayotte</div>
                                                <div class="item" data-value="mx"><i class="mx flag"></i>Meksica</div>
                                                <div class="item" data-value="fm"><i class="fm flag"></i>Mikronezya</div>
                                                <div class="item" data-value="md"><i class="md flag"></i>Moldova</div>
                                                <div class="item" data-value="mc"><i class="mc flag"></i>Monaco</div>
                                                <div class="item" data-value="mn"><i class="mn flag"></i>Moğolistan</div>
                                                <div class="item" data-value="me"><i class="me flag"></i>Montenegro</div>
                                                <div class="item" data-value="ms"><i class="ms flag"></i>Montserrat</div>
                                                <div class="item" data-value="ma"><i class="ma flag"></i>Fas</div>
                                                <div class="item" data-value="mz"><i class="mz flag"></i>Mozambik</div>
                                                <div class="item" data-value="na"><i class="na flag"></i>Namibya</div>
                                                <div class="item" data-value="nr"><i class="nr flag"></i>Nauru</div>
                                                <div class="item" data-value="np"><i class="np flag"></i>Nepal</div>
                                                <div class="item" data-value="an"><i class="an flag"></i>Hollanda Antilleri
                                                </div>
                                                <div class="item" data-value="nl"><i class="nl flag"></i>Hollanda</div>
                                                <div class="item" data-value="nc"><i class="nc flag"></i>Yeni Kaledonya
                                                </div>
                                                <div class="item" data-value="pg"><i class="pg flag"></i>Yeni Gine</div>
                                                <div class="item" data-value="nz"><i class="nz flag"></i>Yeni Zellanda</div>
                                                <div class="item" data-value="ni"><i class="ni flag"></i>Nikaragua</div>
                                                <div class="item" data-value="ne"><i class="ne flag"></i>Nijer</div>
                                                <div class="item" data-value="ng"><i class="ng flag"></i>Nijerya</div>
                                                <div class="item" data-value="nu"><i class="nu flag"></i>Niue</div>
                                                <div class="item" data-value="nf"><i class="nf flag"></i>Norfolk Adaları
                                                </div>
                                                <div class="item" data-value="kp"><i class="kp flag"></i>Kuzey Kore</div>
                                                <div class="item" data-value="mp"><i class="mp flag"></i>Kuzey Mariana
                                                    Islands
                                                </div>
                                                <div class="item" data-value="no"><i class="no flag"></i>Norveç</div>
                                                <div class="item" data-value="om"><i class="om flag"></i>Umman</div>
                                                <div class="item" data-value="pk"><i class="pk flag"></i>Pakistan</div>
                                                <div class="item" data-value="pw"><i class="pw flag"></i>Palau</div>
                                                <div class="item" data-value="ps"><i class="ps flag"></i>Filistin</div>
                                                <div class="item" data-value="pa"><i class="pa flag"></i>Panama</div>
                                                <div class="item" data-value="py"><i class="py flag"></i>Paraguay</div>
                                                <div class="item" data-value="pe"><i class="pe flag"></i>Peru</div>
                                                <div class="item" data-value="ph"><i class="ph flag"></i>Filipinler</div>
                                                <div class="item" data-value="pn"><i class="pn flag"></i>Pitcairn Adaları
                                                </div>
                                                <div class="item" data-value="pl"><i class="pl flag"></i>Polonya</div>
                                                <div class="item" data-value="pt"><i class="pt flag"></i>Portekiz</div>
                                                <div class="item" data-value="pr"><i class="pr flag"></i>Porto Rico</div>
                                                <div class="item" data-value="qa"><i class="qa flag"></i>Katar</div>
                                                <div class="item" data-value="ro"><i class="ro flag"></i>Romanya</div>
                                                <div class="item" data-value="ru"><i class="ru flag"></i>Rusya</div>
                                                <div class="item" data-value="rw"><i class="rw flag"></i>Ruanda</div>
                                                <div class="item" data-value="sh"><i class="sh flag"></i>Saint Helena</div>
                                                <div class="item" data-value="kn"><i class="kn flag"></i>Saint Kitts and
                                                    Nevis
                                                </div>
                                                <div class="item" data-value="lc"><i class="lc flag"></i>Saint Lucia</div>
                                                <div class="item" data-value="pm"><i class="pm flag"></i>Saint Pierre</div>
                                                <div class="item" data-value="vc"><i class="vc flag"></i>Saint Vincent</div>
                                                <div class="item" data-value="ws"><i class="ws flag"></i>Samoa</div>
                                                <div class="item" data-value="sm"><i class="sm flag"></i>San Marino</div>
                                                <div class="item" data-value="gs"><i class="gs flag"></i>Sandwich Adaları
                                                </div>
                                                <div class="item" data-value="st"><i class="st flag"></i>Sao Tome</div>
                                                <div class="item" data-value="sa"><i class="sa flag"></i>Suudi Arabistan
                                                </div>
                                                <div class="item" data-value="sn"><i class="sn flag"></i>Senegal</div>
                                                <div class="item" data-value="cs"><i class="cs flag"></i>Sırbistan</div>
                                                <div class="item" data-value="sc"><i class="sc flag"></i>Seychelles</div>
                                                <div class="item" data-value="sl"><i class="sl flag"></i>Sierra Leone</div>
                                                <div class="item" data-value="sg"><i class="sg flag"></i>Singapur</div>
                                                <div class="item" data-value="sk"><i class="sk flag"></i>Slovakya</div>
                                                <div class="item" data-value="si"><i class="si flag"></i>Slovenya</div>
                                                <div class="item" data-value="sb"><i class="sb flag"></i>Solomon Adaları
                                                </div>
                                                <div class="item" data-value="so"><i class="so flag"></i>Somali</div>
                                                <div class="item" data-value="za"><i class="za flag"></i>Güney Afrika</div>
                                                <div class="item" data-value="kr"><i class="kr flag"></i>Güney Kore</div>
                                                <div class="item" data-value="es"><i class="es flag"></i>İspaya</div>
                                                <div class="item" data-value="lk"><i class="lk flag"></i>Sri Lanka</div>
                                                <div class="item" data-value="sd"><i class="sd flag"></i>Sudan</div>
                                                <div class="item" data-value="sr"><i class="sr flag"></i>Suriname</div>
                                                <div class="item" data-value="sj"><i class="sj flag"></i>Svalbard</div>
                                                <div class="item" data-value="sz"><i class="sz flag"></i>Svaziland</div>
                                                <div class="item" data-value="se"><i class="se flag"></i>İsveç</div>
                                                <div class="item" data-value="ch"><i class="ch flag"></i>İsviçre</div>
                                                <div class="item" data-value="sy"><i class="sy flag"></i>Suriye</div>
                                                <div class="item" data-value="tw"><i class="tw flag"></i>Tayvan</div>
                                                <div class="item" data-value="tj"><i class="tj flag"></i>Tajikistan</div>
                                                <div class="item" data-value="tz"><i class="tz flag"></i>Tanzanya</div>
                                                <div class="item" data-value="th"><i class="th flag"></i>Tayland</div>
                                                <div class="item" data-value="tl"><i class="tl flag"></i>Timorleste</div>
                                                <div class="item" data-value="tg"><i class="tg flag"></i>Togo</div>
                                                <div class="item" data-value="tk"><i class="tk flag"></i>Tokelo</div>
                                                <div class="item" data-value="to"><i class="to flag"></i>Tonga</div>
                                                <div class="item" data-value="tt"><i class="tt flag"></i>Trinidad</div>
                                                <div class="item" data-value="tn"><i class="tn flag"></i>Tunus</div>
                                                <div class="item" data-value="tr"><i class="tr flag"></i>Türkiye</div>
                                                <div class="item" data-value="tm"><i class="tm flag"></i>Türkmenistan</div>
                                                <div class="item" data-value="tv"><i class="tv flag"></i>Tuvalu</div>
                                                <div class="item" data-value="ug"><i class="ug flag"></i>Uganda</div>
                                                <div class="item" data-value="ua"><i class="ua flag"></i>Ukranya</div>
                                                <div class="item" data-value="ae"><i class="ae flag"></i>Birleşik Arap
                                                    Emirliği
                                                </div>
                                                <div class="item" data-value="us"><i class="us flag"></i>Amerika Birleşik
                                                    Devletleri
                                                </div>
                                                <div class="item" data-value="uy"><i class="uy flag"></i>Uruguay</div>
                                                <div class="item" data-value="um"><i class="um flag"></i>Us Minor Adaları
                                                </div>
                                                <div class="item" data-value="vi"><i class="vi flag"></i>Us Virgin Adaları
                                                </div>
                                                <div class="item" data-value="uz"><i class="uz flag"></i>Özbekistan</div>
                                                <div class="item" data-value="vu"><i class="vu flag"></i>Vanuatu</div>
                                                <div class="item" data-value="va"><i class="va flag"></i>Vatikan</div>
                                                <div class="item" data-value="ve"><i class="ve flag"></i>Venezuela</div>
                                                <div class="item" data-value="vn"><i class="vn flag"></i>Vietnam</div>
                                                <div class="item" data-value="wf"><i class="wf flag"></i>Wallis and Futuna
                                                </div>
                                                <div class="item" data-value="eh"><i class="eh flag"></i>Batı Sahra</div>
                                                <div class="item" data-value="ye"><i class="ye flag"></i>Yemen</div>
                                                <div class="item" data-value="zm"><i class="zm flag"></i>Zambiya</div>
                                                <div class="item" data-value="zw"><i class="zw flag"></i>Zimbabve</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Şehir</label>
                                        <input name="city" type="text" placeholder="Şehir">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İlçe</label>
                                        <input name="state" type="text" placeholder="İlçe">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Semt</label>
                                        <input name="district" type="text" placeholder="Semt">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Kargo Adresi</label>
                                        <textarea name="cargoAddressName" rows="2"
                                                  placeholder="Mahalle, sokak, cadde ve diğer bilgilerinizi giriniz"
                                                  maxlength="106"></textarea>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="ui checkbox">
                                        <input checked="checked" type="checkbox" name="example" id="checkbox-id">
                                        <label>Fatura adresim kargo adresim ile aynı olsun.</label>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Posta Kodu</label>
                                        <input name="postCode" type="text" placeholder="PK" maxlength="51">
                                    </div>
                                </div>

                                <h4 id="contact-information-header-id" class="ui dividing header">İletişim Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Telefon</label>
                                        <input name="phoneNumber" type="text" placeholder="Telefon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="shipping-summary-id" class=" left floated three wide computer wide tablet column">
                    <div id="fixed-part-id">
                        <div class="ui segment">
                            <h3 class="ui header">
                                <div id="shipping-summary-title-id" class="ui dividing header">
                                    Sipariş Özeti
                                    <div class="sub header"><?php echo $totalProductCount?> ürün</div>
                                </div>
                            </h3>
                            <h3 class="ui header">
                                <div class="sub header">Ürünler Toplamı(KDV Dahil)</div>
                                <div class="ui header">
                                    <i class="lira icon"></i>
                                    <?php echo $totalPrice; ?>
                                </div>
                                <div class="sub header">Kargo Ücreti</div>
                                <div class="ui header">
                                    <i class="lira  icon"></i>
                                    <?php echo $cargoPrice; ?>
                                </div>
                                <div class="sub header">Ödenecek Tutar</div>
                                <div class="ui header">
                                    <i class="lira  icon"></i>
                                    <?php echo $fullPrice; ?>
                                </div>
                            </h3>
                                <div class="ui submit button"id="devam-et-butonu">Devam Et
                                    <i class="right arrow icon"></i>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="ui modal" id="billAddModal">
        <form class="ui large form" id="addBillForm">
            <div class="ui stackable left floated grid" id="centered-information-menu">
                <div class="row">
                    <div class="two wide column"></div>
                    <div id="shipping-information-table-id" class="center aligned seven wide column">
                        <!-- <form class="ui large form" id="login-form"> -->
                        <div id="modal-segment-id" class="ui segment">
                            <div class="content">
                                <h2 class="ui header">
                                    <div class="ui dividing header">
                                        Bu Adresi Kullanın
                                        <div class="sub header">
                                            Fatura bilgileri için lütfen aşağıdaki formu doldurunuz.
                                        </div>
                                    </div>
                                </h2>

                                <h4 id="personal-information-header-id" class="ui dividing header">Kişisel Bilgiler</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İsim</label>
                                        <input name="billFirstName" type="text" placeholder="İsim" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Soyisim</label>
                                        <input name="billLastName" type="text" placeholder="Soyisim" maxlength="51">
                                    </div>
                                </div>

                                <h4 id="shipping-information-header-id" class="ui dividing header">Fatura Adresi
                                    Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Adres Adı</label>
                                        <input name="billAddressName" type="text" placeholder="Adres Adı" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Ülke</label>
                                        <div class="ui fluid search selection dropdown" id="country-selector-2">
                                            <input type="hidden" name="billCountry">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">
                                                Fatura Adresi Seçiniz
                                            </div>
                                            <div class="menu">
                                                <div class="item" data-value="af"><i class="af flag"></i>Afganistan</div>
                                                <div class="item" data-value="ax"><i class="ax flag"></i>Aland Adaları</div>
                                                <div class="item" data-value="al"><i class="al flag"></i>Arnavutluk</div>
                                                <div class="item" data-value="dz"><i class="dz flag"></i>Cezayir</div>
                                                <div class="item" data-value="as"><i class="as flag"></i>Amerikan Samoası
                                                </div>
                                                <div class="item" data-value="ad"><i class="ad flag"></i>Andora</div>
                                                <div class="item" data-value="ao"><i class="ao flag"></i>Angola</div>
                                                <div class="item" data-value="ai"><i class="ai flag"></i>Anguilla</div>
                                                <div class="item" data-value="ag"><i class="ag flag"></i>Antigua</div>
                                                <div class="item" data-value="ar"><i class="ar flag"></i>Arjantin</div>
                                                <div class="item" data-value="am"><i class="am flag"></i>Ermenistan</div>
                                                <div class="item" data-value="aw"><i class="aw flag"></i>Aruba</div>
                                                <div class="item" data-value="au"><i class="au flag"></i>Avustralya</div>
                                                <div class="item" data-value="at"><i class="at flag"></i>Avusturya</div>
                                                <div class="item" data-value="az"><i class="az flag"></i>Azerbeycan</div>
                                                <div class="item" data-value="bs"><i class="bs flag"></i>Bahamalar</div>
                                                <div class="item" data-value="bh"><i class="bh flag"></i>Bahreyn</div>
                                                <div class="item" data-value="bd"><i class="bd flag"></i>Bangladeş</div>
                                                <div class="item" data-value="bb"><i class="bb flag"></i>Barbados</div>
                                                <div class="item" data-value="by"><i class="by flag"></i>Belarus(Beyaz
                                                    Rusya)
                                                </div>
                                                <div class="item" data-value="be"><i class="be flag"></i>Belçika</div>
                                                <div class="item" data-value="bz"><i class="bz flag"></i>Belize</div>
                                                <div class="item" data-value="bj"><i class="bj flag"></i>Benin</div>
                                                <div class="item" data-value="bm"><i class="bm flag"></i>Bermuda</div>
                                                <div class="item" data-value="bt"><i class="bt flag"></i>Butan</div>
                                                <div class="item" data-value="bo"><i class="bo flag"></i>Bolivya</div>
                                                <div class="item" data-value="ba"><i class="ba flag"></i>Bosna</div>
                                                <div class="item" data-value="bw"><i class="bw flag"></i>Botsvana</div>
                                                <div class="item" data-value="bv"><i class="bv flag"></i>Buvet Adaları</div>
                                                <div class="item" data-value="br"><i class="br flag"></i>Brezilya</div>
                                                <div class="item" data-value="vg"><i class="vg flag"></i>British Virgin
                                                    Adaları
                                                </div>
                                                <div class="item" data-value="bn"><i class="bn flag"></i>Bruney</div>
                                                <div class="item" data-value="bg"><i class="bg flag"></i>Bulgaristan</div>
                                                <div class="item" data-value="bf"><i class="bf flag"></i>Burkina Faso</div>
                                                <div class="item" data-value="mm"><i class="mm flag"></i>Burma</div>
                                                <div class="item" data-value="bi"><i class="bi flag"></i>Burundi</div>
                                                <div class="item" data-value="tc"><i class="tc flag"></i>Caicos Adaları
                                                </div>
                                                <div class="item" data-value="kh"><i class="kh flag"></i>Kamboçya</div>
                                                <div class="item" data-value="cm"><i class="cm flag"></i>Kamerun</div>
                                                <div class="item" data-value="ca"><i class="ca flag"></i>Kanada</div>
                                                <div class="item" data-value="cv"><i class="cv flag"></i>Cape Verde</div>
                                                <div class="item" data-value="ky"><i class="ky flag"></i>Cayman Adaları
                                                </div>
                                                <div class="item" data-value="cf"><i class="cf flag"></i>Orta Afrika
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="td"><i class="td flag"></i>Çad</div>
                                                <div class="item" data-value="cl"><i class="cl flag"></i>Şili</div>
                                                <div class="item" data-value="cn"><i class="cn flag"></i>Çin</div>
                                                <div class="item" data-value="cx"><i class="cx flag"></i>Noel Adası</div>
                                                <div class="item" data-value="cc"><i class="cc flag"></i>Cocos Adaları</div>
                                                <div class="item" data-value="co"><i class="co flag"></i>Kolombiya</div>
                                                <div class="item" data-value="km"><i class="km flag"></i>Komoros</div>
                                                <div class="item" data-value="cg"><i class="cg flag"></i>Kongo Brazzaville
                                                </div>
                                                <div class="item" data-value="cd"><i class="cd flag"></i>Kongo</div>
                                                <div class="item" data-value="ck"><i class="ck flag"></i>Cook Adaları</div>
                                                <div class="item" data-value="cr"><i class="cr flag"></i>Kosta Rika</div>
                                                <div class="item" data-value="ci"><i class="ci flag"></i>Fildişi Sahili
                                                </div>
                                                <div class="item" data-value="hr"><i class="hr flag"></i>Hırvatistan</div>
                                                <div class="item" data-value="cu"><i class="cu flag"></i>Kuba</div>
                                                <div class="item" data-value="cy"><i class="cy flag"></i>Güney Kıbrıs Rum
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="cz"><i class="cz flag"></i>Çekya</div>
                                                <div class="item" data-value="dk"><i class="dk flag"></i>Danimarka</div>
                                                <div class="item" data-value="dj"><i class="dj flag"></i>Cibuti</div>
                                                <div class="item" data-value="dm"><i class="dm flag"></i>Dominica</div>
                                                <div class="item" data-value="do"><i class="do flag"></i>Dominik Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="ec"><i class="ec flag"></i>Elvador</div>
                                                <div class="item" data-value="eg"><i class="eg flag"></i>Mısır</div>
                                                <div class="item" data-value="sv"><i class="sv flag"></i>El Salvador</div>
                                                <div class="item" data-value="gb"><i class="gb flag"></i>İngiltere</div>
                                                <div class="item" data-value="gq"><i class="gq flag"></i>Ekvator Ginesi
                                                </div>
                                                <div class="item" data-value="er"><i class="er flag"></i>Eritre</div>
                                                <div class="item" data-value="ee"><i class="ee flag"></i>Estonya</div>
                                                <div class="item" data-value="et"><i class="et flag"></i>Etyopya</div>
                                                <div class="item" data-value="eu"><i class="eu flag"></i>Avrupa Birliği
                                                </div>
                                                <div class="item" data-value="fk"><i class="fk flag"></i>Falkland Adaları
                                                </div>
                                                <div class="item" data-value="fo"><i class="fo flag"></i>Faroe Adaları</div>
                                                <div class="item" data-value="fj"><i class="fj flag"></i>Fiji</div>
                                                <div class="item" data-value="fi"><i class="fi flag"></i>Finlandiya</div>
                                                <div class="item" data-value="fr"><i class="fr flag"></i>Fransa</div>
                                                <div class="item" data-value="gf"><i class="gf flag"></i>Fransız Guyanası
                                                </div>
                                                <div class="item" data-value="pf"><i class="pf flag"></i>Fransız Polinezyası
                                                </div>
                                                <div class="item" data-value="tf"><i class="tf flag"></i>Fransız Bölgeleri
                                                </div>
                                                <div class="item" data-value="ga"><i class="ga flag"></i>Gabon</div>
                                                <div class="item" data-value="gm"><i class="gm flag"></i>Gambiya</div>
                                                <div class="item" data-value="ge"><i class="ge flag"></i>Gürcistan</div>
                                                <div class="item" data-value="de"><i class="de flag"></i>Almanya</div>
                                                <div class="item" data-value="gh"><i class="gh flag"></i>Gana</div>
                                                <div class="item" data-value="gi"><i class="gi flag"></i>Cebelitarık</div>
                                                <div class="item" data-value="gr"><i class="gr flag"></i>Yunanistan</div>
                                                <div class="item" data-value="gl"><i class="gl flag"></i>Grönland</div>
                                                <div class="item" data-value="gd"><i class="gd flag"></i>Grenada</div>
                                                <div class="item" data-value="gp"><i class="gp flag"></i>Guadeloupe</div>
                                                <div class="item" data-value="gu"><i class="gu flag"></i>Guam</div>
                                                <div class="item" data-value="gt"><i class="gt flag"></i>Guatemala</div>
                                                <div class="item" data-value="gw"><i class="gw flag"></i>Guinea-Bissau</div>
                                                <div class="item" data-value="gn"><i class="gn flag"></i>Gine</div>
                                                <div class="item" data-value="gy"><i class="gy flag"></i>Guyana</div>
                                                <div class="item" data-value="ht"><i class="ht flag"></i>Haiti</div>
                                                <div class="item" data-value="hm"><i class="hm flag"></i>Heard Adaları</div>
                                                <div class="item" data-value="hn"><i class="hn flag"></i>Honduras</div>
                                                <div class="item" data-value="hk"><i class="hk flag"></i>Hong Kong</div>
                                                <div class="item" data-value="hu"><i class="hu flag"></i>Macaristan</div>
                                                <div class="item" data-value="is"><i class="is flag"></i>İzlanda</div>
                                                <div class="item" data-value="in"><i class="in flag"></i>Hindistan</div>
                                                <div class="item" data-value="io"><i class="io flag"></i>Hint Okyanusu
                                                    Bölgesi
                                                </div>
                                                <div class="item" data-value="id"><i class="id flag"></i>Endonezya</div>
                                                <div class="item" data-value="ir"><i class="ir flag"></i>İran</div>
                                                <div class="item" data-value="iq"><i class="iq flag"></i>Irak</div>
                                                <div class="item" data-value="ie"><i class="ie flag"></i>İrlanda</div>
                                                <div class="item" data-value="il"><i class="il flag"></i>İsrail</div>
                                                <div class="item" data-value="it"><i class="it flag"></i>İtalya</div>
                                                <div class="item" data-value="jm"><i class="jm flag"></i>Jameyika</div>
                                                <div class="item" data-value="jp"><i class="jp flag"></i>Japonya</div>
                                                <div class="item" data-value="jo"><i class="jo flag"></i>Ürdün</div>
                                                <div class="item" data-value="kz"><i class="kz flag"></i>Kazakistan</div>
                                                <div class="item" data-value="ke"><i class="ke flag"></i>Kenya</div>
                                                <div class="item" data-value="ki"><i class="ki flag"></i>Kiribati</div>
                                                <div class="item" data-value="kw"><i class="kw flag"></i>Kuveyt</div>
                                                <div class="item" data-value="kg"><i class="kg flag"></i>Kırgızistan</div>
                                                <div class="item" data-value="la"><i class="la flag"></i>Laos</div>
                                                <div class="item" data-value="lv"><i class="lv flag"></i>Letonya</div>
                                                <div class="item" data-value="lb"><i class="lb flag"></i>Lübnan</div>
                                                <div class="item" data-value="ls"><i class="ls flag"></i>Lesotho</div>
                                                <div class="item" data-value="lr"><i class="lr flag"></i>Liberya</div>
                                                <div class="item" data-value="ly"><i class="ly flag"></i>Libya</div>
                                                <div class="item" data-value="li"><i class="li flag"></i>Lichtenstein</div>
                                                <div class="item" data-value="lt"><i class="lt flag"></i>Litvanya</div>
                                                <div class="item" data-value="lu"><i class="lu flag"></i>Luxembourg</div>
                                                <div class="item" data-value="mo"><i class="mo flag"></i>Macau</div>
                                                <div class="item" data-value="mk"><i class="mk flag"></i>Makedonya</div>
                                                <div class="item" data-value="mg"><i class="mg flag"></i>Madagaskar</div>
                                                <div class="item" data-value="mw"><i class="mw flag"></i>Malawi</div>
                                                <div class="item" data-value="my"><i class="my flag"></i>Malezya</div>
                                                <div class="item" data-value="mv"><i class="mv flag"></i>Maldivler</div>
                                                <div class="item" data-value="ml"><i class="ml flag"></i>Mali</div>
                                                <div class="item" data-value="mt"><i class="mt flag"></i>Malta</div>
                                                <div class="item" data-value="mh"><i class="mh flag"></i>Marshall Adaları
                                                </div>
                                                <div class="item" data-value="mq"><i class="mq flag"></i>Martinik</div>
                                                <div class="item" data-value="mr"><i class="mr flag"></i>Moritanya</div>
                                                <div class="item" data-value="mu"><i class="mu flag"></i>Mauritius</div>
                                                <div class="item" data-value="yt"><i class="yt flag"></i>Mayotte</div>
                                                <div class="item" data-value="mx"><i class="mx flag"></i>Meksica</div>
                                                <div class="item" data-value="fm"><i class="fm flag"></i>Mikronezya</div>
                                                <div class="item" data-value="md"><i class="md flag"></i>Moldova</div>
                                                <div class="item" data-value="mc"><i class="mc flag"></i>Monaco</div>
                                                <div class="item" data-value="mn"><i class="mn flag"></i>Moğolistan</div>
                                                <div class="item" data-value="me"><i class="me flag"></i>Montenegro</div>
                                                <div class="item" data-value="ms"><i class="ms flag"></i>Montserrat</div>
                                                <div class="item" data-value="ma"><i class="ma flag"></i>Fas</div>
                                                <div class="item" data-value="mz"><i class="mz flag"></i>Mozambik</div>
                                                <div class="item" data-value="na"><i class="na flag"></i>Namibya</div>
                                                <div class="item" data-value="nr"><i class="nr flag"></i>Nauru</div>
                                                <div class="item" data-value="np"><i class="np flag"></i>Nepal</div>
                                                <div class="item" data-value="an"><i class="an flag"></i>Hollanda Antilleri
                                                </div>
                                                <div class="item" data-value="nl"><i class="nl flag"></i>Hollanda</div>
                                                <div class="item" data-value="nc"><i class="nc flag"></i>Yeni Kaledonya
                                                </div>
                                                <div class="item" data-value="pg"><i class="pg flag"></i>Yeni Gine</div>
                                                <div class="item" data-value="nz"><i class="nz flag"></i>Yeni Zellanda</div>
                                                <div class="item" data-value="ni"><i class="ni flag"></i>Nikaragua</div>
                                                <div class="item" data-value="ne"><i class="ne flag"></i>Nijer</div>
                                                <div class="item" data-value="ng"><i class="ng flag"></i>Nijerya</div>
                                                <div class="item" data-value="nu"><i class="nu flag"></i>Niue</div>
                                                <div class="item" data-value="nf"><i class="nf flag"></i>Norfolk Adaları
                                                </div>
                                                <div class="item" data-value="kp"><i class="kp flag"></i>Kuzey Kore</div>
                                                <div class="item" data-value="mp"><i class="mp flag"></i>Kuzey Mariana
                                                    Islands
                                                </div>
                                                <div class="item" data-value="no"><i class="no flag"></i>Norveç</div>
                                                <div class="item" data-value="om"><i class="om flag"></i>Umman</div>
                                                <div class="item" data-value="pk"><i class="pk flag"></i>Pakistan</div>
                                                <div class="item" data-value="pw"><i class="pw flag"></i>Palau</div>
                                                <div class="item" data-value="ps"><i class="ps flag"></i>Filistin</div>
                                                <div class="item" data-value="pa"><i class="pa flag"></i>Panama</div>
                                                <div class="item" data-value="py"><i class="py flag"></i>Paraguay</div>
                                                <div class="item" data-value="pe"><i class="pe flag"></i>Peru</div>
                                                <div class="item" data-value="ph"><i class="ph flag"></i>Filipinler</div>
                                                <div class="item" data-value="pn"><i class="pn flag"></i>Pitcairn Adaları
                                                </div>
                                                <div class="item" data-value="pl"><i class="pl flag"></i>Polonya</div>
                                                <div class="item" data-value="pt"><i class="pt flag"></i>Portekiz</div>
                                                <div class="item" data-value="pr"><i class="pr flag"></i>Porto Rico</div>
                                                <div class="item" data-value="qa"><i class="qa flag"></i>Katar</div>
                                                <div class="item" data-value="ro"><i class="ro flag"></i>Romanya</div>
                                                <div class="item" data-value="ru"><i class="ru flag"></i>Rusya</div>
                                                <div class="item" data-value="rw"><i class="rw flag"></i>Ruanda</div>
                                                <div class="item" data-value="sh"><i class="sh flag"></i>Saint Helena</div>
                                                <div class="item" data-value="kn"><i class="kn flag"></i>Saint Kitts and
                                                    Nevis
                                                </div>
                                                <div class="item" data-value="lc"><i class="lc flag"></i>Saint Lucia</div>
                                                <div class="item" data-value="pm"><i class="pm flag"></i>Saint Pierre</div>
                                                <div class="item" data-value="vc"><i class="vc flag"></i>Saint Vincent</div>
                                                <div class="item" data-value="ws"><i class="ws flag"></i>Samoa</div>
                                                <div class="item" data-value="sm"><i class="sm flag"></i>San Marino</div>
                                                <div class="item" data-value="gs"><i class="gs flag"></i>Sandwich Adaları
                                                </div>
                                                <div class="item" data-value="st"><i class="st flag"></i>Sao Tome</div>
                                                <div class="item" data-value="sa"><i class="sa flag"></i>Suudi Arabistan
                                                </div>
                                                <div class="item" data-value="sn"><i class="sn flag"></i>Senegal</div>
                                                <div class="item" data-value="cs"><i class="cs flag"></i>Sırbistan</div>
                                                <div class="item" data-value="sc"><i class="sc flag"></i>Seychelles</div>
                                                <div class="item" data-value="sl"><i class="sl flag"></i>Sierra Leone</div>
                                                <div class="item" data-value="sg"><i class="sg flag"></i>Singapur</div>
                                                <div class="item" data-value="sk"><i class="sk flag"></i>Slovakya</div>
                                                <div class="item" data-value="si"><i class="si flag"></i>Slovenya</div>
                                                <div class="item" data-value="sb"><i class="sb flag"></i>Solomon Adaları
                                                </div>
                                                <div class="item" data-value="so"><i class="so flag"></i>Somali</div>
                                                <div class="item" data-value="za"><i class="za flag"></i>Güney Afrika</div>
                                                <div class="item" data-value="kr"><i class="kr flag"></i>Güney Kore</div>
                                                <div class="item" data-value="es"><i class="es flag"></i>İspaya</div>
                                                <div class="item" data-value="lk"><i class="lk flag"></i>Sri Lanka</div>
                                                <div class="item" data-value="sd"><i class="sd flag"></i>Sudan</div>
                                                <div class="item" data-value="sr"><i class="sr flag"></i>Suriname</div>
                                                <div class="item" data-value="sj"><i class="sj flag"></i>Svalbard</div>
                                                <div class="item" data-value="sz"><i class="sz flag"></i>Svaziland</div>
                                                <div class="item" data-value="se"><i class="se flag"></i>İsveç</div>
                                                <div class="item" data-value="ch"><i class="ch flag"></i>İsviçre</div>
                                                <div class="item" data-value="sy"><i class="sy flag"></i>Suriye</div>
                                                <div class="item" data-value="tw"><i class="tw flag"></i>Tayvan</div>
                                                <div class="item" data-value="tj"><i class="tj flag"></i>Tajikistan</div>
                                                <div class="item" data-value="tz"><i class="tz flag"></i>Tanzanya</div>
                                                <div class="item" data-value="th"><i class="th flag"></i>Tayland</div>
                                                <div class="item" data-value="tl"><i class="tl flag"></i>Timorleste</div>
                                                <div class="item" data-value="tg"><i class="tg flag"></i>Togo</div>
                                                <div class="item" data-value="tk"><i class="tk flag"></i>Tokelo</div>
                                                <div class="item" data-value="to"><i class="to flag"></i>Tonga</div>
                                                <div class="item" data-value="tt"><i class="tt flag"></i>Trinidad</div>
                                                <div class="item" data-value="tn"><i class="tn flag"></i>Tunus</div>
                                                <div class="item" data-value="tr"><i class="tr flag"></i>Türkiye</div>
                                                <div class="item" data-value="tm"><i class="tm flag"></i>Türkmenistan</div>
                                                <div class="item" data-value="tv"><i class="tv flag"></i>Tuvalu</div>
                                                <div class="item" data-value="ug"><i class="ug flag"></i>Uganda</div>
                                                <div class="item" data-value="ua"><i class="ua flag"></i>Ukranya</div>
                                                <div class="item" data-value="ae"><i class="ae flag"></i>Birleşik Arap
                                                    Emirliği
                                                </div>
                                                <div class="item" data-value="us"><i class="us flag"></i>Amerika Birleşik
                                                    Devletleri
                                                </div>
                                                <div class="item" data-value="uy"><i class="uy flag"></i>Uruguay</div>
                                                <div class="item" data-value="um"><i class="um flag"></i>Us Minor Adaları
                                                </div>
                                                <div class="item" data-value="vi"><i class="vi flag"></i>Us Virgin Adaları
                                                </div>
                                                <div class="item" data-value="uz"><i class="uz flag"></i>Özbekistan</div>
                                                <div class="item" data-value="vu"><i class="vu flag"></i>Vanuatu</div>
                                                <div class="item" data-value="va"><i class="va flag"></i>Vatikan</div>
                                                <div class="item" data-value="ve"><i class="ve flag"></i>Venezuela</div>
                                                <div class="item" data-value="vn"><i class="vn flag"></i>Vietnam</div>
                                                <div class="item" data-value="wf"><i class="wf flag"></i>Wallis and Futuna
                                                </div>
                                                <div class="item" data-value="eh"><i class="eh flag"></i>Batı Sahra</div>
                                                <div class="item" data-value="ye"><i class="ye flag"></i>Yemen</div>
                                                <div class="item" data-value="zm"><i class="zm flag"></i>Zambiya</div>
                                                <div class="item" data-value="zw"><i class="zw flag"></i>Zimbabve</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Şehir</label>
                                        <input name="billCity" type="text" placeholder="Şehir">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İlçe</label>
                                        <input name="billState" type="text" placeholder="İlçe">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Semt</label>
                                        <input name="billDistrict" type="text" placeholder="Semt">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Posta Kodu</label>
                                        <input name="billPostCode" type="text" placeholder="PK" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Fatura Adresi</label>
                                        <textarea id="billAddress"name="billingAddressName" rows="2"
                                                  placeholder="Mahalle, sokak, cadde ve diğer bilgilerinizi giriniz"
                                                  maxlength="106"></textarea>
                                    </div>
                                </div>

                                <h4 id="contact-information-header-id" class="ui dividing header">İletişim Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Telefon</label>
                                        <input name="billPhoneNumber" type="text" placeholder="Telefon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="ui button" tabindex="0" id="okButtonForAddBillAddress">TAMAM</div>
            <div class="ui button" tabindex="0" id="cancelButtonForAddBillAddress">İPTAL</div>
        </div>
    </div>
    <div class="ui modal" id="cargoAddModal">
        <form class="ui large form" id="addCargoForm">
            <div class="ui stackable left floated grid" id="centered-information-menu">
                <div class="row">
                    <div class="two wide column"></div>
                    <div id="shipping-information-table-id" class="center aligned seven wide column">
                        <!-- <form class="ui large form" id="login-form"> -->
                        <div id="cargo-modal-segment-id" class="ui segment">
                            <div class="content">
                                <h2 class="ui header">
                                    <div class="ui dividing header">
                                        Bu Adresi Kullanın
                                        <div class="sub header">
                                            Fatura bilgileri için lütfen aşağıdaki formu doldurunuz.
                                        </div>
                                    </div>
                                </h2>

                                <h4 id="personal-information-header-id" class="ui dividing header">Kişisel Bilgiler</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İsim</label>
                                        <input name="cargoingFirstName" type="text" placeholder="İsim" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Soyisim</label>
                                        <input name="cargoLastName" type="text" placeholder="Soyisim" maxlength="51">
                                    </div>
                                </div>

                                <h4 id="shipping-information-header-id" class="ui dividing header">Kargo Adresi
                                    Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Adres Adı</label>
                                        <input name="cargoAddressName" type="text" placeholder="Adres Adı" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Ülke</label>
                                        <div class="ui fluid search selection dropdown" id="country-selector-3">
                                            <input type="hidden" name="cargoCountry">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">
                                                Kargo Adresi Seçiniz
                                            </div>
                                            <div class="menu">
                                                <div class="item" data-value="af"><i class="af flag"></i>Afganistan</div>
                                                <div class="item" data-value="ax"><i class="ax flag"></i>Aland Adaları</div>
                                                <div class="item" data-value="al"><i class="al flag"></i>Arnavutluk</div>
                                                <div class="item" data-value="dz"><i class="dz flag"></i>Cezayir</div>
                                                <div class="item" data-value="as"><i class="as flag"></i>Amerikan Samoası
                                                </div>
                                                <div class="item" data-value="ad"><i class="ad flag"></i>Andora</div>
                                                <div class="item" data-value="ao"><i class="ao flag"></i>Angola</div>
                                                <div class="item" data-value="ai"><i class="ai flag"></i>Anguilla</div>
                                                <div class="item" data-value="ag"><i class="ag flag"></i>Antigua</div>
                                                <div class="item" data-value="ar"><i class="ar flag"></i>Arjantin</div>
                                                <div class="item" data-value="am"><i class="am flag"></i>Ermenistan</div>
                                                <div class="item" data-value="aw"><i class="aw flag"></i>Aruba</div>
                                                <div class="item" data-value="au"><i class="au flag"></i>Avustralya</div>
                                                <div class="item" data-value="at"><i class="at flag"></i>Avusturya</div>
                                                <div class="item" data-value="az"><i class="az flag"></i>Azerbeycan</div>
                                                <div class="item" data-value="bs"><i class="bs flag"></i>Bahamalar</div>
                                                <div class="item" data-value="bh"><i class="bh flag"></i>Bahreyn</div>
                                                <div class="item" data-value="bd"><i class="bd flag"></i>Bangladeş</div>
                                                <div class="item" data-value="bb"><i class="bb flag"></i>Barbados</div>
                                                <div class="item" data-value="by"><i class="by flag"></i>Belarus(Beyaz
                                                    Rusya)
                                                </div>
                                                <div class="item" data-value="be"><i class="be flag"></i>Belçika</div>
                                                <div class="item" data-value="bz"><i class="bz flag"></i>Belize</div>
                                                <div class="item" data-value="bj"><i class="bj flag"></i>Benin</div>
                                                <div class="item" data-value="bm"><i class="bm flag"></i>Bermuda</div>
                                                <div class="item" data-value="bt"><i class="bt flag"></i>Butan</div>
                                                <div class="item" data-value="bo"><i class="bo flag"></i>Bolivya</div>
                                                <div class="item" data-value="ba"><i class="ba flag"></i>Bosna</div>
                                                <div class="item" data-value="bw"><i class="bw flag"></i>Botsvana</div>
                                                <div class="item" data-value="bv"><i class="bv flag"></i>Buvet Adaları</div>
                                                <div class="item" data-value="br"><i class="br flag"></i>Brezilya</div>
                                                <div class="item" data-value="vg"><i class="vg flag"></i>British Virgin
                                                    Adaları
                                                </div>
                                                <div class="item" data-value="bn"><i class="bn flag"></i>Bruney</div>
                                                <div class="item" data-value="bg"><i class="bg flag"></i>Bulgaristan</div>
                                                <div class="item" data-value="bf"><i class="bf flag"></i>Burkina Faso</div>
                                                <div class="item" data-value="mm"><i class="mm flag"></i>Burma</div>
                                                <div class="item" data-value="bi"><i class="bi flag"></i>Burundi</div>
                                                <div class="item" data-value="tc"><i class="tc flag"></i>Caicos Adaları
                                                </div>
                                                <div class="item" data-value="kh"><i class="kh flag"></i>Kamboçya</div>
                                                <div class="item" data-value="cm"><i class="cm flag"></i>Kamerun</div>
                                                <div class="item" data-value="ca"><i class="ca flag"></i>Kanada</div>
                                                <div class="item" data-value="cv"><i class="cv flag"></i>Cape Verde</div>
                                                <div class="item" data-value="ky"><i class="ky flag"></i>Cayman Adaları
                                                </div>
                                                <div class="item" data-value="cf"><i class="cf flag"></i>Orta Afrika
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="td"><i class="td flag"></i>Çad</div>
                                                <div class="item" data-value="cl"><i class="cl flag"></i>Şili</div>
                                                <div class="item" data-value="cn"><i class="cn flag"></i>Çin</div>
                                                <div class="item" data-value="cx"><i class="cx flag"></i>Noel Adası</div>
                                                <div class="item" data-value="cc"><i class="cc flag"></i>Cocos Adaları</div>
                                                <div class="item" data-value="co"><i class="co flag"></i>Kolombiya</div>
                                                <div class="item" data-value="km"><i class="km flag"></i>Komoros</div>
                                                <div class="item" data-value="cg"><i class="cg flag"></i>Kongo Brazzaville
                                                </div>
                                                <div class="item" data-value="cd"><i class="cd flag"></i>Kongo</div>
                                                <div class="item" data-value="ck"><i class="ck flag"></i>Cook Adaları</div>
                                                <div class="item" data-value="cr"><i class="cr flag"></i>Kosta Rika</div>
                                                <div class="item" data-value="ci"><i class="ci flag"></i>Fildişi Sahili
                                                </div>
                                                <div class="item" data-value="hr"><i class="hr flag"></i>Hırvatistan</div>
                                                <div class="item" data-value="cu"><i class="cu flag"></i>Kuba</div>
                                                <div class="item" data-value="cy"><i class="cy flag"></i>Güney Kıbrıs Rum
                                                    Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="cz"><i class="cz flag"></i>Çekya</div>
                                                <div class="item" data-value="dk"><i class="dk flag"></i>Danimarka</div>
                                                <div class="item" data-value="dj"><i class="dj flag"></i>Cibuti</div>
                                                <div class="item" data-value="dm"><i class="dm flag"></i>Dominica</div>
                                                <div class="item" data-value="do"><i class="do flag"></i>Dominik Cumhuriyeti
                                                </div>
                                                <div class="item" data-value="ec"><i class="ec flag"></i>Elvador</div>
                                                <div class="item" data-value="eg"><i class="eg flag"></i>Mısır</div>
                                                <div class="item" data-value="sv"><i class="sv flag"></i>El Salvador</div>
                                                <div class="item" data-value="gb"><i class="gb flag"></i>İngiltere</div>
                                                <div class="item" data-value="gq"><i class="gq flag"></i>Ekvator Ginesi
                                                </div>
                                                <div class="item" data-value="er"><i class="er flag"></i>Eritre</div>
                                                <div class="item" data-value="ee"><i class="ee flag"></i>Estonya</div>
                                                <div class="item" data-value="et"><i class="et flag"></i>Etyopya</div>
                                                <div class="item" data-value="eu"><i class="eu flag"></i>Avrupa Birliği
                                                </div>
                                                <div class="item" data-value="fk"><i class="fk flag"></i>Falkland Adaları
                                                </div>
                                                <div class="item" data-value="fo"><i class="fo flag"></i>Faroe Adaları</div>
                                                <div class="item" data-value="fj"><i class="fj flag"></i>Fiji</div>
                                                <div class="item" data-value="fi"><i class="fi flag"></i>Finlandiya</div>
                                                <div class="item" data-value="fr"><i class="fr flag"></i>Fransa</div>
                                                <div class="item" data-value="gf"><i class="gf flag"></i>Fransız Guyanası
                                                </div>
                                                <div class="item" data-value="pf"><i class="pf flag"></i>Fransız Polinezyası
                                                </div>
                                                <div class="item" data-value="tf"><i class="tf flag"></i>Fransız Bölgeleri
                                                </div>
                                                <div class="item" data-value="ga"><i class="ga flag"></i>Gabon</div>
                                                <div class="item" data-value="gm"><i class="gm flag"></i>Gambiya</div>
                                                <div class="item" data-value="ge"><i class="ge flag"></i>Gürcistan</div>
                                                <div class="item" data-value="de"><i class="de flag"></i>Almanya</div>
                                                <div class="item" data-value="gh"><i class="gh flag"></i>Gana</div>
                                                <div class="item" data-value="gi"><i class="gi flag"></i>Cebelitarık</div>
                                                <div class="item" data-value="gr"><i class="gr flag"></i>Yunanistan</div>
                                                <div class="item" data-value="gl"><i class="gl flag"></i>Grönland</div>
                                                <div class="item" data-value="gd"><i class="gd flag"></i>Grenada</div>
                                                <div class="item" data-value="gp"><i class="gp flag"></i>Guadeloupe</div>
                                                <div class="item" data-value="gu"><i class="gu flag"></i>Guam</div>
                                                <div class="item" data-value="gt"><i class="gt flag"></i>Guatemala</div>
                                                <div class="item" data-value="gw"><i class="gw flag"></i>Guinea-Bissau</div>
                                                <div class="item" data-value="gn"><i class="gn flag"></i>Gine</div>
                                                <div class="item" data-value="gy"><i class="gy flag"></i>Guyana</div>
                                                <div class="item" data-value="ht"><i class="ht flag"></i>Haiti</div>
                                                <div class="item" data-value="hm"><i class="hm flag"></i>Heard Adaları</div>
                                                <div class="item" data-value="hn"><i class="hn flag"></i>Honduras</div>
                                                <div class="item" data-value="hk"><i class="hk flag"></i>Hong Kong</div>
                                                <div class="item" data-value="hu"><i class="hu flag"></i>Macaristan</div>
                                                <div class="item" data-value="is"><i class="is flag"></i>İzlanda</div>
                                                <div class="item" data-value="in"><i class="in flag"></i>Hindistan</div>
                                                <div class="item" data-value="io"><i class="io flag"></i>Hint Okyanusu
                                                    Bölgesi
                                                </div>
                                                <div class="item" data-value="id"><i class="id flag"></i>Endonezya</div>
                                                <div class="item" data-value="ir"><i class="ir flag"></i>İran</div>
                                                <div class="item" data-value="iq"><i class="iq flag"></i>Irak</div>
                                                <div class="item" data-value="ie"><i class="ie flag"></i>İrlanda</div>
                                                <div class="item" data-value="il"><i class="il flag"></i>İsrail</div>
                                                <div class="item" data-value="it"><i class="it flag"></i>İtalya</div>
                                                <div class="item" data-value="jm"><i class="jm flag"></i>Jameyika</div>
                                                <div class="item" data-value="jp"><i class="jp flag"></i>Japonya</div>
                                                <div class="item" data-value="jo"><i class="jo flag"></i>Ürdün</div>
                                                <div class="item" data-value="kz"><i class="kz flag"></i>Kazakistan</div>
                                                <div class="item" data-value="ke"><i class="ke flag"></i>Kenya</div>
                                                <div class="item" data-value="ki"><i class="ki flag"></i>Kiribati</div>
                                                <div class="item" data-value="kw"><i class="kw flag"></i>Kuveyt</div>
                                                <div class="item" data-value="kg"><i class="kg flag"></i>Kırgızistan</div>
                                                <div class="item" data-value="la"><i class="la flag"></i>Laos</div>
                                                <div class="item" data-value="lv"><i class="lv flag"></i>Letonya</div>
                                                <div class="item" data-value="lb"><i class="lb flag"></i>Lübnan</div>
                                                <div class="item" data-value="ls"><i class="ls flag"></i>Lesotho</div>
                                                <div class="item" data-value="lr"><i class="lr flag"></i>Liberya</div>
                                                <div class="item" data-value="ly"><i class="ly flag"></i>Libya</div>
                                                <div class="item" data-value="li"><i class="li flag"></i>Lichtenstein</div>
                                                <div class="item" data-value="lt"><i class="lt flag"></i>Litvanya</div>
                                                <div class="item" data-value="lu"><i class="lu flag"></i>Luxembourg</div>
                                                <div class="item" data-value="mo"><i class="mo flag"></i>Macau</div>
                                                <div class="item" data-value="mk"><i class="mk flag"></i>Makedonya</div>
                                                <div class="item" data-value="mg"><i class="mg flag"></i>Madagaskar</div>
                                                <div class="item" data-value="mw"><i class="mw flag"></i>Malawi</div>
                                                <div class="item" data-value="my"><i class="my flag"></i>Malezya</div>
                                                <div class="item" data-value="mv"><i class="mv flag"></i>Maldivler</div>
                                                <div class="item" data-value="ml"><i class="ml flag"></i>Mali</div>
                                                <div class="item" data-value="mt"><i class="mt flag"></i>Malta</div>
                                                <div class="item" data-value="mh"><i class="mh flag"></i>Marshall Adaları
                                                </div>
                                                <div class="item" data-value="mq"><i class="mq flag"></i>Martinik</div>
                                                <div class="item" data-value="mr"><i class="mr flag"></i>Moritanya</div>
                                                <div class="item" data-value="mu"><i class="mu flag"></i>Mauritius</div>
                                                <div class="item" data-value="yt"><i class="yt flag"></i>Mayotte</div>
                                                <div class="item" data-value="mx"><i class="mx flag"></i>Meksica</div>
                                                <div class="item" data-value="fm"><i class="fm flag"></i>Mikronezya</div>
                                                <div class="item" data-value="md"><i class="md flag"></i>Moldova</div>
                                                <div class="item" data-value="mc"><i class="mc flag"></i>Monaco</div>
                                                <div class="item" data-value="mn"><i class="mn flag"></i>Moğolistan</div>
                                                <div class="item" data-value="me"><i class="me flag"></i>Montenegro</div>
                                                <div class="item" data-value="ms"><i class="ms flag"></i>Montserrat</div>
                                                <div class="item" data-value="ma"><i class="ma flag"></i>Fas</div>
                                                <div class="item" data-value="mz"><i class="mz flag"></i>Mozambik</div>
                                                <div class="item" data-value="na"><i class="na flag"></i>Namibya</div>
                                                <div class="item" data-value="nr"><i class="nr flag"></i>Nauru</div>
                                                <div class="item" data-value="np"><i class="np flag"></i>Nepal</div>
                                                <div class="item" data-value="an"><i class="an flag"></i>Hollanda Antilleri
                                                </div>
                                                <div class="item" data-value="nl"><i class="nl flag"></i>Hollanda</div>
                                                <div class="item" data-value="nc"><i class="nc flag"></i>Yeni Kaledonya
                                                </div>
                                                <div class="item" data-value="pg"><i class="pg flag"></i>Yeni Gine</div>
                                                <div class="item" data-value="nz"><i class="nz flag"></i>Yeni Zellanda</div>
                                                <div class="item" data-value="ni"><i class="ni flag"></i>Nikaragua</div>
                                                <div class="item" data-value="ne"><i class="ne flag"></i>Nijer</div>
                                                <div class="item" data-value="ng"><i class="ng flag"></i>Nijerya</div>
                                                <div class="item" data-value="nu"><i class="nu flag"></i>Niue</div>
                                                <div class="item" data-value="nf"><i class="nf flag"></i>Norfolk Adaları
                                                </div>
                                                <div class="item" data-value="kp"><i class="kp flag"></i>Kuzey Kore</div>
                                                <div class="item" data-value="mp"><i class="mp flag"></i>Kuzey Mariana
                                                    Islands
                                                </div>
                                                <div class="item" data-value="no"><i class="no flag"></i>Norveç</div>
                                                <div class="item" data-value="om"><i class="om flag"></i>Umman</div>
                                                <div class="item" data-value="pk"><i class="pk flag"></i>Pakistan</div>
                                                <div class="item" data-value="pw"><i class="pw flag"></i>Palau</div>
                                                <div class="item" data-value="ps"><i class="ps flag"></i>Filistin</div>
                                                <div class="item" data-value="pa"><i class="pa flag"></i>Panama</div>
                                                <div class="item" data-value="py"><i class="py flag"></i>Paraguay</div>
                                                <div class="item" data-value="pe"><i class="pe flag"></i>Peru</div>
                                                <div class="item" data-value="ph"><i class="ph flag"></i>Filipinler</div>
                                                <div class="item" data-value="pn"><i class="pn flag"></i>Pitcairn Adaları
                                                </div>
                                                <div class="item" data-value="pl"><i class="pl flag"></i>Polonya</div>
                                                <div class="item" data-value="pt"><i class="pt flag"></i>Portekiz</div>
                                                <div class="item" data-value="pr"><i class="pr flag"></i>Porto Rico</div>
                                                <div class="item" data-value="qa"><i class="qa flag"></i>Katar</div>
                                                <div class="item" data-value="ro"><i class="ro flag"></i>Romanya</div>
                                                <div class="item" data-value="ru"><i class="ru flag"></i>Rusya</div>
                                                <div class="item" data-value="rw"><i class="rw flag"></i>Ruanda</div>
                                                <div class="item" data-value="sh"><i class="sh flag"></i>Saint Helena</div>
                                                <div class="item" data-value="kn"><i class="kn flag"></i>Saint Kitts and
                                                    Nevis
                                                </div>
                                                <div class="item" data-value="lc"><i class="lc flag"></i>Saint Lucia</div>
                                                <div class="item" data-value="pm"><i class="pm flag"></i>Saint Pierre</div>
                                                <div class="item" data-value="vc"><i class="vc flag"></i>Saint Vincent</div>
                                                <div class="item" data-value="ws"><i class="ws flag"></i>Samoa</div>
                                                <div class="item" data-value="sm"><i class="sm flag"></i>San Marino</div>
                                                <div class="item" data-value="gs"><i class="gs flag"></i>Sandwich Adaları
                                                </div>
                                                <div class="item" data-value="st"><i class="st flag"></i>Sao Tome</div>
                                                <div class="item" data-value="sa"><i class="sa flag"></i>Suudi Arabistan
                                                </div>
                                                <div class="item" data-value="sn"><i class="sn flag"></i>Senegal</div>
                                                <div class="item" data-value="cs"><i class="cs flag"></i>Sırbistan</div>
                                                <div class="item" data-value="sc"><i class="sc flag"></i>Seychelles</div>
                                                <div class="item" data-value="sl"><i class="sl flag"></i>Sierra Leone</div>
                                                <div class="item" data-value="sg"><i class="sg flag"></i>Singapur</div>
                                                <div class="item" data-value="sk"><i class="sk flag"></i>Slovakya</div>
                                                <div class="item" data-value="si"><i class="si flag"></i>Slovenya</div>
                                                <div class="item" data-value="sb"><i class="sb flag"></i>Solomon Adaları
                                                </div>
                                                <div class="item" data-value="so"><i class="so flag"></i>Somali</div>
                                                <div class="item" data-value="za"><i class="za flag"></i>Güney Afrika</div>
                                                <div class="item" data-value="kr"><i class="kr flag"></i>Güney Kore</div>
                                                <div class="item" data-value="es"><i class="es flag"></i>İspaya</div>
                                                <div class="item" data-value="lk"><i class="lk flag"></i>Sri Lanka</div>
                                                <div class="item" data-value="sd"><i class="sd flag"></i>Sudan</div>
                                                <div class="item" data-value="sr"><i class="sr flag"></i>Suriname</div>
                                                <div class="item" data-value="sj"><i class="sj flag"></i>Svalbard</div>
                                                <div class="item" data-value="sz"><i class="sz flag"></i>Svaziland</div>
                                                <div class="item" data-value="se"><i class="se flag"></i>İsveç</div>
                                                <div class="item" data-value="ch"><i class="ch flag"></i>İsviçre</div>
                                                <div class="item" data-value="sy"><i class="sy flag"></i>Suriye</div>
                                                <div class="item" data-value="tw"><i class="tw flag"></i>Tayvan</div>
                                                <div class="item" data-value="tj"><i class="tj flag"></i>Tajikistan</div>
                                                <div class="item" data-value="tz"><i class="tz flag"></i>Tanzanya</div>
                                                <div class="item" data-value="th"><i class="th flag"></i>Tayland</div>
                                                <div class="item" data-value="tl"><i class="tl flag"></i>Timorleste</div>
                                                <div class="item" data-value="tg"><i class="tg flag"></i>Togo</div>
                                                <div class="item" data-value="tk"><i class="tk flag"></i>Tokelo</div>
                                                <div class="item" data-value="to"><i class="to flag"></i>Tonga</div>
                                                <div class="item" data-value="tt"><i class="tt flag"></i>Trinidad</div>
                                                <div class="item" data-value="tn"><i class="tn flag"></i>Tunus</div>
                                                <div class="item" data-value="tr"><i class="tr flag"></i>Türkiye</div>
                                                <div class="item" data-value="tm"><i class="tm flag"></i>Türkmenistan</div>
                                                <div class="item" data-value="tv"><i class="tv flag"></i>Tuvalu</div>
                                                <div class="item" data-value="ug"><i class="ug flag"></i>Uganda</div>
                                                <div class="item" data-value="ua"><i class="ua flag"></i>Ukranya</div>
                                                <div class="item" data-value="ae"><i class="ae flag"></i>Birleşik Arap
                                                    Emirliği
                                                </div>
                                                <div class="item" data-value="us"><i class="us flag"></i>Amerika Birleşik
                                                    Devletleri
                                                </div>
                                                <div class="item" data-value="uy"><i class="uy flag"></i>Uruguay</div>
                                                <div class="item" data-value="um"><i class="um flag"></i>Us Minor Adaları
                                                </div>
                                                <div class="item" data-value="vi"><i class="vi flag"></i>Us Virgin Adaları
                                                </div>
                                                <div class="item" data-value="uz"><i class="uz flag"></i>Özbekistan</div>
                                                <div class="item" data-value="vu"><i class="vu flag"></i>Vanuatu</div>
                                                <div class="item" data-value="va"><i class="va flag"></i>Vatikan</div>
                                                <div class="item" data-value="ve"><i class="ve flag"></i>Venezuela</div>
                                                <div class="item" data-value="vn"><i class="vn flag"></i>Vietnam</div>
                                                <div class="item" data-value="wf"><i class="wf flag"></i>Wallis and Futuna
                                                </div>
                                                <div class="item" data-value="eh"><i class="eh flag"></i>Batı Sahra</div>
                                                <div class="item" data-value="ye"><i class="ye flag"></i>Yemen</div>
                                                <div class="item" data-value="zm"><i class="zm flag"></i>Zambiya</div>
                                                <div class="item" data-value="zw"><i class="zw flag"></i>Zimbabve</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Şehir</label>
                                        <input name="cargoCity" type="text" placeholder="Şehir">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>İlçe</label>
                                        <input name="cargoState" type="text" placeholder="İlçe">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Semt</label>
                                        <input name="cargoDistrict" type="text" placeholder="Semt">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Posta Kodu</label>
                                        <input name="cargoPostCode" type="text" placeholder="PK" maxlength="51">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Fatura Adresi</label>
                                        <textarea id="cargoAddress"name="cargoAddressName" rows="2"
                                                  placeholder="Mahalle, sokak, cadde ve diğer bilgilerinizi giriniz"
                                                  maxlength="106"></textarea>
                                    </div>
                                </div>

                                <h4 id="contact-information-header-id" class="ui dividing header">İletişim Bilgileri</h4>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label>Telefon</label>
                                        <input name="cargoPhoneNumber" type="text" placeholder="Telefon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="ui button" tabindex="0" id="okButtonForAddCargoAddress">TAMAM</div>
            <div class="ui button" tabindex="0" id="cancelButtonForAddCargoAddress">İPTAL</div>
        </div>
    </div>
</div>