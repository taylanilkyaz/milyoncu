<div id="ticket-content">
    <?php

        if(!isset($_GET['go'])) {
            require "submit-ticket-form.php";
            echo "</div>";
            return;
        }


        switch($_GET['go']){
            case TicketController::$SUBMIT_TICKET:
                require "submit-ticket-form.php";
                break;
            case TicketController::$OPEN_TICKET:
                if(isset($_GET['dataId']))
                    $dataId = $_GET['dataId'];
                require "open-ticket-form.php";
                break;
            case TicketController::$CLOSED_TICKET:
                require "closed-ticket-form.php";
                break;
            default:
                echo "Bunu neden yapıyosun ? Yapma :s";
                break;
        }
    ?>
</div>
