<form class="ui form" action="ajax-update.php" method="post">
    <div class="ui stackable centered grid">
        <div class="ui form segment " id="editUserMenu">
            <div class="field">
                <label>İsim</label>
                <input value="<?php echo $res->getFirstName()?>" name="first-name" type="text">
            </div>
            <div class="field">
                <label>Soyisim</label>
                <input value="<?php echo $res->getLastName()?>" name="last-name" type="text">
            </div>
            <div class="field">
                <label>E-Mail</label>
                <input value="<?php echo $res->getEMail()?>" name="e-mail" type="text">
            </div>
            <div class="field">
                <label>Telefon Numarası</label>
                <input value="<?php echo $res->getPhoneNumber()?>" name="phone-number" type="text">
            </div>
            <div class="field">
                <label>T.C. Kimlik Numarası</label>
                <input value="<?php echo $res->getTc()?>" name="tc-no" type="text">
            </div>
             <div  class="ui green submit button" onclick="myFunction()" id="submit-edit-user">Değişiklikleri Kaydet</div>


            <div class="ui error message"></div>
        </div>
    </div>

</form>

<script>
  function myFunction() {
    document.getElementById("submit-edit-user").innerHTML = "Kaydedildi!";
  }
</script>






