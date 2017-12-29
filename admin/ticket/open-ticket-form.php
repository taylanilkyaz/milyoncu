<div id="ticket-segment" class="goodmargin">
    <div class="ui stackable grid">

        <div class="two wide column"></div>
        <div class="six wide column">
            <?php
            /**
             * Kişi en fazla geçmişse dönük 5 tane açık ticket görebilir.
             * Bu implement edilmeli.
             */

            $controller = new TicketController();
            $res = $controller->openParentTickets($_SESSION['id']);
            /**
             * @var $row Ticket
             */
            foreach($res as $row){?>
            <div style="cursor: pointer;" class="ten wide column ticket-summary">
                <div data-id='<?php echo $row->getId();?>' class="ui blue segment parent">
                    <div class="item">
                        <div class="header">
                            <h3 class="header">Destek İsteği</h3>
                        </div>
                        <div class="header">
                            <h4 class="header"> <?php echo $row->getTitle(); ?> </h4>
                        </div>
                        <div class="description">
                            <?php echo $row->getDescription(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            }
            ?>
        </div>

        <div id="detail-container" class="six wide column">

        </div>
        <div class="two wide column"></div>



    </div>
</div>

<script>
    <?php
            $res = $controller->getLastTicketInOpenTickets($_SESSION['id']);
            $type = TicketController::$OPEN_TICKET;
            if($res) {
                $var = <<<script
                $(function(){
                    window.ticketHandler.printTicketDetailById($res,'$type');
                });
script;
                echo $var;
            }
    ?>

</script>