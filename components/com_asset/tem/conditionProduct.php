<?php
$jsonProduct = array();
if (isset($_GET['cat'])) {
    $catValue = $_GET['cat'];
    // $jsonProduct = getProductByCat($catValue);
    $jsonProduct = "[{\"name\": \"Embedded Computers\", \"value\": \"1\"},{\"name\": \"Integrated Circuits (ICs)\", \"value\": \"2\"},
    {\"name\": \"Development Boards, Kits, Programmers\", \"value\": \"2\"}]";
    $jsonProduct = json_decode($jsonProduct);
} else {
    $jsonProduct = "[{\"name\": \"Embedded Computers\", \"value\": \"1\"},{\"name\": \"Integrated Circuits (ICs)\", \"value\": \"2\"},
    {\"name\": \"Development Boards, Kits, Programmers\", \"value\": \"2\"}]";
    $jsonProduct = json_decode($jsonProduct);
}
?>
<form class="smart-form ng-untouched ng-pristine ng-valid" novalidate="">
    <fieldset>
        <article class="col-lg-8">
            <section>
                <label class="label"><strong>Tổng số: <?php echo count($jsonProduct)?> sản phẩm</strong></label>
                <ul class="list_product">
                    <?php
                        for ($i=0; $i < count($jsonProduct); $i++) { ?>
                        <li><a href="#" onclick="chooseProduct('<?php echo $jsonProduct[$i]->value?>')"><?php echo $jsonProduct[$i]->name?></a></li>        
                    <?php }
                    ?>
                    
                </ul>
            </section>  
        </article>
        <article class="col-lg-4">
            <section>
                <label class="label title_sub_product"></label>
                <ul class="list_sub_product" id="list_sub_product">
                   <!-- Fill data sub product -->
                </ul>
            </section>
            
        </article>
    </fieldset>
</form>
<script type="text/javascript">
    function chooseProduct(product) {
        $(".img_loading").css({'display':'block'});
        $.post("<?php echo ROOTHOST;?>ajaxs/getSubProduct.php",{product: product},function($rep){
            $("#list_sub_product").html($rep);
            setTimeout(function(){
                $(".img_loading").css({'display':'none'});
            }, 1000)            
        })
    }

    $(".list_product li").click(function() {
        var name = $(this).children().html();
        $(".title_sub_product").html("Nhánh con của sản phẩm: <strong>" + name + "</strong>");
        $(".list_product li").removeClass('active');
        $(this).addClass('active');
    })
</script>
<style type="text/css">
    .list_product,
    .list_sub_product {
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
    }
    .list_product li.active {
        background: #00918d;
    }
    .list_product li.active a {
        color: #fff;
        font-size: 14px;
    }
    .list_sub_product li {
        padding: 5px 0;
    }
    .list_sub_product li:hover {
        text-decoration: underline;
    }
</style>