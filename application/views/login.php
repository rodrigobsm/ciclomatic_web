<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Ciclomatic - Painel de Prova">
<meta name="author" content="UNIFEOB">
<link rel="shortcut icon" type="image/png" href="assets/favicon.png" />

<title>Ciclomatic - Entrar</title>

<!-- Bootstrap Core CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="assets/css/sb-admin.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="assets/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.assets/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<div id="">

		<!-- Page Heading -->
		<div class="row clear_row">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-centered">

				<form class="form-signin" action="<?php echo base_url(); ?>login/entrar" method="post" enctype="multipart/form-data">
					<img src="assets/logotipo_ciclomatic.png" class="logo_login">
					<p class="subtitle">Painel Administrativo Beta v.0.1</p>
					<label for="email" class="sr-only">Email</label> <input
						type="email" name="email" id="email" class="form-control" value="rodrigo.maria@unifeob.edu.br"
						placeholder="Email" required autofocus> <label for="senha"
						class="sr-only">Senha</label> <input type="password" id="senha" name="senha" value="q1w2e3r4"
						class="form-control" placeholder="Senha" required>
						
						<?php if (isset($_SESSION['msg'])): ?>
						<br>
						<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Erro:</strong> <?php echo $this->session->userdata('msg'); ?></div>
						<?php unset($_SESSION['msg']); endif; ?>
						
					<div class="checkbox">
						<a href="#">Esqueci a senha</a>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						<i class="fa fa-sign-in fa-1x"></i> Entrar
					</button>
					<p class="login-copy">UNIFEOB &copy; 2015 - Análise e
						Desenvolvimento de Sistemas.</p>
				</form>

			</div>
			<!-- /container -->

		</div>

	</div>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
