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

	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Preço</td>
							<td class="quantity">Quantidade</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

						<?php
						    include_once('modelo/BDFuncoes.php');
							$bdFuncoes = new BDFuncoes();
							if (isset($_SESSION['logado']) AND $_SESSION['logado'] == "true") {
								$itensCarrinho = $bdFuncoes->getItensCarrinho($_SESSION['usuario']);

								$valorTotalCarrinho = 0;
								foreach ($itensCarrinho as $item) { 
									$valorTotalCarrinho = $valorTotalCarrinho + $item['preco'] * $item['qtd']; ?>

									<tr>
										<td class="cart_product">
											<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $item['image'] ).'"/>'; ?>
										</td>
										<td class="cart_description">
											<h4> <?php echo $item['nome'] ?> </h4>
											<p>Cód. <?php echo $item['id_item'] ?></p>
										</td>
										<td class="cart_price">
											<p>R$ <?php echo $item['preco'] ?></p>
										</td>
										<td class="cart_price">
											<p><?php echo $item['qtd'] ?></p>
										</td>
										<td class="cart_total">
											<p class="cart_total_price"> R$ <?php echo $item['preco'] * $item['qtd'] ?> </p>
										</td>
										<td class="cart_delete">
											<?php echo '<a lass="cart_quantity_delete" href="controlador/ControladorDeletarItemCarrinho.php?id=' . $item['id_item'] . '&usuario=' . $_SESSION['usuario'] . '" class="btn btn-default add-to-cart"><i class="fa fa-times"></i>'; ?>
										</td>
									</tr>
								<?php } 
							} else {
								echo "<script>
							    alert('Faça login para acessar o carrinho');
							    window.location.href = 'login.php';
							    </script>";
							}	

						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Carrinho Sub Total <span>R$ <?php echo $valorTotalCarrinho ?></span></li>
							<li>Transporte <span>R$ 5</span></li>
							<li>Total <span>R$ <?php echo $valorTotalCarrinho + 5 ?></span></li>
						</ul>
							<a class="btn btn-default update" href="Controlador/ControladorComprar.php">Comprar</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

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