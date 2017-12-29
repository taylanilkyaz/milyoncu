(function( $, window, document, undefined ) {
    'use strict';
    var productId;
    function attachMenuKeyup(){
        //kaydet butonu görünür olur
        $("#editProductMenu").keyup(function (event) {
            if (event.keyCode!=17 && event.keyCode!=18){
                $('#okButtonForEditProduct').show();
            }
        });
    }

    function attachMenuClick() {
        $("#editProductMenu").on('click', '#file-input',function () {
            $('#okButtonForEditProduct').show();
        });
    }
    
    function handleDeleteButton() {
        $('#productTableForList').on('click','#deleteButtonForProduct',function () {
            $('.ui.basic.modal')
                .modal('show');

            //tabloda hangi ürün için düzenle butonuna bastığı bulunur
            var $row = $(this).closest("tr"),
                $tds = $row.find("td");
            $.each($tds, function(index) {
                if (index==6){
                   productId=$(this).text();
                }
            });
        })
    }

    function handleOkButtonForDelete() {
        $("#okButtonForDeleteProduct").click(function () {
            deleteProduct(productId);
        })
    }

    function handleModal(){
        $("#delete-modal").modal({
            onHide: function () {
                searchDb();
            }
        });
    }

    function deleteProduct(productId) {
        $.ajax({
            method: "POST",
            url:    "ajax-delete.php",
            data:   {id:productId},
            success: function (data) {
                alert("Ürün veritabanından kaldırıldı.");
                searchDb();
            }
        })
    }

    function handleEditButton(){
        debugger;
        var str;
        $('#productTableForList').on('click', '#editButtonForProduct',function(){
            //düzenleme modalı gösterilir
            $('.fullscreen.modal')
                .modal('show');
            //kaydet butonu saklanır
            $('#okButtonForEditProduct').hide();

            //tabloda hangi ürün için düzenle butonuna bastığı bulunur
            var $row = $(this).closest("tr"),
                $tds = $row.find("td");
            //butonun içinde bulunduğu satırdaki veriler alınır
            $.each($tds, function(index) {
                //edit butonu dahil edilmez
                if (index==5)
                    return true;
                //modala stringler append edilir
                var div = document.getElementById(index);
                div.innerHTML = "";
                if (index==4){
                    str = '<div class="image-upload">'+
                        '<label for="file-input">'+
                        this.innerHTML+
                        '</label>'+
                        '<input style="display: none" id="file-input" type="file" name="photo"/>'+
                        '</div>';
                }   else if (index==0){
                    str = '<div style="width:250px" class="five wide column"><input name="product_name"  type="text" value="'+$(this).text()+'"></div>';
                }   else if (index==1){
                    str = '<div  style="width:250px" class="five wide column"><input name="product_price" type="text" value="'+$(this).text() + '"></div>';
                }   else if (index==2){
                    str = '<div  style="width:250px" class="five wide column"><input name="product_desc"type="text" value="'+$(this).text() + '"></div>';
                }   else if (index==3){
                    str = '<div style="width:250px" class="five wide column"><input name="product_long_desc"  type="text" value="'+$(this).text()+'"></div>'
                }   else if (index==6){
                    str = '<div style="display:none; width:250px;" class="five wide column"><input name="product_id"  type="text" value="'+$(this).text() + '"></div>';
                }
                div.innerHTML= div.innerHTML+str;
            });
        });
    }

    function searchDb() {
        $.ajax({
            method: "GET",
            url: "ajax.php",
            datatype: JSON,
            success: function(data){
                //burada elimizde databaseden alınan ürün verileri var
                //verileri tabloya eklemeliyiz
                fillProductTable(JSON.parse(data));
            }
        });
    }
    /**
     * Dinamik olarak tablo doldurma fonksiyonu
     * @param data
     */
    function fillProductTable(data) {
        $('#productTableForList').find('tbody').empty();
        $.each(data,function () {
            var str = '<tr><td>'+this.isim+'</td>'+'<td>'+this.fiyat+'</td>'+'<td>'+this.kısa_açıklama+'</td>'+
                    '<td>'+this.uzun_açıklama+'</td>'+
                '<td>'+'<img src="'+'/assets/images/productimage/512/'+this.resim_yeri+'" alt="" border=3 height=50 width=50></img>'+'</td>'+
                '<td><button class="ui labeled icon button" id="editButtonForProduct"><i class="edit icon"></i> Düzenle </button></td>' +
                '<td style="display:none;">'+this.id+'</td>'+'<td><button class="negative ui button" id="deleteButtonForProduct">Kaldır</button></td>'+'</tr>';
            $('#productTableForList').append(str);
        })
    }

    function handleCancelButton() {
        $('#cancelButtonForEditProduct').click(function () {
            $('.fullscreen.modal')
                .modal('hide');
        });
    }

    function initialize() {
        attachMenuKeyup();
        attachMenuClick();
        handleOkButtonForDelete();
        handleModal();
        handleDeleteButton();
        handleEditButton();
        handleCancelButton();
        searchDb();
    }


    window.editProductHandler= {
        init : initialize
    };

    //after the DOM is ready call our init function
    $(function(){
        editProductHandler.init();
    });
})( jQuery, window, document );
