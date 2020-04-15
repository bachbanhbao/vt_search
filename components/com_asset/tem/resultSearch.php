
<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
include_once("includes/vt-includes-js.php");
$cur_page = 1;
$total_rows = 0;

if (!isset($_SESSION["CUR_PAGE_ACCOUNT"])) {
	$_SESSION["CUR_PAGE_ACCOUNT"]=1;
}
// get item by type
$blackList = ['base_url'];
if (isset($_GET['searchbytype']) && !isset($_POST['submit_form_fillter'])) {
	$urlType = str_replace("@", '/', $_GET['searchbytype']);
	$urlType = 'https://www.digikey.com/products/en/'.$urlType;

	$total_rows = getTotalItems(ROOTHOST_API_SEARCH, $urlType);
	// echo $total_rows;
	// Pagging
	if(isset($_POST["txtCurnpage"]))
	    $_SESSION["CUR_PAGE_ACCOUNT"]=$_POST["txtCurnpage"];

	if($_SESSION['CUR_PAGE_ACCOUNT'] > ceil($total_rows/MAX_ROWS)) {
	    $_SESSION['CUR_PAGE_ACCOUNT'] = ceil($total_rows/MAX_ROWS);
	}
	
	$cur_page = $_SESSION['CUR_PAGE_ACCOUNT'] > 0 ? $_SESSION['CUR_PAGE_ACCOUNT'] : 1;
	// echo $cur_page;
	// @params host, urltype, offset, limit
	$offset = $cur_page > 0 ? ($cur_page - 1) * MAX_ROWS : 1;
	$respSearch = getItemsByType(ROOTHOST_API_SEARCH , $urlType, $offset, MAX_ROWS);
	$respSearch = json_decode($respSearch);

	if ($respSearch) {
		$dataHead = $respSearch[0];	
	} else {
		$dataHead = array();
	}
}
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
						<!-- Include form search item -->
						<?php include('search.php');?>
						<!-- The end include form search item -->

						<!-- Generate data to table -->
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="2%">No.</th>
									<?php
									if ($respSearch != null) {
										foreach ($dataHead as $key => $value) {
											echo "<th>".$key."</th>";
										}
									}	
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								$stt= ($cur_page-1) * MAX_ROWS + 1;

								if ($respSearch != null) {
									foreach ($respSearch as $key => $value) { ?>
										<tr>
											<td><?php echo $stt;?></td>
											<?php foreach ($value as $k => $val) { ?>
											<td style="<?php if ($k == 'Datasheets') echo 'text-align: center'?>">
												<?php 
													if (!is_object($val) && !in_array($k, $blackList)) echo $val;
													else {
														if (isset($val->name)) {
															echo str_replace('"', '', $val->name);
														} else if (isset($val->phone)) {
															echo 'Phone: '.$val->phone;
															if (isset($val->desktop)) {
																echo '<br/>Desktop: '.$val->desktop;
															}

														} else if (isset($val->desktop))  {
															echo $val->desktop;

														} else {
															if ($k == 'Image') {
																$dataImg = "data:image/png;base64,".$val->based64;
																echo "<img src=".$dataImg." title=".$val->title." />";
															} else if ($k == 'Datasheets') {
																echo "<a onclick=\"\"><img class=\"datasheet-img\" src=\"images/pdf.png\" alt=\"Datasheets\" title=\"Datasheets\"></a>";
															} else {
																echo "None";
															}
														}
													}
												?>
											</td>
										<?php } $stt++; ?>
										</tr>
								<?php }}?>
							</tbody>
						</table>
						<!-- The end -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
							<tr>
								<td align="center"><?php paging($total_rows, MAX_ROWS, $cur_page);?></td>
							</tr>
						</table>
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
	$(document).ready(function() {
		// $("body").addClass("minified");
		$(".img_loading").css({'display':'block'});
		$(window).on('load', function(){
			$(".img_loading").css({'display':'none'});
		})

		$("#btn-search").click(function(){
			$(".img_loading").css({'display':'block'});		
		})

		$(".cbo_search_item").change(function(){
			var gr_condition = $(this).attr('gr_condition');
			$("#clear-"+gr_condition).css({'display':'block'});
		})
	})

	function clearConditionSearch() {
		var pageURL = $(location).attr("href");
		$.post("<?php echo ROOTHOST;?>ajaxs/clearConditionSearch.php",{clear_all: true},function($rep){
            smartInfoMsg('Thông báo', 'Xóa tất cả điều kiện thành công!', 3000);
            setTimeout(function(){
            	window.location = pageURL;
            }, 1500);
        })
	}

	function clearItemSelected(groupCondition) {
		$("#condition-"+groupCondition).val([]);
		$("#clear-"+groupCondition).css({'display':'none'});
		smartInfoMsg('Thông báo', 'Xóa thành công!', 3000);
	}

	function submitForm() {
		$("#form-search").submit();
	}

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
				"lengthMenu":[25, 50, 100, 150, 250, 500],
				"paging": false,
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
	#dt_basic_wrapper {
		overflow-x: scroll;
	}
	.img_loading {
		text-align: center;
		position: absolute;
	    left: 45%;
	    top: 10%;
	    display: none;
	}
	.morecontent span {
	    display: none;
	}
	.morelink {
	    display: block;
	}
	.mrc-controls {
		padding: 0 15px;
	}
	.clear-all-item-selected {
		padding: 10px 0 3px;
		display: none;
		cursor: pointer;
	}
	.mrc-content-wrap {
		padding: 0 15px;
	}
	.lst-condition-selected {
		list-style: none;
		margin: 0;
		padding: 12px;
	}
	.lst-condition-selected li {
		float: left;
		padding: 3px 6px;
		border: 1px solid #00918d;
		margin: 3px;
	}
	.count-result-search {
		clear: both;
		padding: 15px 15px 0;
		font-size: 20px;
	}
	.txt_search_within {
		height: 26px;
		width: 450px;
	}
	.btn-search-within {
		height: 26px;
		width: 120px;
		font-weight: bold;
	}
	.smart-form footer .btn {
		/* float: left; */
	}
	.paging {
		padding: 20px 0;
	}
	.paging a {
		padding: 5px 8px;
		border: 1px solid #ccc;
		margin: 3px;
	}
	.cur_page {
		background: #3276b1;
		color: #fff;
		border: none !important;
		font-size: 16px;
		font-weight: bold;
	}
</style>