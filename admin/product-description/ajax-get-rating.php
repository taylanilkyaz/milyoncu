<?php
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'system-header.php';
if (isset($_GET['product_name'])) {
    $productName = $_GET['product_name'];
    $productDatabaseObj = new ProductDatabase();
    $commentDatabaseObj = new CommentDatabase();
    $product = $productDatabaseObj->getProductByName($productName);
    $rateArray = $commentDatabaseObj->getRateArray($product->getId());
    $sum = 0;
    $weightSum = 0;
    for ($i = 0; $i < count($rateArray); $i++) {
        $sum += $rateArray[$i];
        $weightSum += $rateArray[$i] * ($i + 1);
    }
    if ($sum != 0) {
        $average = $weightSum / $sum;
        $average = number_format($average, 1, '.', '');
        $fiveStarRate = floor($rateArray[4] / $sum * 100);
        $fourStarRate = floor($rateArray[3] / $sum * 100);
        $threeStarRate = floor($rateArray[2] / $sum * 100);
        $twoStarRate = floor($rateArray[1] / $sum * 100);
        $oneStarRate = floor($rateArray[0] / $sum * 100);
        $floorAverage = floor($average);
    }

    $str = "";
    $imagePath = $product->getImagePath();
    $str .= <<<HTML
        <div class="ui stackable grid" id="ajax-rating-container">
                <!-- <div class="four wide column">
                   <img style="object-fit: contain;" src="https://objects.23andme.com/res/img/public/sections/welcome_one/JMTAZcDJiG29i-jpqIa2nQ_kit_standing.png">
                </div>
-->
HTML;
    if ($sum != 0) {
        $str .= <<<HTML
<div class="six wide column" id="all-five-star">
                        <div class="ui stackable grid">
                            <div class="six wide column">
                                <div class="flex-container column">
                                    <div class="item">
                                        <div class="ui star rating" data-rating="5" data-max-rating="5"></div>
                                    </div>
                                    <div class="item">
                                        <span>Çok iyi (${rateArray[4]})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="left floated left aligned ten wide column">
                                <div class="ui orange progress"
                                     data-percent="${fiveStarRate}">
                                    <div class="bar">
                                    </div>
                                    <div class="label"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ui stackable grid">
                            <div class="six wide column">
                                <div class="flex-container column">
                                    <div class="item">
                                        <div class="ui star rating" data-rating="4" data-max-rating="5"></div>
                                    </div>
                                    <div class="item">
                                        <span>İyi (${rateArray[3]})</span>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="left floated left aligned ten wide column">
                                <div class="ui orange progress"
                                     data-percent="${fourStarRate}">
                                    <div class="bar">
                                    </div>
                                    <div class="label"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ui stackable grid">
                            <div class="six wide column">
                                <div class="flex-container column">
                                    <div class="item">
                                        <div class="ui star rating" data-rating="3" data-max-rating="5"></div>
                                    </div>
                                    <div class="item">
                                        <span>Ortalama (${rateArray[2]})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="left floated left aligned ten wide column">
                                <div class="ui orange progress"
                                     data-percent="${threeStarRate}">
                                    <div class="bar">
                                    </div>
                                    <div class="label"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ui stackable grid">
                            <div class="six wide column">
                                <div class="flex-container column">
                                    <div class="item">
                                        <div class="ui star rating" data-rating="2" data-max-rating="5"></div>
                                    </div>
                                    <div class="item">
                                        <span>Kötü (${rateArray[1]})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="left floated left aligned ten wide column">
                                <div class="ui orange progress"
                                     data-percent="${twoStarRate}">
                                    <div class="bar">
                                    </div>
                                    <div class="label"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ui stackable grid">
                            <div class="six wide column">
                                <div class="flex-container column">
                                    <div class="item">
                                        <div class="ui star rating" data-rating="1" data-max-rating="5"></div>
                                    </div>
                                    <div class="item">
                                        <span>Çok kötü (${rateArray[0]})</span>
                                    </div>
                                </div>

                            </div>
                            <div class="left floated left aligned ten wide column">
                                <div class="ui orange progress"
                                     data-percent="${oneStarRate}">
                                    <div class="bar">
                                    </div>
                                    <div class="label"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="six wide column">
                        <div class="speech-ballon">
                        <div class="on border text" style="margin-top: -8% ; width: 70% ; background-color: white ; margin-left: 10% ; font-size: 18px">Ortalama Puan</div>
                            <div class="ui massive star rating" style="padding-top: 5%"
                                 data-rating="${floorAverage}"
                                 data-max-rating="5" id="averageStar">
                            </div>
                            <div>
                                <h1 style="font-size:600% ">
                                    ${average}
                                </h1>
                            </div>

                        </div>
                    </div>
HTML;

    } else {
        $str .= <<<HTML
        <div class="twelve wide column">
                        <div class="ui segment">
                            <div class="field">     <!-- eger daha önceden yorum yapılmışsa gözükmeyecek-->
                                <div class="content">
                                <h1>
                                <div class="header">İlk yorumu sen yaz</div>
                                    <div class="meta">
                                        <span class="date">Bu ürün hakkında puanlama yapılmamıştır.</span>
                                    </div>
</h1>
                                    
                                </div>
                                <br>
                      
                            </div>
                        </div>
                    </div>
HTML;

    }

    echo $str;
}



