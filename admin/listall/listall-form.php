


<script>
    function myFunction() {
        $("#buttonForSearch").click();
    }
</script>
<body onload="myFunction()">
<div>
    <div class="ui stackable grid">
        <div class="sixteen wide column"></div>
        <div class="right floated right aligned fourteen wide column">
            <div class="ui selection dropdown">
                <i class="dropdown icon"></i>
                <div class="default text">Arama Yöntemi</div>
                <div id="selectMenuForSearch" class="menu">
                    <div class="item" data-value="0">İsme Göre</div>
                    <div class="item" data-value="1">Soy İsme Göre</div>
                    <div class="item" data-value="2">Telefon Numarasına Göre</div>
                    <div class="item" data-value="3">Maile Göre</div>
                </div>
            </div>

            <div class="ui icon input">
                <input id ="inputValueForSearch" type="text" placeholder="Search...">
                <i class="inverted circular search link icon" input id="buttonForSearch" type="button"></i>
            </div>
        </div>
        <div class="one wide column">

        </div>

        <div class="centered fourteen wide column">
            <div class="left floated left aligned six wide column">
                <table id="dbTableForList" class="ui sortable celled table">
                    <thead>
                    <tr>
                        <th>İSİM</th>
                        <th>SOYİSİM</th>
                        <th>MAİL</th>
                        <th>TELEFON</th>
                        <th>KULLANICI DÜZENLE</th>
                        <th>GEÇMİŞ SİPARİŞLERİ GÖRÜNTÜLE</th>
                    </tr>
                    </thead>
                    <tbody id="db-table-for-list-tbody">
                    <!--
                    dinamik olarak dolduruluyor
                    -->

                    </tbody>
                </table>
                <br>
                <div style="text-align: center; ">
                    <button class="ui large green button" onclick="javascript:pdf();">
                        PDF Yazdır
                    </button>
                </div>
            </div>
        </div>

    </div>



    <div class="ui fullscreen modal" id="modal">
        <i class="close icon"></i>
        <div class="header">
            Kullanıcı Düzenleme
        </div>
        <div class="content">
            <div class="ui grid" id="editMenuByAdmin">

            </div>

        </div>
        <div class="actions">
            <div class="ui button" id="cancelButtonForEditByAdmin">Kaydetmeden Çık</div>
            <div class="ui green button" id="okButtonForEditByAdmin" style="display: none">Değişiklikleri Kaydet</div>
        </div>
    </div>


</div>

</body>
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script>
    function pdf() {
        var dataSource = shield.DataSource.create({
            data: "#dbTableForList",
            schema: {
                type: "table",
                fields: {
                    İSİM : { type: String },
                    SOYİSİM : { type: String },
                    MAİL : { type: String },
                    TELEFON : { type: String }
                }
            }
        });

        dataSource.read().then(function (data) {
            var pdf = new shield.exp.PDFDocument({
                author: "Milyoncu",
                created: new Date()
            });

            pdf.addPage("a4", "portrait");

            pdf.table(
                50,
                50,
                data,
                [
                    { field: "İSİM", title: "Ad", width: 100 },
                    { field: "SOYİSİM", title: "Soyad", width: 100 },
                    { field: "MAİL", title: "E-Mail", width: 200 },
                    { field: "TELEFON", title: "Telefon", width: 100 }
                ],
                {
                    margins: {
                        top: 50,
                        left: 50
                    }
                }
            );

            pdf.saveAs({
                fileName: "kullanicilar"
            });
        });
    }
</script>