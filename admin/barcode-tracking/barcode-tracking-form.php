<?php
$relation_obj = new OrderBuyRelationDatabase();
$order_code_array = $relation_obj->getAllOrderCodes();

?>
<div id="barcode-tracking-container">

    <div class="left floated left aligned six wide column">
        <table id="example" class="ui celled table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($order_code_array); $i++) {
                $order_code = $order_code_array[$i]['order_code'];
                $order_status = $relation_obj->getOrderStatus($order_code);
                if ($order_status == 3) { ?>
                    <tr>
                        <td>
                            <div class="ui stackable grid">
                                <div class="center aligned center floated four wide column">
                                    <label><?php echo $order_code ?></label>
                                </div>
                                <div class="center aligned six wide column">
                                    <div class="ui slider checkbox">
                                        <input type="checkbox" name="newsletter">
                                        <label>Order received</label>
                                    </div>
                                </div>
                                <div class="middle aligned six wide column">
                                    <div class="image">
                                        <img src="/assets/images/qr-codes/<?php echo md5($order_code) . '_L_sub.png' ?>">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="barcode-tracking-buttons" style="float: left ; margin-top: 1%">
        <button class="ui blue button" id="save-button" style="margin-right: 0px">
            Save
        </button>
        <button class="ui blue button">
            Cancel
        </button>
    </div>
</div>
