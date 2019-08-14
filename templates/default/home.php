<!DOCTYPE html>
<html lang="en-us">	
	<head>
		<meta name="google" content="notranslate" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Tìm Kiếm Linh Kiện</title>
		<?php 
			include_once("includes/vt-includes-css.php");
		?>
	</head>
	<body>
		<!-- include_once("components/com_members/tem/login.php"); -->
		<header id="header">
			<div id="logo-group">
				<span id="logo"> 
				<a href="dashboard"><img data-hide="phone" src="<?php echo ROOTHOST ?>assets/images/logo.png" alt="Logo"></a>
				</span>
			</div>
			<!-- #TOGGLE LAYOUT BUTTONS -->
			<!-- pulled right: nav area -->
			<div class="pull-right">
				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->
		<aside id="left-panel">
			<nav>
				<?php include('components/com_common/menu.php')?>
			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
		</aside>
		<!-- #MAIN PANEL -->
		<div id="main" role="main">
			<!-- #MAIN CONTENT -->
			<div id="content">
				<?php 
					$this->loadComponent();
				?>
			</div>
			
			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->
	</body>
</html>
