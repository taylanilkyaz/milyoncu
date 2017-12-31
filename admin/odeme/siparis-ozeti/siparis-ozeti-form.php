<?php
require $_SERVER['DOCUMENT_ROOT'].'/admin/buy/Buy.class.php';


$obj = new AddressDatabase();
$user_id = $_SESSION['id'];
$pay_type = $_SESSION['installment_type'];
$hide_cc_number = $_SESSION['hide_cc_number'];
$pay_price = $_SESSION['full_pay_price'];
$is_success_pau = $_SESSION['is_success_pay'];

$dashboard = new Buy();
$totalPrice = $dashboard->getAllBasketTotalPrice($user_id) ;
$cargoPrice = $dashboard->getAllCargoPrice($user_id);
$fullPrice = floor(doubleval($totalPrice) + doubleval($cargoPrice));
$basketList = $dashboard->getAllBasketAsProductArr($user_id);
?>

<div id="teslim-bilgileri-page-id">
    <div id="teslimat-bilgileri-top-content-id" class="ui fluid container">
        <div class="ui tablet stackable steps" id="steps-id">
            <div class="disabled step">
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
            <div class="active step">
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

<div id="siparis-özeti-2" class="ui fluid container">
    <form class="ui large form" id="shipping-information-form" action="../siparis-tamamlandi">
        <div class="ui stackable grid" id="information-menu">
            <div class=" three wide computer column"></div>
            <div class=" column seven wide computer column " id="ozet-segment-id">
                 <div class="ui segment">
                            <p class="ahref">
                                <span class="ui header title color" >Sipariş Özeti </span>
                                <span><a href= "/admin/sepetim" class="link-type-one" >Sepete Geri Dön</a></span>
                            <p class="box-header-desc"><strong>Lütfen sipariş bilgilerinizi gözden geçirip onaylayın.</strong></p>
                            </p>
                        </div>
                 <div class="ui segment">
                            <p>
                            <div class="order-items-header group">
                                <div class="ui stackable grid lftpadd">
                                    <div class="five wide column">
                                        <div class="col-product-name ">Ürün</div>
                                    </div>
                                    <div class="three wide column ">
                                        <div class="col-delivery ">Kargoya Veriliş*</div>
                                    </div>
                                    <div class="three wide column ">
                                        <div class="col-shipping-option">Kargo Seçeneği</div>
                                    </div>
                                    <div class="two wide column ">
                                        <div class="col-amount">Adet</div>
                                    </div>
                                    <div class="three wide column">
                                        <div class="col-total">Toplam</div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            /**
                             * @var $item Product
                             */
                            $totalProductCount = 0;
                                foreach ($basketList as $item){
                                    $totalProductCount+=$item->getCount();
                                    ?>

                                    <div class="ui segment substance">
                                        <div class="ui stackable grid">
                                            <div class="five wide column">
                                                <div class="col-product-name"><?php echo $item->getName(); ?></div>
                                            </div>
                                            <div class="three wide column">
                                                <div class="col-delivery">En geç 8 Temmuz Pazartesi</div>
                                            </div>
                                            <div class="three wide column">
                                                <div class="col-shipping-option">Standart Teslimat</div>
                                            </div>
                                            <div class="two wide column">
                                                <div class="col-amount"><?php echo $item->getCount(); ?></div>
                                            </div>
                                            <div class="three wide column">
                                                <div class="col-total"><?php echo $item->getCount() * $item->getPrice(); ?> <i class="small lira icon"></i></div>

                                            </div>

                                        </div>
                                    </div>

                              <?php
                                }
                            ?>

                        </div>
                 <div class="ui segment">
                            <p class="ahref">
                                <span class="ui header title color">Teslimat Bilgileri </span>
                                <a href="/admin/odeme/teslimat-bilgileri" class="link-type-one">Değiştir</a>

                            <div class="order-items-header group">
                                <div class="ui stackable grid">
                                    <div class="eight wide column">
                                        <div class="col-product-name lftpadd ">Teslimat Adresi</div>
                                    </div>
                                    <div class="eight wide column">
                                        <div class="col-delivery lftpadd">Fatura Adresi</div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui stackable grid">

                                <div class="eight wide column">
                                    <div class="ui segment substance">
                                        <div class="col-product-name"><?php
                                            echo $obj->getCargoAddress($user_id);
                                            ?></div>
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <div class="ui segment substance">
                                        <div class="col-product-name"><?php
                                        echo $obj->getBillAddress($user_id);
                                            ?></div>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                 <div class="ui segment">
                            <p class="ahref">
                                <span class="ui header title color">Ödeme Bilgileri</span>
                                <a href="/admin/odeme/odeme-bilgileri" class="link-type-one">Değiştir</a>

                            <div class="order-items-header group">
                                <div class="ui stackable grid">
                                    <div class="eight wide column">
                                        <div class="col-product-name lftpadd">Kredi Kartı</div>
                                    </div>
                                    <div class="four wide column">
                                        <div class="col-delivery lftpadd">Taksit Seçeneği</div>
                                    </div>
                                    <div class="four wide column">
                                        <div class="col-delivery lftpadd">Tutar</div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui stackable grid">
                                <div class="eight wide column">
                                    <div class="ui segment substance">
                                        <div class="col-product-name"><?php echo $hide_cc_number; ?></div>
                                    </div>
                                </div>
                                <div class="four wide column">
                                    <div class="ui segment substance">
                                        <div class="col-delivery"><?php echo $pay_type; ?></div>
                                    </div>
                                </div>
                                <div class="four wide column">
                                    <div class="ui segment substance">
                                        <div class="col-delivery"><?php echo $pay_price ?></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                 <div class="ui segment" >
                 <p3 class="ui header subtitle color">Cayma Hakkı</p3>
                 <div class="field">
				<textarea>
				Tüketici (ALICI), 14 (ondört) gün içinde herhangi bir gerekçe göstermeksizin ve cezai şart ödemeksizin sözleşmeden cayma hakkına sahiptir. Cayma hakkı süresi, hizmet ifasına ilişkin sözleşmelerde sözleşmenin kurulduğu gün; mal teslimine ilişkin sözleşmelerde ise tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin malı teslim aldığı gün başlar. Ancak tüketici, sözleşmenin kurulmasından malın teslimine kadar olan süre içinde de cayma hakkını kullanabilir. Cayma hakkı süresinin belirlenmesinde;
		a)Tek sipariş konusu olup ayrı ayrı teslim edilen mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son malı teslim aldığı gün,
		b)Birden fazla parçadan oluşan mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son parçayı teslim aldığı gün,
		c)Belirli bir süre boyunca malın düzenli tesliminin yapıldığı sözleşmelerde, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin ilk malı teslim aldığı gün esas alınır. Cayma bildiriminizi cayma hakkı süresi dolmadan www.hepsiburada.com'da yer alan kişisel üyelik sayfanızdaki iade ve geri gönderim seçeneği üzerinden gerçekleştirebilirsiniz. Cayma hakkınız kapsamında öngörülen taşıyıcı Yurtiçi Kargo olup, www.hepsiburada.com'da yer alan kişisel üyelik sayfanızdaki iade ve geri gönderim seçeneğinde geri gönderime ilişkin detaylar açıklanmıştır.

				Tüketici aşağıdaki sözleşmelerde cayma hakkını kullanamaz:
		a)Fiyatı finansal piyasalardaki dalgalanmalara bağlı olarak değişen ve SATICI veya sağlayıcının kontrolünde olmayan mal veya hizmetlere ilişkin sözleşmeler.
		b)Tüketicinin istekleri veya kişisel ihtiyaçları doğrultusunda hazırlanan mallara ilişkin sözleşmeler.
		c)Çabuk bozulabilen veya son kullanma tarihi geçebilecek malların teslimine ilişkin sözleşmeler.
		d)Tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olan mallardan; iadesi sağlık ve hijyen açısından uygun olmayanların teslimine ilişkin sözleşmeler.
		e)Tesliminden sonra başka ürünlerle karışan ve doğası gereği ayrıştırılması mümkün olmayan mallara ilişkin sözleşmeler.
		f)Malın tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olması halinde maddi ortamda sunulan kitap, dijital içerik ve bilgisayar sarf malzemelerine ilişkin sözleşmeler.
		g)Abonelik sözleşmesi kapsamında sağlananlar dışında, gazete ve dergi gibi süreli yayınların teslimine ilişkin sözleşmeler.
		h)Belirli bir tarihte veya dönemde yapılması gereken, konaklama, eşya taşıma, araba kiralama, yiyecek-içecek tedariki ve eğlence veya dinlenme amacıyla yapılan boş zamanın değerlendirilmesine ilişkin sözleşmeler.
		i)Elektronik ortamda anında ifa edilen hizmetler veya tüketiciye anında teslim edilen gayrimaddi mallara ilişkin sözleşmeler.
		j)Cayma hakkı süresi sona ermeden önce, tüketicinin onayı ile ifasına başlanan hizmetlere ilişkin sözleşmeler.

							</textarea>
                            </div>

                            <p3 class="ui header subtitle color">Ön Bilgilendirme Formu</p3>

                            <div class="field">
							 <textarea>
								 SATICI:

		Ünvanı: D-Market Elektronik Hizmetler ve Ticaret A.Ş.
		Adresi: Mimar Sinan Mah. Karadeniz Caddesi No: 150 Sultanbeyli / İstanbul
		Telefon: 0216 633 26 00
		Fax: 0216 592 65 28
		Müşteri Hizmetleri Telefon: 0850 252 40 00

		Mersis Numarası: 0265017991000011

		ÖN BİLGİLENDİRME FORMU

			1) Sözleşme konusu mal veya hizmetin adı, adeti, KDV dahil satış fiyatı, ödeme şekli ve temel nitelikleri

		Ödeme Şekli : Kredi Kartı ile Peşin İşlem (Tek Çekim)

		Yukarıdaki bölümde bankanıza iletilecek sipariş toplamının kaç taksitle ödeneceği bilgisi bulunmaktadır.
		Bankanız kampanyalar düzenleyerek sizin seçtiğiniz taksit adedinin daha üstünde bir taksit adedi uygulayabilir, taksit öteleme gibi hizmetler sunulabilir. Bu tür kampanyalar bankanızın inisiyatifindedir ve şirketimizin bilgisi dâhilinde olması durumunda sayfalarımızda kampanyalar hakkında bilgi verilmektedir.
		Kredi kartınızın hesap kesim tarihinden itibaren sipariş toplamı taksit adedine bölünerek kredi kartı özetinize bankanız tarafından yansıtılacaktır. Banka taksit tutarlarını küsurat farklarını dikkate alarak aylara eşit olarak dağıtmayabilir. Detaylı ödeme planınızın oluşturulması bankanız inisiyatifindedir.

		Ürün Adı ve Temel Nitelikleri	Adet	Satış Bedeli
		(KDV dahil toplam Türk Lirası)	Vadeli Satış Bedeli
		(KDV dahil toplam)
		Kenyap 819248 Eko-Line Arka Panelli Çalışma Masası	1	69,90	Vadesiz

			2) Paketleme, kargo ve teslim masrafları ALICI tarafından karşılanmaktadır. Kargo ücreti 13,36 -TL olup, kargo fiyatı sipariş toplam tutarına eklenmektedir. Ürün bedeline dahil değildir. Teslimat , anlaşmalı kargo şirketi aracılığı ile, ALICI'nın yukarıda belirtilen adresinde elden teslim edilecektir. Teslim anında ALICI'nın adresinde bulunmaması durumunda dahi Firmamız edimini tam ve eksiksiz olarak yerine getirmiş olarak kabul edilecektir. Bu nedenle, ALICI'nın ürünü geç teslim almasından ve/veya hiç teslim almamasından kaynaklanan zararlardan ve giderlerden SATICI sorumlu değildir. SATICI, sözleşme konusu ürünün sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım kılavuzları ile teslim edilmesinden sorumludur.

			3) Ürün sözleşme tarihinden itibaren en geç 30 gün içerisinde teslim edilecektir. Ürününün teslim edilmesi anına kadar tüm sorumluluk SATICI’ya aittir.

			4) Tüketici (ALICI), 14 (ondört) gün içinde herhangi bir gerekçe göstermeksizin ve cezai şart ödemeksizin sözleşmeden cayma hakkına sahiptir. Cayma hakkı süresi, hizmet ifasına ilişkin sözleşmelerde sözleşmenin kurulduğu gün; mal teslimine ilişkin sözleşmelerde ise tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin malı teslim aldığı gün başlar. Ancak tüketici, sözleşmenin kurulmasından malın teslimine kadar olan süre içinde de cayma hakkını kullanabilir. Cayma hakkı süresinin belirlenmesinde;

		a) Tek sipariş konusu olup ayrı ayrı teslim edilen mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son malı teslim aldığı gün,

		b) Birden fazla parçadan oluşan mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son parçayı teslim aldığı gün,

		c) Belirli bir süre boyunca malın düzenli tesliminin yapıldığı sözleşmelerde, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin ilk malı teslim aldığı gün esas alınır. Cayma bildiriminizi cayma hakkı süresi dolmadan www.hepsiburada.com ‘da yer alan kişisel üyelik sayfanızdaki kolay iade seçeneği üzerinden gerçekleştirebilirsiniz. Cayma hakkınız kapsamında öngörülen taşıyıcı Yurtiçi Kargo olup, www.hepsiburada.com ‘da yer alan kişisel üyelik sayfanızdaki kolay iade seçeneğinde geri gönderime ilişkin detaylar açıklanmıştır.

			Tüketici aşağıdaki sözleşmelerde cayma hakkını kullanamaz:

		a) Fiyatı finansal piyasalardaki dalgalanmalara bağlı olarak değişen ve SATICI veya sağlayıcının kontrolünde olmayan mal veya hizmetlere ilişkin sözleşmeler.

		b) Tüketicinin istekleri veya kişisel ihtiyaçları doğrultusunda hazırlanan mallara ilişkin sözleşmeler.

		c) Çabuk bozulabilen veya son kullanma tarihi geçebilecek malların teslimine ilişkin sözleşmeler.

		ç) Tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olan mallardan; iadesi sağlık ve hijyen açısından uygun olmayanların teslimine ilişkin sözleşmeler.

		d) Tesliminden sonra başka ürünlerle karışan ve doğası gereği ayrıştırılması mümkün olmayan mallara ilişkin sözleşmeler.

		e) Malın tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olması halinde maddi ortamda sunulan kitap, dijital içerik ve bilgisayar sarf malzemelerine ilişkin sözleşmeler.

		f) Abonelik sözleşmesi kapsamında sağlananlar dışında, gazete ve dergi gibi süreli yayınların teslimine ilişkin sözleşmeler.

		g) Belirli bir tarihte veya dönemde yapılması gereken, konaklama, eşya taşıma, araba kiralama, yiyecek-içecek tedariki ve eğlence veya dinlenme amacıyla yapılan boş zamanın değerlendirilmesine ilişkin sözleşmeler.

		ğ) Elektronik ortamda anında ifa edilen hizmetler veya tüketiciye anında teslim edilen gayrimaddi mallara ilişkin sözleşmeler.

		h) Cayma hakkı süresi sona ermeden önce, tüketicinin onayı ile ifasına başlanan hizmetlere ilişkin sözleşmeler.

			5) Tüketicinin herhangi bir dijital içerik satın alması halinde dijital içeriklerin işlevselliğini etkileyecek teknik koruma önlemleri ve SATICI’nın bildiği ya da makul olarak bilmesinin beklendiği, dijital içeriğin hangi donanım ya da yazılımla birlikte çalışabileceğine ilişkin bilgiler satın alınan ürünün www.hepsiburada.com ‘da satışa sunulduğu sayfadaki tanıtım içeriğinde yer almaktadır.

			6) Tüketicilerin şikayet ve itirazları: Siparişinize ve/veya siparişinize konu ürüne ve/veya şiparişinizle ilgili herhangi bir konuda şikayetinizin olması halinde şikayetlerinizi yukarıda belirtilen iletişim bilgileri veya www.hepsiburada.com internet sitesinde belirtilen iletişim bilgileri vasıtasıyla SATICI’ya iletebilirsiniz. İletmiş olduğunuz şikayet başvurularınız derhal kayıtlara alınacak, yetkili birimler tarafından değerlendirilerek çözümlenmeye çalışılacak ve en kısa sürede size geri dönüş sağlanacaktır. Ayrıca, şikayet başvurularınızı doğrudan yerleşim yerinizin bulunduğu veya tüketici işleminin yapıldığı yerdeki Tüketici Sorunları Hakem Heyetine veya Tüketici Mahkemesine yapabilirsiniz (Gümrük ve Ticaret Bakanlığı tarafından her yıl Aralık ayında belirlenen parasal sınırlar dâhilinde 2017 yılı için Tüketici Hakem Heyetlerinin uyuşmazlıklara bakmakla görevli ve yetkili olmalarına ilişkin parasal sınırlar; ilçe tüketici hakem heyetleri için üst parasal sınır 2.400 Türk Lirası, Büyükşehir statüsünde olan illerdeki il tüketici hakem heyetleri için parasal sınır 2.400 Türk Lirası ile 3.610 Türk Lirası arası, Büyükşehir statüsünde olmayan illerin merkezlerindeki il tüketici hakem heyetleri için üst parasal sınır 3.610 Türk Lirası, Büyükşehir statüsünde olmayan illere bağlı ilçelerdeki il tüketici hakem heyetleri için parasal sınır 2.400 Türk Lirası ile 3.610 Türk Lirası arası olarak tespit edilmiştir.).

		SATICI:

		Ünvanı: D-Market Elektronik Hizmetler ve Ticaret A.Ş.
		Adresi:Mimar Sinan Mah. Karadeniz Caddesi No: 150 Sultanbeyli / İstanbul
		Telefon: 0216 633 26 00
		Fax: 0216 592 65 28
		Müşteri Hizmetleri Telefon: 0850 252 40 00

		Mersis Numarası: 0265017991000011

		ALICI:

		Adı/soyadı/Ünvanı: taylan ilkyaz
		Adresi: ayyıldız mahallesi 06000 ETİMESGUT Ankara / Türkiye
		Telefon: 5061208062
		Email: taylanilkyaz@hotmail.com
		Tarih : 04.06.2017
							</textarea>
                            </div>


                            <p3 class="ui header subtitle color">Mesafeli Satış Sözleşmesi</p3>


                            <div class="field">
							 <textarea>

		MESAFELİ SATIŞ SÖZLEŞMESİ

	MADDE 1- TARAFLAR


	1.1. SATICI:

	Ünvanı: D-Market Elektronik Hizmetler ve Ticaret A.Ş.
	Adresi: Mimar Sinan Mah. Karadeniz Caddesi No: 150 Sultanbeyli / İstanbul
	Telefon: 0216 633 26 00
	Fax: 0216 592 65 28
	Müşteri Hizmetleri Telefon: 0850 252 40 00

	Mersis Numarası: 0265017991000011


	1.2. ALICI:

	Adı/Soyadı/Ünvanı: taylan ilkyaz
	Adresi : ayyıldız mahallesi 06000 ETİMESGUT Ankara / Türkiye
	Telefon: 5061208062
	Email: taylanilkyaz@hotmail.com


	MADDE 2- KONU

	İşbu sözleşmenin konusu, ALICI'nın www.hepsiburada.com internet sitesinden elektronik ortamda siparişini yaptığı aşağıda nitelikleri ve satış fiyatı belirtilen ürünün satışı ve teslimi ile ilgili olarak 6502 sayılı Tüketicinin Korunması Hakkındaki Kanun hükümleri gereğince tarafların hak ve yükümlülüklerinin saptanmasıdır.



	MADDE 3- SÖZLEŞME KONUSU ÜRÜN, ÖDEME VE TESLİMATA İLİŞKİN BİLGİLER

	3.1- Sözleşme konusu mal veya hizmetin adı, adeti, KDV dahil satış fiyatı, ödeme şekli ve temel nitelikleri



	Ürün Adı ve Temel Nitelikleri	Adet	Satış Bedeli
	(KDV dahil toplam Türk Lirası)	Vadeli Satış Bedeli
	(KDV dahil toplam)
	Kenyap 819248 Eko-Line Arka Panelli Çalışma Masası	1	69,90	Vadesiz






	3.2- Ödeme Şekli : Kredi Kartı ile Peşin İşlem (Tek Çekim)

	Yukarıdaki bölümde bankanıza iletilecek sipariş toplamının kaç taksitle ödeneceği bilgisi bulunmaktadır.
	Bankanız kampanyalar düzenleyerek sizin seçtiğiniz taksit adedinin daha üstünde bir taksit adedi uygulayabilir, taksit öteleme gibi hizmetler sunulabilir. Bu tür kampanyalar bankanızın inisiyatifindedir ve şirketimizin bilgisi dâhilinde olması durumunda sayfalarımızda kampanyalar hakkında bilgi verilmektedir.
	Kredi kartınızın hesap kesim tarihinden itibaren sipariş toplamı taksit adedine bölünerek kredi kartı özetinize bankanız tarafından yansıtılacaktır. Banka taksit tutarlarını küsurat farklarını dikkate alarak aylara eşit olarak dağıtmayabilir. Detaylı ödeme planınızın oluşturulması bankanız inisiyatifindedir.




	3.3- Diğer yandan vadeli satışların sadece Bankalara ait kredi kartları ile yapılması nedeniyle, ALICI, ilgili faiz oranlarını ve temerrüt faizi ile ilgili bilgileri bankasından ayrıca teyit edeceğini, yürürlükte bulunan mevzuat hükümleri gereğince faiz ve temerrüt faizi ile ilgili hükümlerin Banka ve ALICI arasındaki kredi kartı sözleşmesi kapsamında uygulanacağını kabul, beyan ve taahhüt eder.

	İade Prosedürü:



	a) Kredi Kartına İade Prosedürü



	ALICI’nın cayma hakkını kullandığı durumlarda ya da siparişe konu olan ürünün çeşitli sebeplerle tedarik edilememesi veya hakem heyeti kararları ile ALICI’ya bedel iadesine karar verilen durumlarda, alışveriş kredi kartı ile ve taksitli olarak yapılmışsa, kredi kartına iade prosedürü aşağıda belirtilmiştir:

	ALICI ürünü kaç taksit ile aldıysa Banka ALICI’ya geri ödemesini taksitle yapmaktadır. SATICI bankaya ürün bedelinin tamamını tek seferde ödedikten sonra, Banka poslarından yapılan taksitli harcamaların ALICI’nın kredi kartına iadesi durumunda, konuya müdahil tarafların mağdur duruma düşmemesi için talep edilen iade tutarları, yine taksitli olarak hamil taraf hesaplarına Banka tarafından aktarılır. ALICI’nın satış iptaline kadar ödemiş olduğu taksit tutarları ,eğer iade tarihi ile kartın hesap kesim tarihleri çakışmazsa her ay karta 1 (bir) iade yansıyacak ve ALICI iade öncesinde ödemiş olduğu taksitleri satışın taksitleri bittikten sonra , iade öncesinde ödemiş olduğu taksitleri sayısı kadar ay daha alacak ve mevcut borçlarından düşmüş olacaktır.



	Kart ile alınmış mal ve hizmetin iadesi durumunda SATICI, Banka ile yapmış olduğu sözleşme gereği ALICI’ya nakit para ile ödeme yapamaz. Üye işyeri yani SATICI, bir iade işlemi sözkonusu olduğunda ilgili yazılım aracılığı ile iadesini yapacak olup, Üye işyeri yani SATICI ilgili tutarı Banka’ya nakden veya mahsuben ödemekle yükümlü olduğundan yukarıda anlatmış olduğumuz prosedür gereğince ALICI’ya nakit olarak ödeme yapılamamaktadır. Kredi kartına iade, SATICI’nın Banka’ya bedeli tek seferde ödemesinden sonra, Banka tarafından yukarıdaki prosedür gereğince yapılacaktır.

	ALICI, bu prosedürü okuduğunu ve kabul ettiğini kabul ve taahhüd eder.

	B) Kapıdan Ödeme ile Havale/EFT Ödeme Seçeneklerinde İade Prosedürü



	Kapıdan ödeme ile havale/EFT ödeme seçeneklerinde iade Tüketiciden banka hesap bilgileri istenerek,Tüketicinin belirttiği hesaba (hesabın fatura adresindeki kişinin adına veya kullanıcı üyenin adına olması şarttır) havale ve EFT şeklinde yapılacaktır.






	3.4- Teslimat Şekli ve Adresi :
	Teslimat Adresi : ayyıldız mahallesi 06000 Türkiye Ankara / Türkiye
	Teslim Edilecek Kişi: taylan ilkyaz
	Fatura Adresi : ayyıldız mahallesi 06000 ETİMESGUT Ankara / Türkiye


	Paketleme, kargo ve teslim masrafları ALICI tarafından karşılanmaktadır. Kargo ücreti 13,36 -TL olup, kargo fiyatı sipariş toplam tutarına eklenmektedir. Ürün bedeline dahil değildir. Teslimat , anlaşmalı kargo şirketi aracılığı ile, ALICI'nın yukarıda belirtilen adresinde elden teslim edilecektir. Teslim anında ALICI'nın adresinde bulunmaması durumunda dahi Firmamız edimini tam ve eksiksiz olarak yerine getirmiş olarak kabul edilecektir. Bu nedenle, ALICI'nın ürünü geç teslim almasından ve/veya hiç teslim almamasından kaynaklanan zararlardan ve giderlerden SATICI sorumlu değildir. SATICI, sözleşme konusu ürünün sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım kılavuzları ile teslim edilmesinden sorumludur.



	3.5. Hızlı ve Kolay Alışveriş: Siparişin onaylanması sonrasında, “MÜŞTERİ” sipariş onaylanma ekranında hızlı ve kolay alışveriş bölümünde MÜŞTERİ “ONAY” sekmesini tıklaması ve müşterinin sistemde kayıtlı cep telefonuna gelen SMS doğrulama aktivasyon kodunu, 180 saniye içerisinde sitede yer alan ilgili bölüme girmesi halinde kargo firması, teslimat adresi, ödeme seçim ve bilgilerinin kendi onayıyla müşteri profil bilgileri altında kaydedilerek saklanmasını kabul eder. “MÜŞTERİ’NİN” rızası ile kaydedilen ilgili bilgiler müşterinin profil bilgileri altında saklanacak olup “MÜŞTERİ’NİN” talebi durumunda bu bilgiler istenildiğinde müşteri profilinden çıkartılır.



	MADDE 4- CAYMA HAKKI



	Tüketici (ALICI), 14 (ondört) gün içinde herhangi bir gerekçe göstermeksizin ve cezai şart ödemeksizin sözleşmeden cayma hakkına sahiptir. Cayma hakkı süresi, hizmet ifasına ilişkin sözleşmelerde sözleşmenin kurulduğu gün; mal teslimine ilişkin sözleşmelerde ise tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin malı teslim aldığı gün başlar. Ancak tüketici, sözleşmenin kurulmasından malın teslimine kadar olan süre içinde de cayma hakkını kullanabilir. Cayma hakkı süresinin belirlenmesinde;

	a) Tek sipariş konusu olup ayrı ayrı teslim edilen mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son malı teslim aldığı gün,

	b) Birden fazla parçadan oluşan mallarda, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin son parçayı teslim aldığı gün,

	c) Belirli bir süre boyunca malın düzenli tesliminin yapıldığı sözleşmelerde, tüketicinin veya tüketici tarafından belirlenen üçüncü kişinin ilk malı teslim aldığı gün esas alınır. Cayma bildiriminizi cayma hakkı süresi dolmadan www.hepsiburada.com ‘da yer alan kişisel üyelik sayfanızdaki kolay iade seçeneği üzerinden gerçekleştirebilirsiniz. Cayma hakkınız kapsamında öngörülen taşıyıcı Yurtiçi Kargo olup, www.hepsiburada.com ‘da yer alan kişisel üyelik sayfanızdaki kolay iade seçeneğinde geri gönderime ilişkin detaylar açıklanmıştır.

	Tüketici aşağıdaki sözleşmelerde cayma hakkını kullanamaz:

	a) Fiyatı finansal piyasalardaki dalgalanmalara bağlı olarak değişen ve SATICI veya sağlayıcının kontrolünde olmayan mal veya hizmetlere ilişkin sözleşmeler.

	b) Tüketicinin istekleri veya kişisel ihtiyaçları doğrultusunda hazırlanan mallara ilişkin sözleşmeler.

	c) Çabuk bozulabilen veya son kullanma tarihi geçebilecek malların teslimine ilişkin sözleşmeler.

	ç) Tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olan mallardan; iadesi sağlık ve hijyen açısından uygun olmayanların teslimine ilişkin sözleşmeler.

	d) Tesliminden sonra başka ürünlerle karışan ve doğası gereği ayrıştırılması mümkün olmayan mallara ilişkin sözleşmeler.

	e) Malın tesliminden sonra ambalaj, bant, mühür, paket gibi koruyucu unsurları açılmış olması halinde maddi ortamda sunulan kitap, dijital içerik ve bilgisayar sarf malzemelerine ilişkin sözleşmeler.

	f) Abonelik sözleşmesi kapsamında sağlananlar dışında, gazete ve dergi gibi süreli yayınların teslimine ilişkin sözleşmeler.

	g) Belirli bir tarihte veya dönemde yapılması gereken, konaklama, eşya taşıma, araba kiralama, yiyecek-içecek tedariki ve eğlence veya dinlenme amacıyla yapılan boş zamanın değerlendirilmesine ilişkin sözleşmeler.

	ğ) Elektronik ortamda anında ifa edilen hizmetler veya tüketiciye anında teslim edilen gayrimaddi mallara ilişkin sözleşmeler.

	h) Cayma hakkı süresi sona ermeden önce, tüketicinin onayı ile ifasına başlanan hizmetlere ilişkin sözleşmeler.


	MADDE 4- GENEL HÜKÜMLER

	4.1- ALICI, www.hepsiburada.com internet sitesinde sözleşme konusu ürüne ilişkin ön bilgileri okuyup bilgi sahibi olduğunu ve elektronik ortamda gerekli teyidi verdiğini beyan eder.
	4.2- Ürün sözleşme tarihinden itibaren en geç 30 gün içerisinde teslim edilecektir. Ürününün teslim edilmesi anına kadar tüm sorumluluk SATICI’ya aittir.
	4.3- Sözleşme konusu ürün, ALICI'dan başka bir kişi/kuruluşa teslim edilecek ise, teslim edilecek kişi/kuruluşun teslimatı kabul etmemesinden SATICI sorumlu tutulamaz.
	4.4- SATICI, sözleşme konusu ürünün sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım kılavuzları ile teslim edilmesinden sorumludur.
	4.5- Sözleşme konusu ürünün teslimatı için işbu sözleşmenin bedelinin ALICI'nın tercih ettiği ödeme şekli ile ödenmiş olması şarttır. Herhangi bir nedenle ürün bedeli ödenmez veya banka kayıtlarında iptal edilir ise, SATICI ürünün teslimi yükümlülüğünden kurtulmuş kabul edilir.
	4.6- Ürünün tesliminden sonra ALICI'ya ait kredi kartının ALICI'nın kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşun ürün bedelini SATICI'ya ödememesi halinde, ALICI'nın kendisine teslim edilmiş olması kaydıyla ürünün SATICI'ya gönderilmesi zorunludur.

	4.7- Garanti belgesi ile satılan ürünlerden olan veya olmayan ürünlerin ayıplı (arızalı, bozuk vb.) halinde veya garanti kapsamında ve şartları dahilinde arızalanması veya bozulması halinde gerekli onarımın yetkili servise yaptırılması için sözkonusu ürünler SATICI'ya gönderilebilir, bu takdirde kargo giderleri SATICI tarafından karşılanacaktır.

	4.8-385 sayılı vergi usul kanunu genel tebliği uyarınca iade işlemlerinin yapılabilmesi için tarafınıza göndermiş olduğumuz iade bölümü bulunan faturada ilgili bölümlerin eksiksiz olarak doldurulması ve imzalandıktan sonra tarafımıza ürün ile birlikte geri gönderilmesi gerekmektedir.



	MADDE 8- UYUŞMAZLIK VE YETKİLİ MAHKEME

	İşbu sözleşmeden doğan uyuşmazlıklarda doğrudan yerleşim yerinizin bulunduğu veya tüketici işleminin yapıldığı yerdeki Tüketici Sorunları Hakem Heyeti veya Tüketici Mahkemesi yetkilidir (Gümrük ve Ticaret Bakanlığı tarafından her yıl Aralık ayında belirlenen parasal sınırlar dâhilinde 2017 yılı için Tüketici Hakem Heyetlerinin uyuşmazlıklara bakmakla görevli ve yetkili olmalarına ilişkin parasal sınırlar; ilçe tüketici hakem heyetleri için üst parasal sınır 2.400 Türk Lirası, Büyükşehir statüsünde olan illerdeki il tüketici hakem heyetleri için parasal sınır 2.400 Türk Lirası ile 3.610 Türk Lirası arası, Büyükşehir statüsünde olmayan illerin merkezlerindeki il tüketici hakem heyetleri için üst parasal sınır 3.610 Türk Lirası, Büyükşehir statüsünde olmayan illere bağlı ilçelerdeki il tüketici hakem heyetleri için parasal sınır 2.400 Türk Lirası ile 3.610 Türk Lirası arası olarak tespit edilmiştir.).



	Siparişin gerçekleşmesi durumunda ALICI işbu sözleşmenin tüm koşullarını kabul etmiş sayılır.


	SATICI : D-Market Elektronik Hizmetler ve Ticaret A.Ş.

	ALICI : taylan ilkyaz

	Tarih : 04.06.2017
							</textarea>
                            </div>
                        </div>
            </div>
            <div class="left floated four wide column ">
                <div id="fixed-part-siparis-ozeti">
                    <div class="ui segment" id="fixed-text-right">
                        <h3 class="ui header">
                            <div class="ui dividing header color" id="ozet-text">
                                Sipariş Özeti
                                <div class="sub header"><?php echo $totalProductCount?> ürün</div>
                            </div>
                        </h3>
                        <h3 class="ui header">
                            <div class="sub header">Ödenecek Tutar</div>
                            <div class="ui header"><i class="lira icon"style="font-size: xx-large"></i><?php echo floor($pay_price);
                                ?></div>
                        </h3>
                        <div class="inline field ">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms-on-bilgilendirme">
                                <label>Ön bilgilendirme formunu kabul ediyorum.</label>
                            </div>
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms-satis-sozlesmesi">
                                <label>Mesafeli satış sözleşmesini kabul ediyorum.</label>
                            </div>
                        </div>
                        <div class="ui primary submit button"id="odeme-buttons">Siparişi Onayla<i class="chevron right icon"></i></div>
                        <div class="ui error message"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
