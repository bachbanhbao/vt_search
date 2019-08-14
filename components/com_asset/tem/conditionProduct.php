<?php
$jsonProduct = array();
if (isset($_GET['cat'])) {
    $idxCat = $_GET['cat'];
} else {
    if (isset($_SESSION['CAT'])) {
        $idxCat = 0;
    }    
}
$urlCat = $_SESSION['CAT'][$idxCat]->url;
$jsonProduct = getProductByCategory(ROOTHOST_API_SEARCH , $urlCat);
$jsonProduct = json_decode($jsonProduct);
?>
<form class="smart-form ng-untouched ng-pristine ng-valid" novalidate="">
    <fieldset>
        <article class="col-lg-12">
            <section>
                <label class="label"><strong>Tổng số: <?php echo count($jsonProduct)?> sản phẩm</strong></label>
                <ul class="list_product">
                    <?php
                        for ($i=0; $i < count($jsonProduct); $i++) { ?>
                            <li class="<?php if ($i==0) echo 'active'?>" url_pro="<?php echo $jsonProduct[$i]->url?>" onclick="chooseProduct('<?php echo $jsonProduct[$i]->url?>', '<?php echo $idxCat;?>')" idx_cat="<?php echo $idxCat;?>">
                                <a href="#"><i class="fa fa-cog"></i>&nbsp;<?php echo $jsonProduct[$i]->name?></a>
                            </li>        
                    <?php } ?>
                </ul>
            </section>  
        </article>
        <article class="col-lg-12 article-type-pro">
            <section class="session_type_pro">
                <label class="label title_type_product"></label>
                <div id="list_type_product">
                    <!-- Fill type of products -->
                </div>     
            </section>
        </article>
    </fieldset>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        // get list type of product default on load page
        var urlProDefault = $(".list_product li.active").attr('url_pro');
        var idxCat = $(".list_product li.active").attr('idx_cat');
        var name = $(".list_product li.active").children().html();
        if (name) {
            $(".title_type_product").html("<strong>Type của sản phẩm: " + name + "</strong>");
        }
        
        $.post("<?php echo ROOTHOST;?>ajaxs/getTypeProduct.php",{url_product: urlProDefault, idx_cat: idxCat},function($rep){
            $("#list_type_product").html($rep);
            setTimeout(function(){
                $(".img_loading").css({'display':'none'});
            }, 1000)            
        })

        // event click on product
        $(".list_product li").click(function() {
            var name = $(this).children().html();
            if (name) {
                $(".title_type_product").html("<strong>Type của sản phẩm: " + name + "</strong>");
            }
            
            $(".list_product li").removeClass('active');
            $(this).addClass('active');
        })
    })

    // event onclick product then get type by ajaxs
    function chooseProduct(urlProduct, idxCat) {
        $(".img_loading").css({'display':'block'});
        $.post("<?php echo ROOTHOST;?>ajaxs/getTypeProduct.php",{url_product: urlProduct, idx_cat: idxCat},function($rep){
            $("#list_type_product").html($rep);
            setTimeout(function(){
                $(".img_loading").css({'display':'none'});
            }, 1000)            
        })
    }

    // event onclick type of products then get item by type -> redirect new page result item
    function getUrlTypeOfProduct(idxType, urlPro, idxCat) {
        $(".img_loading").css({'display':'block'});
        $.post("<?php echo ROOTHOST;?>ajaxs/countRecordOfType.php",{idxType: idxType, urlPro: urlPro},function($rep){
            if ($rep == 'no_record') {
                smartInfoMsg('Thông báo', 'Không có bản ghi nào', 3000);
            } else {
                window.location = 'cat-' + idxCat + '-search-by-type-' + $rep;
            }
        })
    }
</script>
<style type="text/css">
    .article-type-pro {
        margin-top: 15px;
        border-top: 2px solid #ccc;
    }
    .session_type_pro {
        padding: 20px 0;    
    }
    .list_product,
    .list_type_product {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .list_product li {
        float: left;
        padding: 5px 10px;
        height: 26px;
        border: 1px solid #ddd;
        margin: 5px;
        line-height: 26px;
     }
    .list_product li:hover {
        background: #eee;
        cursor: pointer;
    }
    .list_product li.active {
        background: #00918d;
    }
    .list_product li.active a {
        color: #fff;
        font-size: 14px;
    }
    .list_type_product li {
        padding: 5px 5px;
        height: 26px;
        border: 1px solid #ccc;
        margin: 5px;
        line-height: 26px;
    }
    .list_type_product li:hover {
        text-decoration: underline;
        background: #eee;
        cursor: pointer;
    }
    .list_type_product li a {
        font-size: 14px;
    }
</style>