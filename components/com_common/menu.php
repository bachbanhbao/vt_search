<?php
if (!isset($_SESSION['CAT'])) {
	$_SESSION['CAT'] = getCategoryFilter(ROOTHOST_API_SEARCH);
	$_SESSION['CAT'] = json_decode($_SESSION['CAT']);	
}
?>
<ul>
	<?php
	for ($i=0; $i < count($_SESSION['CAT']); $i++) { 
		$index = $i;
		?>
		<li class="<?php if((isset($_GET['cat']) && $_GET['cat'] == $index) || (!isset($_GET['cat']) && $i==0)) echo 'active';?>">	
			<a href="<?php echo ROOTHOST?>category-<?php echo $index;?>" aria-expanded="false" >
				<i class="fa fa-lg fa-fw fa-folder-o"></i>
				<span class="menu-item-parent"><?php echo $_SESSION['CAT'][$i]->name?></span>
			</a>
		</li>
	<?php }
	?>	
</ul>
<script type="text/javascript">
	setTimeout(function(){
		$.post("<?php echo ROOTHOST;?>ajaxs/unsetSession.php",{session: true},function($rep){})
	}, 1000*60*60)
</script>
<style type="text/css">
	#header {
		/*position: fixed;
		width: 100%;*/
	}
	#left-panel {
		background: #00918d;
		/*background: linear-gradient( 145deg, #4772d9, #5be0e0 );*/
	}

	nav ul li a {
		padding: 15px 5px 10px 10px;
		text-transform: uppercase;
	}
	nav ul ul li>a {
		padding-top: 10px !important;
		padding-bottom: 10px !important;
	}
	nav ul li a,
	nav ul ul li>a {
		color: #fff;

	}
	.login-info a {
		color: #fff;
	}
	.login-info {
		border-bottom: 1px solid #ccc;
		border-right: 1px dotted #fff;
	}
	#ribbon,
	.page-footer {
		background: #00918d;
	}
	.minifyme {
		background: #fff;
		border-bottom: none;
	}
	nav ul li.active {
	    background: #FF9900;
	}
	nav ul li.active a {
		color: #fff !important;
	}
	.minified nav>ul>li {
		border-bottom: 1px solid #ccc;
	}
	nav>ul>li>a b {
		top: 13px;
	}
</style>