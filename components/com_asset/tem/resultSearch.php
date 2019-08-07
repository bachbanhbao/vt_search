
<?php
include_once("includes/vt-includes-js.php");
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" data-widget-editbutton="true" data-widget-colorbutton="true" data-widget-deletebutton="true" data-widget-togglebutton="true">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2><strong>DANH SÁCH LINH KIỆN</strong></h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<?php include('search.php');?>
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="2%">No.</th>
									<th width="10%">
										Hình ảnh
									</th>
									<th width="10%">
										Mã linh kiện
									</th>
									<th width="10%">
										Mã nhà SX
									</th>
									<th width="10%">
										Nhà sản xuất
									</th>
									<th width="10%">
										Mô tả
									</th>
									<th width="6%">
										Giá
									</th>
									<th width="6%">
										Series
									</th>
									<th width="6%">
										Part Status
									</th>
									<th width="6%">
										Loại
									</th>
									<th width="6%">
										Function
									</th>
									<th width="6%">
										Embedded
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$stt=1;
								for ($i=0; $i < 100; $i++) { ?>
									<tr>
										<td align="center"><?php echo $stt;?></td>
										<td align="center">
											<img src="assets/images/img.jpg" width="32" height="32">
										</td>
										<td align="center">UDP-<?php echo $stt;?></td>
										<td align="center">NSX-<?php echo $stt;?></td>
										<td align="center">Ericson</td>
										<td align="center">Mô tả</td>
										<td align="center">$100</td>
										<td align="center">Series</td>
										<td align="center"><?php echo $stt;?></td>
										<td align="center"><?php echo $stt;?></td>
										<td align="center"><?php echo $stt;?></td>
										<td align="center"><?php echo $stt;?></td>
										
									</tr>
								<?php $stt++;}
								?>
							</tbody>
						</table>
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->								

		</article>

	</div>

</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">	
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
</style>