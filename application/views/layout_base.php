<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ciclomatic - Painel Administrativo">
    <meta name="author" content="UNIFEOB">
    <base href="<?php echo base_url(); ?>"/>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png"/>

    <title>Ciclomatic - Painel de Prova</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.assets/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="assets/logo_white.png" class="logo_top"> CICLOMATIC beta v0.1</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrador <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Meus Dados</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>login/sair"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="home"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="ciclistas"><i class="fa fa-fw fa-bicycle"></i> Ciclistas</a>
                    </li>
                    <li>
                        <a href="provas"><i class="fa fa-fw fa-bullhorn"></i> Provas</a>
                    </li>
                    <li>
                        <a href="inscricoes"><i class="fa fa-fw fa-edit"></i> Inscrições</a>
                    </li>
                    <li>
                        <a href="mensagens"><i class="fa fa-fw fa-file-text-o"></i> Mensagens</a>
                    </li>
                    <li>
                        <a href="dados"><i class="fa fa-fw fa-database"></i> Dados</a>
                    </li>
                    <li>
                        <a href="checkpoints"><i class="fa fa-fw fa-thumb-tack"></i> Checkpoints</a>
                    </li>
                    <li style="width: 100%;"><p class="copyrights">&reg; UNIFEOB &copy; ADS 2015</p></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

			<?php echo $conteudo; ?>
     
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/morris/morris-data.js"></script>

</body>

</html>