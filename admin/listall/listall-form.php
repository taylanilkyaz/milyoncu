


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
                    <button class="ui large green button" onClick="doExport('#dbTableForList', {type: 'doc'});">
                        DOC Dosyası İndir
                    </button>
                    <button class="ui large blue button" onClick="doExport('#dbTableForList', {type: 'json'});">
                        JSON Dosyası İndir
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
            ignoreColumn: [4,5],
            //pdfmake: {enabled: true},
            fileName: 'Kullanicilar'
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