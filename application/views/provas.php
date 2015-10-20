
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Provas
                            <a href="#" class="pull-right btn btn-success"><i class="fa fa-file-o"></i> Nova Prova</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li>Provas</li>
                        </ol>
                    </div>
                </div>
               

                <div class="row">
                    
                    <div class="col-lg-12">
                     
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Início</th>
                                        <th>Fim</th>
                                        <th>Distância</th>
                                        <th style="width:1%; white-space: nowrap;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php foreach($provas as $prova): ?>
                                    <tr>
                                        <td><?php echo $prova->nome; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($prova->tempo_inicio)); ?></td>
                                        <td>29/10/2015 às 12h00</td>
                                        <td>10,6 Km</td>
                                        <td style="width:1%; white-space: nowrap;">
                                        	<a href="#" title="Editar" type="button" class="btn btn-xs btn-primary"><i class="fa fa-bullhorn"></i> Iniciar Prova</a>
                                        	<a href="#" title="Editar" type="button" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                        	<a href="#" title="Excluir" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
