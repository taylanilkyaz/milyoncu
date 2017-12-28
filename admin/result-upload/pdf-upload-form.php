<?php
$relation_obj = new OrderBuyRelationDatabase();
$order_code_array = $relation_obj->getAllOrderCodes();
$check = false;
?>
<div id="result-upload-container">
    <?php
    for ($i = 0; $i < count($order_code_array); $i++) {
        $check = true;
        $order_code = $order_code_array[$i]['order_code'];
        $order_status = $relation_obj->getOrderStatus($order_code);
        if ($order_status == 5) { ?>
            <form action="upload-to-folder.php" method="post" enctype="multipart/form-data">
                <div class="ui stackable grid">
                    <div class="middle aligned center floated four wide column">
                        <h1>
                            <?php echo $order_code ?>

                        </h1>
                        <input class="order-code-container" style="display: none" name="order_code" value="<?php echo $order_code ?>">
                    </div>
                    <div class="middle aligned four wide column">
                        <div class="image">
                            <img src="/assets/images/qr-codes/<?php echo md5($order_code) ?>_L_sub.png">
                        </div>
                    </div>
                    <div class="middle aligned four wide column">
                        <div class="ui blue button" type="button">
                            <label for="for-span">Select PDF</label>

                        </div>
                        <input id="for-span" style="display: none;" type="file" name="file" size="50"/>
                    </div>
                    <div class="middle aligned four wide column">
                        <button type="submit" class="ui green button" id="save-button" style="margin-right: 0px">
                            Save
                        </button>
                    </div>
                </div>
            </form>
            <div class="ui divider"></div>
            <?php
        }
    }
    if (!$check){ ?>
        <div>There is no sample that is in test right now.</div>
    <?php
    }

    ?>

</div>

