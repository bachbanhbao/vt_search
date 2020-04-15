<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
include_once("includes/vt-includes-js.php");
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget jarviswidget-sortable jarviswidget-color-blueLight" data-widget-editbutton="true" data-widget-colorbutton="true" data-widget-deletebutton="true" data-widget-togglebutton="true">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2><strong>Chọn Sản Phẩm Từ Category</strong></h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding" style="min-height: 500px">
						 <?php include('conditionProduct.php');?>			
					</div>
					<!-- end widget content -->
					<div class="img_loading">
						<img src="<?php echo ROOTHOST?>images/loading.gif" width="100" height="auto">	
					</div>
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->								

		</article>

	</div>

</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	$(document).ready(function(){
		$.post("<?php echo ROOTHOST;?>ajaxs/clearConditionSearch.php",{clear_all: true},function($rep){})
	})
	pageSetUp();
	var pagefunction = function() {
		var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

			$('#dt_basic').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"lengthMenu":[20,40,60,80,100],
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

		/* END BASIC */
	};
	
	// end pagefunction
	// Load form valisation dependency 
	
	loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
						loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/jquery-form/jquery-form.min.js", pagefunction)
					})
				});
			});
		});
	});
</script>
<style type="text/css">
	#dt_basic thead th {
		text-align: center;
	}
	.jarviswidget {
		border-left: 1px solid #ddd;
	}
	.smart-form .select-multiple select {
		height: 200px;
	}
	.img_loading {
		text-align: center;
		position: absolute;
	    left: 45%;
	    top: 15%;
	    display: none;
	}
</style>