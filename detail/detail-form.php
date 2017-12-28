<body>
<link rel="stylesheet" type="text/css" href="dev.css">
<script src="../lib/detail/detail.js" type="text/javascript" charset="utf-8"></script>

<div id="detail-header">
    <img class="ui centered image" src="img/logo-64.png">
</div>

<div class="ui divider"></div>


<div id="detail-container">

    <div id="detail-test-info" class="ui fluid container info">
        <h2 class="ui center aligned header">
            Nasıl bir hizmete ihtiyacın var ?
        </h2>

    </div>

    <div id="detail-aile-info" class="ui fluid container info">
        <div onclick="window.detailHandler.firstMode()" class="muhammet-back">
            <i class="large angle left icon"></i>&nbsp;&nbsp;<span>Geri Dön</span>
        </div>
        <h2 class="ui center aligned header">
            Şimdi test yaptıracağınız aile bireyini seçebilirsiniz...
        </h2>

    </div>

    <div id="detail-hayvan-info" class="ui fluid container info">
        <div onclick="window.detailHandler.firstMode()" class="muhammet-back">
            <i class="large angle left icon"></i>&nbsp;&nbsp;<span>Geri Dön</span>
        </div>
        <h2 class="ui center aligned header">
            Test yaptırmak istediğiniz hayvanı seçebilirsiniz...
        </h2>

    </div>

    <div id="detail-saglik-info" class="ui fluid container info">
        <div onclick="window.detailHandler.firstMode()" class="muhammet-back">
            <i class="large angle left icon"></i>&nbsp;&nbsp;<span>Geri Dön</span>
        </div>
        <h2 class="ui center aligned header">
            Şimdi ihtiyaç olunan alanı seçebilirsiniz...
        </h2>

    </div>


    <!-- giriş ekranıdır. aile - hayvan - saglik - koken -->
    <div id="detail-test">
        <div class="ui three column doubling stackable centered grid">
            <div class="center aligned centered column">

                <div data-click-job="aile" class="ui segment" id="aile">
                    <img class="ui centered fluid image" src="img/family.png">
                    <p class="below-image">Aile</p>
                </div>
            </div>
            <div class="center aligned centered column">

                <div data-click-job="hayvan" class="ui segment" id="hayvan">
                    <img class="ui centered fluid image" src="img/dog.png">
                    <p class="below-image">Hayvan</p>
                </div>
            </div>
            <div class="center aligned centered  column">
                <div data-click-job="sağlık" class="ui segment" id="sağlık">
                    <img class="ui centered fluid image" src="img/cardiogram.png">
                    <p class="below-image">Sağlık</p>
                </div>
            </div>

            <div class="center aligned centered  column">

                <div class="ui segment" data-value="13">
                    <img class="ui centered fluid image" src="img/geography.png">
                    <p class="below-image">Köken</p>
                </div>
            </div>
        </div>
    </div>

    <!-- aile ekranıdır. 'baba(1)' - 'anne(2)' - 'kardes(3)' - 'büyükanne(4)' - 'hala-amca'(5) - 'ihanet'(6)-->
    <div id="detail-aile-test">
        <div class="ui three column doubling stackable centered grid">
            <div class="center aligned centered column">
                <div class="ui segment" data-value="1">
                    <img class="ui centered fluid image" src="img/fatherhood.png">
                    <p class="below-image">Baba</p>
                </div>
            </div>

            <div class="center aligned centered column">
                <div class="ui segment"  data-value="2">
                    <img class="ui centered fluid image" src="img/motherhood.png">
                    <p class="below-image">Anne & Hamilelik</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="3">
                    <img class="ui centered fluid image" src="img/children.png">
                    <p class="below-image">Kardeş</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="4">
                    <img class="ui centered fluid image" src="img/grandparents.png">
                    <p class="below-image">Büyükanne-Büyükbaba</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="5">
                    <img class="ui centered fluid image" src="img/couple.png">
                    <p class="below-image">Hala - Amca</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="6">
                    <img class="ui centered fluid image" src="img/fertilization.png">
                    <p class="below-image">Sadakatsizlik</p>
                </div>
            </div>
        </div>
    </div>

    <!-- hayvan ekranıdır. 'kedi(7)' - 'kopek(8)' - 'kus(9)' - 'at(10)' -->
    <div id="detail-hayvan-test">
        <div class="ui three column doubling stackable centered grid">
            <div class="center aligned centered column">
                <div class="ui segment"  data-value="7">
                    <img class="ui centered fluid image" src="img/cat.png">
                    <p class="below-image">Kedi</p>
                </div>
            </div>

            <div class="center aligned centered column">
                <div class="ui segment"  data-value="8">
                    <img class="ui centered fluid image" src="img/dog-real.png">
                    <p class="below-image">Köpek</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="9">
                    <img class="ui centered fluid image" src="img/bird.png">
                    <p class="below-image">Kuş</p>
                </div>
            </div>

            <div class="center aligned centered  column">
                <div class="ui segment"  data-value="10">
                    <img class="ui centered fluid image" src="img/horse.png">
                    <p class="below-image">At</p>
                </div>
            </div>
        </div>
    </div>

    <!-- saglik ekranıdır. 'hastalik belirleme(11)' - 'saglikli yasam(12)'-->
    <div id="detail-saglik-test">
        <div class="ui three column doubling stackable centered grid">
            <div class="center aligned centered column">
                <div class="ui segment"  data-value="11">
                    <img class="ui centered fluid image" src="img/running.png">
                    <p class="below-image">Sağlıklı Yaşam</p>
                </div>
            </div>
            <div class="center aligned centered column">
                <div class="ui segment"  data-value="12">
                    <img class="ui centered fluid image" src="img/hospital.png">
                    <p class="below-image">Hastalık Belirleme</p>
                </div>
            </div>
        </div>
    </div>

</div>
