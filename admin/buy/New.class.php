<div class="ui grid" id="${id}">
    <div class="mobile only row">
        <div class="sixteen wide column">
            <h4 class="product-name">
                <a href="../product-description/index.php?name=${name}" >${name}</a>
            </h4>
            <a href="../product-description/index.php?name=${name}">
                <img src="/assets/images/productimage/512/${image_path}">
            </a>
        </div>
        <div class="sixteen wide column flex-parent">
            <div class="container sepetim-count-input">
                <div class="count-input">
                    <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                    <input readonly class="quantity" type="text" name="quantity" value="${count} Adet"/>
                    <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                </div>
            </div>

            <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>

        </div>
        <div class="sixteen wide column">
            <a class="btn-delete ui button" href="#" ><b><i class="trash icon"></i>Sil</b></a>

        </div>
    </div>

    <div class="tablet only row">
        <div class="sixteen wide column">
            <h4 class="product-name">
                <a href="../product-description/index.php?name=${name}" >${name}</a>
            </h4>
        </div>
        <div class="eight wide column">
            <a href="../product-description/index.php?name=${name}">
                <img src="/assets/images/productimage/512/${image_path}">
            </a>
        </div>
        <div class="eight wide column">
            <div class="row">
                <div class="container sepetim-count-input">
                    <div class="count-input">
                        <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                        <input readonly class="quantity" type="text" name="quantity" value="${count} Adet"/>
                        <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                    </div>
                </div>
            </div>
            <div class="row flex-parent">
                <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>
                <a class="btn-delete ui button" href="#" ><b><i class="trash icon"></i>Sil</b></a>
            </div>
        </div>
    </div>

    <div class="computer only row">
        <div class="three wide column">
            <a href="../product-description/index.php?name=${name}">
                <img src="/assets/images/productimage/512/${image_path}">
            </a>
        </div>
        <div class="five wide column">
            <h4 class="product-name">
                <a href="../product-description/index.php?name=${name}" >${name}</a>
            </h4>
            <a class="btn-delete ui button" href="#" ><b><i class="trash icon"></i>Sil</b></a>
        </div>
        <div class="eight wide column flex-parent">
            <div class="four wide column">
                <div class="container sepetim-count-input">
                    <div class="count-input">
                        <a class="incr-btn" data-action="decrease" href="#" title="Azalt"><b>&minus;</b></a>
                        <input readonly class="quantity" type="text" name="quantity" value="${count} Adet"/>
                        <a class="incr-btn" data-action="increase" href="#" title="Arttır"><b>&plus;</b></a>
                    </div>
                </div>
            </div>
            <div class="four wide column">
                <div class="col-total-sepetim"><i class="lira icon"></i><b><span class="price-span">${price}</span></b></div>
            </div>
        </div>

    </div>
    <div class="ui divider"></div>
</div>