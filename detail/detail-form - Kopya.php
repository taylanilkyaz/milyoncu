
<link rel="stylesheet" type="text/css" href="dev.css">

<div id="detail-top-content" class="ui fluid container">

    <div class="ui centered grid">
        <a href="/home" id="back" class="ui small button" >
            <img id="backimg" src="/assets/images/hizmet/home.png">
        </a>

        <h2 class="ui center aligned header">
            Nasıl bir hizmete ihtiyacın var ?
        </h2>
    </div>

</div>

<div class="ui divider"></div>

<!-- giris ekranıdır. 'aile' - 'hayvan' - 'saglik'-->
<div id="start-test" class="ui centered link cards">

    <div class="card">

        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a class="ui primary button" onclick="aileTest()">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/aile.png">
        </div>
        <div class="content">
            <div class="header">Aile</div>

            <div class="description">
                Ailenizde Merak Ettiklenizi Cevaplayalım
            </div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a class="ui primary button" onclick="hayvanTest()">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/animal.png">
        </div>
        <div class="content">
            <div class="header">Hayvanlar</div>

            <div class="description">
                Hayvanlarınızın Asilliğini Kanıtlayalım
            </div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a class="ui primary button" onclick="saglikTest()">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/saglik.png">
        </div>
        <div class="content">
            <div class="header">Sağlık</div>

            <div class="description">
               Yaşam Şartlarınızı Belirleyelim
            </div>
        </div>
    </div>

</div>

<div id="muhammet-test">
    <div class="ui three column doubling stackable centered grid">
        <div class="center aligned column">

            <div class="ui segment">
                <img class="ui centered fluid image" src="img/family.png">
                <p class="below-image">Aile</p>
            </div>
        </div>
        <div class="center aligned column">

            <div class="ui segment">
                <img class="ui centered fluid image" src="img/dog.png">
                <p class="below-image">Hayvan</p>
            </div>
        </div>
        <div class="center aligned column">

            <div class="ui segment">
                <img class="ui centered fluid image" src="img/heart.png">
                <p class="below-image">Sağlık</p>
            </div>
        </div>
    </div>


</div>

<!-- aile ekranıdır. 'anne(1)' - 'baba(2)' - 'bebek(3)' - 'büyükanne-büyükbaba(4)' - 'kardes(5)' - 'hala-amca(6)' -->
<div id="aile-test" class="ui centered link cards">
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/detail/buy_category" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/female.png">
        </div>
        <div class="content">
            <div class="header">Anne</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/male.png">
        </div>
        <div class="content">
            <div class="header">Baba</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/baby.png">
        </div>
        <div class="content">
            <div class="header">Bebek</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/grands.png">
        </div>
        <div class="content">
            <div class="header">Büyükanne-Büyükbaba</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/child.png">
        </div>
        <div class="content">
            <div class="header">Kardeş</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/uncle.png">
        </div>
        <div class="content">
            <div class="header">Hala-Amca</div>
        </div>
    </div>
</div>


<!-- hayvan ekranıdır. 'kedi(7)' - 'kopek(8)' - 'kus(9)' - 'at(10)' -->
<div id="hayvan-test" class="ui centered link cards">
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/cat.png">
        </div>
        <div class="content">
            <div class="header">Kedi</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/dog.png">
        </div>
        <div class="content">
            <div class="header">Köpek</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/bird.png">
        </div>
        <div class="content">
            <div class="header">Kuş</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/horse.png">
        </div>
        <div class="content">
            <div class="header">At</div>
        </div>
    </div>
</div>


<!-- saglik ekranıdır. 'hastalik belirleme(11)' - 'saglikli yasam(12)' - 'cilt bakimi(13)'-->
<div id="saglik-test" class="ui centered link cards">
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/hastalik.png">
        </div>
        <div class="content">
            <div class="header">Hastalık Belirleme</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/live.png">
        </div>
        <div class="content">
            <div class="header">Sağlıklı Yaşam</div>
        </div>
    </div>
    <div class="card">
        <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a href="/bilgi/dna-babalik-testi" class="ui primary button">Bir Sonraki Aşama</a>
                    </div>
                </div>
            </div>
            <img src="/assets/images/hizmet/cilt.png">
        </div>
        <div class="content">
            <div class="header">Cilt Bakımı</div>
        </div>
    </div>
</div>

<script>
    //giris icin tüm divler kapatilir
    $("#aile-test").hide();
    $("#hayvan-test").hide();
    $("#saglik-test").hide();

    //sırayla gerekli olanlar acilip diğerleri kapatilir
    function aileTest(){
        $(".center.aligned.header").html("Aile Bireyinizi Seçiniz!");
        $("#start-test").hide();
        $("#aile-test").show();
        $("#back").attr("href","/detail");
        $("#backimg").attr("src","/assets/images/hizmet/back.png");
    }
    function hayvanTest(){
        $(".center.aligned.header").html("Hayvan Sınıfını Seçiniz!");
        $("#start-test").hide();
        $("#hayvan-test").show();
        $("#back").attr("href","/detail");
        $("#backimg").attr("src","/assets/images/hizmet/back.png");
    }
    function saglikTest(){
        $(".center.aligned.header").html("İhtiyaç Olunan Türü Seçiniz!");
        $("#start-test").hide();
        $("#saglik-test").show();
        $("#back").attr("href","/detail");
        $("#backimg").attr("src","/assets/images/hizmet/back.png");
    }

    $('.centered.link.cards .image').dimmer({
        on: 'hover'
    });
</script>

