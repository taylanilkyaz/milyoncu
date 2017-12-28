<?php
global $queryHandler;
?>
<div id="page-header" style="margin-bottom: 0;">
    <h2 class="ui image header">
        <img src="<?php echo IMAGEPATH . 'logo.svg' ?>" class="image" id="logo">
        <div class="content" id="logo-text">
            <b><i>eKokenim</i></b>
        </div>
    </h2>
</div>
<div  class="desktop-only" id="top-menu-container">
    <ul id="top-menu">
        <a href="../home"><li>Ana Sayfa</li></a>
        <li>
            <span style="color: #c8ff00;">D</span>
            <span style="color: #5d90ff;">N</span>
            <span style="color: #ff287e;">A</span>
        </li>
        <a href="../order"><li>Satin Al</li></a>
        <a href="../contact"><li>Iletisim</li></a>
        <a href="../faqs"><li style="border-right: 1px solid #6d6f73;">SSS</li></a>
    </ul>
</div>
<div id="order-container">
    <h4>Sepetim</h4>
    <div id="quantity-container">
        <div class="ui stackable grid middle aligned">
            <div class="four wide column"><img src="<?php echo IMAGEPATH . 'kit.png' ?>" style="width: 100px;"></div>
            <div class="eight wide column">
                <h1 style="color: #e6517f;">eKokenim DNA Seti</h1>
                <p class="quantityP">
                    Kit basi <b>80&#8378;</b><br/>
                    Kit sayisi:
                    <select id="quantity" style="margin-left: 5px;height: 20px;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </p>
            </div>
            <div class="four wide column">
                <p class="quantityP">
                    <b>TUTAR</b><br/>
                    <i id="kits-cost">80&#8378;</i>
                </p>
            </div>
        </div>
        <div>
            <hr class="quantityD" noshade/>
            <div class="ui stackable grid middle aligned">
                <div class="twelve wide column">
                    <p class="quantityP">
                        <b>Gonderim Bedeli</b><br/>
                        <i>Tahmini 5-10 gun</i>
                    </p>
                </div>
                <div class="four wide column">
                    <p class="quantityP"><i>20&#8378;</i></p>
                </div>
            </div>
            <hr class="quantityD" noshade/>
            <div class="ui stackable grid middle aligned">
                <div class="twelve wide column">
                    <p class="quantityP">
                        <b>TOPLAM</b>
                    </p>
                </div>
                <div class="four wide column">
                    <h3><b id="quantity-total">100&#8378;</b></h3>
                </div>
            </div>
        </div>
    </div>
    <form class="ui form" id="billing-info-form">
        <h4>Gonderim Bilgisi</h4>
        <div class="field">
            <label>Isim</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="shipping[first-name]" placeholder="Isim">
                </div>
                <div class="field">
                    <input type="text" name="shipping[last-name]" placeholder="Soyisim">
                </div>
            </div>
        </div>
        <div class="field">
            <label>Gonderim Adresi</label>
            <div class="fields">
                <div class="twelve wide field">
                    <input type="text" name="shipping[address]" placeholder="Adres">
                </div>
                <div class="four wide field">
                    <input type="text" name="shipping[address-2]" placeholder="Apt #">
                </div>
            </div>
        </div>
        <div class="field">
            <label>Fatura Adresi</label>
            <div class="fields">
                <div class="twelve wide field">
                    <input type="text" name="shipping[address]" placeholder="Adres">
                </div>
                <div class="four wide field">
                    <input type="text" name="shipping[address-2]" placeholder="Apt #">
                </div>
            </div>
        </div>
        <h4>Kart Bilgisi</h4>
        <div class="fields">
            <div class="seven wide field">
                <label>Kart Numarasi</label>
                <input type="text" name="card[number]" maxlength="16" placeholder="Kart No">
            </div>
            <div class="three wide field">
                <label>CVC</label>
                <input type="text" name="card[cvc]" maxlength="3" placeholder="CVC">
            </div>
            <div class="six wide field">
                <label>Gecis Tarihi</label>
                <div class="two fields">
                    <div class="field">
                        <select class="ui fluid search dropdown" name="card[expire-month]">
                            <option value="">Ay</option>
                            <option value="1">Ocak</option>
                            <option value="2">Subat</option>
                            <option value="3">Mart</option>
                            <option value="4">Nisan</option>
                            <option value="5">Mayis</option>
                            <option value="6">Haziran</option>
                            <option value="7">Temmuz</option>
                            <option value="8">Agustos</option>
                            <option value="9">Eylul</option>
                            <option value="10">Ekim</option>
                            <option value="11">Kasim</option>
                            <option value="12">Aralik</option>
                        </select>
                    </div>
                    <div class="field">
                        <input type="text" name="card[expire-year]" maxlength="4" placeholder="Yil">
                    </div>
                </div>
            </div>
        </div>
        <div class="ui orange submit button" id="order-button" style="float: right;width: 150px;">Siparis Ver</div>
        <div class="ui error message"></div>
    </form>
</div>