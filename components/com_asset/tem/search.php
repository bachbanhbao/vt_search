 
<?php
if (isset($_GET['product'])) {
    $product = $_GET['product'];
    $condition = array('cat' => '1', 'product' => $product);
    $jsonData = searchDataByProduct($condition);
}

if (isset($_POST['submit-form'])) {
    $lstData = $_POST['multi-a'];
    var_dump($lstData);
}
?>
<form class="smart-form ng-untouched ng-pristine ng-valid" novalidate="" id="form-search" method="POST" action="">
    <fieldset>
        <div class="row">
            <section class="col col-3">
                <label class="label">Multiple select</label>
                <label class="select select-multiple">
                    <select class="custom-scroll" multiple="multiple" name="multi-a[]" id="cbo_1">
                        <option value="1">Alexandra</option>
                        <option value="2">Alice</option>
                        <option value="3">Anastasia</option>
                        <option value="4">Avelina</option>
                        <option value="5">Basilia</option>
                        <option value="6">Beatrice</option>
                        <option value="7">Cassandra</option>
                        <option value="8">Clemencia</option>
                        <option value="9">Desiderata</option>
                    </select>
                </label>
            </section>  
            <section class="col col-3">
                <label class="label">Multiple select</label>
                <label class="select select-multiple">
                    <select class="custom-scroll" multiple="" name="multi-b">
                        <option value="1">Alexandra</option>
                        <option value="2">Alice</option>
                        <option value="3">Anastasia</option>
                        <option value="4">Avelina</option>
                        <option value="5">Basilia</option>
                        <option value="6">Beatrice</option>
                        <option value="7">Cassandra</option>
                        <option value="8">Clemencia</option>
                        <option value="9">Desiderata</option>
                    </select>
                </label>
            </section>  
            <section class="col col-3">
                <label class="label">Multiple select</label>
                <label class="select select-multiple">
                    <select class="custom-scroll" multiple="">
                        <option value="1">Alexandra</option>
                        <option value="2">Alice</option>
                        <option value="3">Anastasia</option>
                        <option value="4">Avelina</option>
                        <option value="5">Basilia</option>
                        <option value="6">Beatrice</option>
                        <option value="7">Cassandra</option>
                        <option value="8">Clemencia</option>
                        <option value="9">Desiderata</option>
                    </select>
                </label>
            </section>  
            <section class="col col-3">
                <label class="label">Multiple select</label>
                <label class="select select-multiple">
                    <select class="custom-scroll" multiple="">
                        <option value="1">Alexandra</option>
                        <option value="2">Alice</option>
                        <option value="3">Anastasia</option>
                        <option value="4">Avelina</option>
                        <option value="5">Basilia</option>
                        <option value="6">Beatrice</option>
                        <option value="7">Cassandra</option>
                        <option value="8">Clemencia</option>
                        <option value="9">Desiderata</option>
                    </select>
                </label>
            </section>
          
        </div>
         <footer>
            <input type="hidden" name="submit-form">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-search"></i>
                Áp dụng tìm kiếm
            </button>
            <button class="btn btn-default" onclick="" type="button">
                <i class="fa fa-trash-o"></i>
                Xóa lựa chọn
            </button>
        </footer>
    </fieldset>
    
</form>

<script type="text/javascript">
    
</script>
