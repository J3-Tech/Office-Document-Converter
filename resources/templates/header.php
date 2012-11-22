<?php global $title; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
		<meta charset="utf-8">
		<title>ODC | <?php echo $title ; ?></title>
		<meta name="description" content="">
		<link href="<?php echo ASSETS;?>/css/template.css" rel="stylesheet" media="all">
		<link rel="shortcut icon" href="../img/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo ASSETS;?>/img/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo ASSETS;?>/img/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo ASSETS;?>/img/apple-touch-icon-114x114.png">
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner"><div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></a>
					<a class="brand" href="<?php echo PUBLIC_ROOT;?>">Office Document Convertor</a>					
					<ul class="nav">
						<li><a href="<?php echo PUBLIC_ROOT;?>api.php">API</a></li>
						<li class="dropdown" id="charts-menu">
							<a href="#charts" class="dropdown-toggle" data-toggle="dropdown">WSDL <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a target="_blank" href="<?php echo PUBLIC_ROOT;?>service.php?wsdl"><i class="icon-list-alt"></i>&nbsp;View</a>
									<a href="<?php echo PUBLIC_ROOT;?>/service.wsdl"><i class="icon-download"></i>&nbsp;Download</a>
								</li>
							</ul>
						</li>
						<li><a href="<?php echo PUBLIC_ROOT;?>examples.php">Examples</a></li>
						<li><a href="<?php echo PUBLIC_ROOT;?>req.php">Requirements</a></li>
					</ul>
					
			</div>
		</div>
			<div class="go_to_top">
				<a href="#___" style="color: inherit">Back to top  <i class="icon-upload icon-white"></i></a>
			</div>
		</div>	
		<div id="" class="container">
		<noscript>
			<div class="alert alert-warning">Javascript is disabled; several features are only available if Javascript is enabled.</div>
		</noscript>		