<!--
adminin kullanıcı arama ve düzenleme ekranı
-->
<?php
$csrf_salt = base64_encode(openssl_random_pseudo_bytes(16));
$_SESSION['csrf'] = $csrf_salt;
?>
<div>
    <div class="ui stackable grid">
        <div class="sixteen wide column"></div>
        <div class="centered fourteen wide column">
            <div class="left floated left aligned six wide column">
                <table id="productTableForList" class="ui sortable celled table">
                    <thead>
                    <tr>
                        <th>ÜRÜN İSMİ</th>
                        <th>ÜRÜN FİYATI</th>
                        <th>KISA AÇIKLAMA (65 KARAKTER)</th>
                        <th>UZUN AÇIKLAMA (255 KARAKTER)</th>
                        <th>ÜRÜN FOTOĞRAFI</th>
                        <th>ÜRÜN DÜZENLE</th>
                        <th style="display: none"></th>
                        <th>ÜRÜN SİL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--
                    dinamik olarak dolduruluyor
                    -->

                    </tbody>
                </table>
                <br>
                <div style="text-align: center; ">
                    <button class="ui large green button" onClick="doExport('#productTableForList', {type: 'doc'});">
                        DOC Dosyası İndir
                    </button>
                    <button class="ui large blue button" onClick="doExport('#productTableForList', {type: 'json'});">
                        JSON Dosyası İndir
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="ui fullscreen modal" id="modalForEditProduct">
        <i class="close icon"></i>
        <div class="header">
            Ürün Düzenleme
        </div>
        <div class="content">
            <form enctype="multipart/form-data" method="post" id="editProductForm" action="ajax-update.php">
                <input type="hidden" name="csrf" id="csrf_salt" value="<?php echo $_SESSION['csrf'] ?>"/>

                <div class="ui grid" id="editProductMenu">
                    <div class="three wide column">Ürün Özellikleri</div>
                    <div class="three wide column">Ürün Bilgileri</div>
                    <div class="ten wide column"></div>
                    <!--
                       dinamik olarak doldurulacak, id numaraları artan sırada verilmeli
                       -->
                    <div class="row">
                        <div class="three wide column">İsim:</div>
                        <div id="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="three wide column">Fiyat:</div>
                        <div id="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="three wide column">Kısa Açıklama:</div>
                        <div id="2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="three wide column">UzunAçıklama:</div>
                        <div id="3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="three wide column">Fotoğraf:</div>
                        <div id="4">
                        </div>
                    </div>
                    <div class="row">
                        <div id="6">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="actions">
            <div class="ui button" id="cancelButtonForEditProduct">Kaydetmeden Çık</div>
            <input type="submit" value="Değişiklikleri Kaydet" id="okButtonForEditProduct" form="editProductForm" class="ui green button"  hidden="hidden">
        </div>
    </div>
    <div class="ui basic modal" id="delete-modal">
        <div class="ui icon header">
            <i class="delete icon"></i>
        </div>
        <div class="content">
            <p>Ürünü ve tüm kayıtlarını silmekten emin misiniz?</p>
        </div>
        <div class="actions">
            <div class="ui green ok inverted button" id="okButtonForDeleteProduct">
                <i class="checkmark icon"></i>
                Ok
            </div>
            <div class="ui red basic cancel inverted button" id="deleteButtonForDeleteProduct">
                <i class="remove icon"></i>
                Hayır
            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="/lib/tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/FileSaver/FileSaver.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script type="text/javascript" src="/lib/tableExport/libs/html2canvas/html2canvas.min.js"></script>
<script type="text/javascript" src="/lib/tableExport/tableExport.js"></script>

<script type="text/javaScript">

    function doExport(selector, params) {
        var options = {
            //ignoreRow: [1,11,12,-2],
            ignoreColumn: [4,5,6,7],
            //pdfmake: {enabled: true},
            fileName: 'Urunler'
        };

        $.extend(true, options, params);

        $(selector).tableExport(options);
    }

    function DoOnCellHtmlData(cell, row, col, data) {
        var result = "";
        if (data != "") {
            var html = $.parseHTML( data );

            $.each( html, function() {
                if ( typeof $(this).html() === 'undefined' )
                    result += $(this).text();
                else if ( $(this).is("input") )
                    result += $('#'+$(this).attr('id')).val();
                else if ( $(this).is("select") )
                    result += $('#'+$(this).attr('id')+" option:selected").text();
                else if ( $(this).hasClass('no_export') !== true )
                    result += $(this).html();
            });
        }
        return result;
    }

    function DoOnCsvCellData(cell, row, col, data) {
        var result = data;
        if (result != "" && row > 0 && col == 0) {
            result = "\x1F" + data;
        }
        return result;
    }

    function DoOnXlsxCellData(cell, row, col, data) {
        var result = data;
        if (result != "" && (row < 1 || col != 0)) {
            if ( result == +result )
                result = +result;
        }
        return result;
    }

    function DoOnMsoNumberFormat(cell, row, col) {
        var result = "";
        if (row > 0 && col == 0)
            result = "\\@";
        return result;
    }

</script>