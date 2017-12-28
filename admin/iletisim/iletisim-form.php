<?php
$contactObj = new ContactDatabase();
$contacts = $contactObj->getAllContacts();
foreach ($contacts as $contact){
    /**
     * @var $contact Contact
     */
    ?>
    <div class="ui card" style="width: 100%">
        <div class="content">
            <a class="header"><?php echo $contact->getSubject()?></a>
            <div class="meta">
                <span class="date"><?php echo $contact->getUserName()?></span><br>
                <span class="date"><?php echo $contact->getEmail()?></span>
            </div>
            <div class="description">
                <?php echo $contact->getMessage()?>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>


<?php
}

?>
