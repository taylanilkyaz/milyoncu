USE `milyoncu`;

	CALL alt_kategori_insert( 1, 'cam');
	CALL alt_kategori_insert( 1, 'porselen');
	CALL alt_kategori_insert( 2, 'defter');
	CALL alt_kategori_insert( 2, 'kalem');
	CALL alt_kategori_insert( 3, 'avize');
	CALL alt_kategori_insert( 3, 'masa lambası');
	CALL alt_kategori_insert( 4, 'küpe');
	CALL alt_kategori_insert( 4, 'kolye');
	CALL alt_kategori_insert( 4, 'yüzük');
	CALL alt_kategori_insert( 5, 'bardak');
	CALL alt_kategori_insert( 5, 'çatal bıçak');
	CALL alt_kategori_insert( 5, 'çaydanlık');
	CALL alt_kategori_insert( 5, 'tencere');
	CALL alt_kategori_insert( 5, 'banyo aksesuarları');
	CALL alt_kategori_insert( 7, 'kız');
	CALL alt_kategori_insert( 7, 'erkek');
	CALL alt_kategori_insert( 8, 'kişisel bakım');
	CALL alt_kategori_insert( 8, 'ev temizliği');
	CALL alt_kategori_insert( 9, 'hediye');
	CALL alt_kategori_insert( 6, 'hırdavat');


	CALL kargo_şirketleri_insert( 'Aras Kargo', '6', '6');
	CALL kargo_şirketleri_insert( 'Sürat Kargo', '5', '8');
	CALL kargo_şirketleri_insert( 'Ups Kargo', '4', '9');
	CALL kargo_şirketleri_insert( 'Hızlı Kargo', '3', '10');


	CALL kategori_insert( 'züccaciye');
	CALL kategori_insert( 'kırtasiye');
	CALL kategori_insert( 'Aydınlatma');
	CALL kategori_insert( 'bujiteri');
	CALL kategori_insert( 'Mutfak & Banyo');
	CALL kategori_insert( 'Hırdavat');
	CALL kategori_insert( 'Oyuncak');
	CALL kategori_insert( 'Temizlik');
	CALL kategori_insert( 'Hediyelik');


	CALL kullanıcılar_insert( 'milyoncu@gmail.com', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'Milyoner', 'Milyoncu', '', '', 1, 1);
	CALL kullanıcılar_insert( 'ayseakcan1907@gmail.com', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'Ayşe', 'Akcan', '12565605338', '05386151818', 0, 1);

	
	CALL urun_insert( 'İkili Metal Banyo Köşelik', 20, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.', '2-li-metal-banyo-koselik.JPG', 14, 5, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.');
	CALL urun_insert( 'Metal Çöp Kovası', 15, 'Hacmi 3 litre olup , evinizin havasını değiştirebilecek bir üründür . ', '3-litre-metal-cop-kovasi.JPG', 14, 5, 'Hacmi 3 litre olup , evinizin havasını değiştirebilecek bir üründür . ');
	CALL urun_insert( 'Üçlü Metal Banyo Köşelik', 30, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.', '3-lu-metal-banyo-koselik.JPG', 14, 5, 'Banyonuzun daha derli toplu olması için bu ürünü almalısınız.');
	CALL urun_insert( 'Koli Bandı', 5, '30 metre boyunda ,  her zemine uygun , şeffaf bir üründür ', '30-metre-koli-bandi-seffaf.JPG', 20, 6, '30 metre boyunda ,  her zemine uygun , şeffaf bir üründür ');
	CALL urun_insert( 'Japon Yapıştırıcısı', 3, '502 markalı olup , kullanılan zeminleri saniyeler içerisinde tamamen yapıştırır. ', '502-yapistirici-.jpg', 20, 6, '502 markalı olup , kullanılan zeminleri saniyeler içerisinde tamamen yapıştırır. ');
	CALL urun_insert( 'Temizlik Bezi', 3, 'Acord 3 lü temizlik bezi ile cam , mermer ,ahşap zeminlerinizi parlatın', 'acord-3lu-temizlik-bezi.jpg', 18, 8, 'Acord 3 lü temizlik bezi ile cam , mermer ,ahşap zeminlerinizi parlatın');
	CALL urun_insert( 'Ahşap Havan', 8, 'Farklı boyutlarda yüzde yüz organik ve ahşaptır.', 'ahsap-havan.JPG', 12, 3, 'Farklı boyutlarda yüzde yüz organik ve ahşaptır.');
	CALL urun_insert( 'Porselen Çay Takımı', 40, 'Özel misafirlerinize çay sunmak mükemmel bir üründür .', 'beyaz-porselen-cay-takimi.JPG', 2, 1, 'Özel misafirlerinize çay sunmak mükemmel bir üründür .');
	CALL urun_insert( 'Cam Nescafe Takımı', 35, 'Özel misafirlerinize kahve sunmak için , tam istediğiniz özelliklerde cam nescafe takımıdır .', 'cam-nescafe-takimi.JPG', 1, 1, 'Özel misafirlerinize kahve sunmak için , tam istediğiniz özelliklerde cam nescafe takımıdır .');
	CALL urun_insert( 'Renkli Defter', 5, 'Notlarınızı kaydetmek için , farklı renklere sahip mükemmel defter', 'defter.jpg', 3, 2, 'Notlarınızı kaydetmek için , farklı renklere sahip mükemmel defter');
	CALL urun_insert( 'Tükenmez Kalem', 3, 'Yazınıza estetiklik ve renk katabilecek mükemmel bir üründür', 'kalem.jpg', 4, 2, 'Yazınıza estetiklik ve renk katabilecek mükemmel bir üründür');
	CALL urun_insert( 'Taşlı Avize', 60, 'Evinizi aydınlatacak , özenle seçilmiş taşlarla ile süslenmis avize', 'avize.jpg', 5, 3, 'Evinizi aydınlatacak , özenle seçilmiş taşlarla ile süslenmis avize');
	CALL urun_insert( 'Kullanışlı Masa Lambası', 15, 'Odanızı ışığı gözünüzü mü yordu ? O zaman sadece bunu dene ve masanı aydıtlat.', 'masalambası.jpg', 6, 3, 'Odanızı ışığı gözünüzü mü yordu ? O zaman sadece bunu dene ve masanı aydıtlat.');
	CALL urun_insert( 'Gümüş Küpe', 16, 'Kulanığınızda parlayıp , etrafınızdakileri büyüleyecek küpe modelleri', 'taki-cesitleri.jpg', 7, 4, 'Kulanığınızda parlayıp , etrafınızdakileri büyüleyecek küpe modelleri');
	CALL urun_insert( 'Kelebek Kolye', 14, 'Bu güzel ürünle etrafınızdakileri büyüleyebilirsiniz.', 'takim-taki-cesidi.jpg', 8, 4, 'Bu güzel ürünle etrafınızdakileri büyüleyebilirsiniz.');
	CALL urun_insert( 'Altın Yüzük', 100, 'Parmağınızda ışıl ışıl parlayacak , nadide bir eser', 'yuzuk.jpg', 9, 4, 'Parmağınızda ışıl ışıl parlayacak , nadide bir eser');
	CALL urun_insert( 'Kupa Bardak', 4, 'Kahvenizi veya çayınızı bir de bu bardaktan içmelisiniz', 'kupa-bardak-cesitleri.jpg', 10, 5, 'Kahvenizi veya çayınızı bir de bu bardaktan içmelisiniz');
	CALL urun_insert( 'Meşrubat Bardağı', 17, 'Misafirlerinize meşrubatlarınızı bu bardakla sunmak ayrıcaklıktır . ', 'ayakli-mesrubat-bardagi.jpeg', 10, 5, 'Misafirlerinize meşrubatlarınızı bu bardakla sunmak ayrıcaklıktır . ');
	CALL urun_insert( 'Gümüş Çatal Bıçak Seti', 120, 'Özel günlerinizi parlatacak mükemmel çatal bıçak setini deneyiniz.', 'catalbıcak.jpg', 11, 5, 'Özel günlerinizi parlatacak mükemmel çatal bıçak setini deneyiniz.');
	CALL urun_insert( 'Geniş Hazneli Çaydanlık', 46, 'Özel rengi ve geniş haznesi ile bir karaca ürünüdür .', 'caydanlık.jpg', 12, 5, 'Özel rengi ve geniş haznesi ile bir karaca ürünüdür .');
	CALL urun_insert( 'Tencere Takımı', 45, 'Granit bir ürün olup yapışmaz tabanı ile tam işini görecek bir settir.', 'tencere.jpg', 13, 5, 'Granit bir ürün olup yapışmaz tabanı ile tam işini görecek bir settir.');
	CALL urun_insert( 'Karbela Balık Tutma Oyuncağı', 16, 'Çocuğunuzun el becerilerini ve görsel zekasını arttıracak bir oyuncaktır.', 'erkekoyuncak.JPG', 16, 7, 'Çocuğunuzun el becerilerini ve görsel zekasını arttıracak bir oyuncaktır.');
	CALL urun_insert( 'Oyuncak Çay Seti', 14, 'Çocuğunuzun evcilik oyunlarını daha eğlenceli hale getirir . ', 'kızoyuncak.JPG', 15, 7, 'Çocuğunuzun evcilik oyunlarını daha eğlenceli hale getirir . ');
	CALL urun_insert( 'Gül Kokulu Islak Mendil', 5, 'İçinden 80 adet çıkıp , uzun havlu modeli ile işinizi kolaylaştırır . ', 'ıslakmendil.JPG', 17, 8, 'İçinden 80 adet çıkıp , uzun havlu modeli ile işinizi kolaylaştırır . ');
	CALL urun_insert( 'Baca Temizleyici', 3, 'Tıkanan bacaların korkulu rüyası Tatar Baca Temizleyici', 'baca-temizleyici.JPG', 18, 8, 'Tıkanan bacaların korkulu rüyası Tatar Baca Temizleyici');
	CALL urun_insert( 'Taraftar Kumbara', 5, 'Arkadaşınızın tuttuğu takıma göre, özel kumbarasını hediye edebilirsiniz.', 'taraftar-kumbara-.JPG', 19, 9, 'Arkadaşınızın tuttuğu takıma göre, özel kumbarasını hediye edebilirsiniz.');
	CALL urun_insert( 'Hediyelik Metal Kalemlik', 9, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .', 'metal-adam-kalemlik.JPG', 19, 9, 'Güzel disaynı ile etkileyici ve kullanışlı , insan kalemlik modeli .');
	CALL urun_insert( 'Dilek Balonu', 5, 'Her renk ürün olup, tüm dileklerinizin iletilmesi için hep sizinleyiz.', 'dilek-balonu2.jpg', 19, 9, 'Her renk ürün olup, tüm dileklerinizin iletilmesi için hep sizinleyiz.');
	CALL urun_insert( 'Çelik Çamaşır İpi', 2, 'Her türlü bağlama işinizde hep yanınızda arayacağınız bir üründür. 100 farklı sağlık testinden geçmiştir.', 'celik-camasir-ipi-10-metre2.JPG', 20, 6, 'Her türlü bağlama işinizde hep yanınızda arayacağınız bir üründür. 100 farklı sağlık testinden geçmiştir.');
	CALL urun_insert( 'Bor Cam', 9, '300 dereceye kadar dayanıklı olan bu cam tabak, her türlü fırında sizi zorda bırakmayacaktır.', 'borcam-cesitleri2.jpg', 1, 1, '300 dereceye kadar dayanıklı olan bu cam tabak, her türlü fırında sizi zorda bırakmayacaktır.');
	CALL urun_insert( 'Oyuncak Kova', 7, 'Çocuğunuza sorumluluk mu kazandırmak istiyorsunuz, tam ona uygun boylarda bu temizlik kovası ile ona yeni beceriler kazandırın.', 'temizlik-kovasi-maya2.JPG', 15, 7, 'Çocuğunuza sorumluluk mu kazandırmak istiyorsunuz, tam ona uygun boylarda bu temizlik kovası ile ona yeni beceriler kazandırın.');
	CALL urun_insert( 'Faber Castel Kursun Kalem', 1, 'Sınavınızda başarının tek adresi bu kalemdir. kırılmayan ucu ile sizi strese sokmayacaktır.', 'kursunkalem.jpg', 4, 2, 'Sınavınızda başarının tek adresi bu kalemdir. kırılmayan ucu ile sizi strese sokmayacaktır.');
