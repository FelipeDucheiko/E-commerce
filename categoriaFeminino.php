<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">     
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<?php session_start(); ?>

<body>
	<header>	
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
						
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<?php include_once('controlador/ControladorVerificarLogin.php');?> 
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li><a href="carrinho.php">Carrinho</a></li>
								<li><a href="login.php">Cadastro</a></li>
							</ul>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Categoria</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="categoriaMasculino.php">Homens</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="categoriaFeminino.php">Mulheres</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="categoriaInfantil.php">Crianças</a></h4>
								</div>
							</div>
						</div><!--/category-productsr-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">MULHER</h2>

						<?php
						    include_once('modelo/BDFuncoes.php');
							$bdFuncoes = new BDFuncoes();
							$itens = $bdFuncoes->getTodosCategoria('item', 'Feminino');

						    foreach ($itens as $item) { ?>
							    <div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<?php
												echo '<img src="data:image/jpeg;base64,'.base64_encode( $item['image'] ).'"/>';
												echo '<h2>R$ '. $item['preco'] . '</h2>';
												echo '<p>' . $item['nome'] . '</p>';
												echo '<p>Qtd.</p>';
												
												if (isset($_SESSION['logado']) AND $_SESSION['logado'] == "true"){
													echo '<button type="submit" class="btn btn-default">Adicionar ao Carrinho</button>';
												} else {
													echo '<a href="login.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>';
												}
											?>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<form action="controlador/ControladorAdicionarItemCarrinho.php" method="get">
												<?php
													echo '<h2>R$ '. $item['preco'] . '</h2>';
													echo '<p>' . $item['nome'] . '</p>';
													echo '<div><input style="width: 40px; margin: 1px 1px 5px 1px;" type="number" name="qtd" value="1" min="0" size="2"></div>';				
													if (isset($_SESSION['logado']) AND $_SESSION['logado'] == "true"){
														echo '<input type="hidden" name="id" value="' . $item['id'] .'">';
														echo '<input type="hidden" name="usuario" value="' . $_SESSION['usuario'] .'">';
														echo '<button type="submit" class="btn btn-default">Adicionar ao Carrinho</button>';
													} else {
														echo '<a href="login.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>';
													}
												?>
												</form>
											</div>
										</div>
									</div>
								</div>
								</div>

						  <?php } ?>
						
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>Ponta Grossa - PR, Brasil</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2018 E-Shopper. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>