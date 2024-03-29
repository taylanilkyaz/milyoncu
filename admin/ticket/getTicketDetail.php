<?php

require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
/**
 * Kişi en fazla geçmişse dönük 5 tane açık ticket görebilir.
 * Bu implement edilmeli.
 */

$controller = new TicketController();
$ticketId = $_POST['ticketId'];
if (isset($_POST['type']))
    $type = $_POST['type'];
else
    $type = TicketController::$OPEN_TICKET;



$resParent = $controller->getTicketByID($_SESSION['id'],$ticketId);

/**
 * @var $resParent Ticket
 */
?>

    <div class="ten wide column ticket-summary">
        <div data-id='<?php echo $resParent->getId();?>' class="ui blue segment parent">
            <div class="item">
                <div class="header">
                    <h3 class="header">Destek İsteği</h3>
                </div>
                <div class="header">
                    <h4 class="header"> <?php echo $resParent->getTitle(); ?> </h4>
                </div>
                <div class="description">
                    <?php echo $resParent->getDescription(); ?>
                </div>
            </div>
        </div>
    </div>

<?php
$res = $controller->getTicketListByParentId($_SESSION['id'],$ticketId);

/**
 * @var $row Ticket
 */
foreach($res as $row) {
    ?>
    <div class="ten wide column">
        <div data-id='<?php echo $row->getId(); ?>' class="ui blue segment parent">
            <div class="item"><?php
                if ($row->getUserId() == $_SESSION['id'] && UserTypes::$TYPICAL_USER == $_SESSION['user_type']  ){
                    ?>
                    <div class="header">
                        <h3 class="header">Destek İsteği</h3>
                    </div>
                <?php
                } else if ($row->getUserId() == $_SESSION['id'] && UserTypes::$ADMIN_USER == $_SESSION['user_type'] ){
                    ?>
                    <div class="header">
                        <h3 class="header" style="color: #33cc2b;">Destek Cevabı</h3>
                    </div>
                    <?php
                }
                else if ( UserTypes::$ADMIN_USER == $_SESSION['user_type'] )
                {
                    ?>
                    <div class="header">
                        <h3 class="header">Destek İsteği</h3>
                    </div>
                <?php
                }
                else if ( UserTypes::$TYPICAL_USER == $_SESSION['user_type'] )
                {
                    ?>
                    <div class="header">
                        <h3 class="header" style="color: #33cc2b;">Destek Cevabı</h3>
                    </div>
                    <?php
                }
            ?>
                <div class="header">
                    <h4 class="header"> <?php echo $row->getTitle(); ?> </h4>
                </div>
                <div class="description">
                    <?php echo $row->getDescription(); ?>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>

<?php
    if($type == TicketController::$OPEN_TICKET){
        ?>

<div style="margin: 2em 0;" class="ten wide column">

    <form class="ui fluid form" method="post" action="submit-ticket.php">

        <div class="field">
            <textarea  type="text" name="detail"  placeholder="Sorunuzu veya cevabınızı yazabilirsiniz."></textarea>
        </div>

        <div style="display: none" class="field">
            <input name="parentId" value="<?php echo $ticketId ?>" type="text" >
        </div>

        <input value="Gönder" name="save" class="huge ui button" type="submit"id="sendTicket">

        <input value="insertToParent" style="display: none" name="type" type="text">
    </form>

</div>

<?php

}elseif($type == TicketController::$CLOSED_TICKET){?>
        <div style="margin: 2em 0;" class="ten wide column">

            <form class="ui fluid form" method="post" action="submit-ticket.php">

                <div style="display: none" class="field">
                    <input name="parentId" value="<?php echo $ticketId ?>" type="text" >
                </div>

                <input value="Talebi Yeniden Aç" name="reopen" class="huge ui button" type="submit"id="sendTicket">
            </form>

        </div>
<?php

    }
?>
