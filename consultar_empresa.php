<?php 


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();



require_once './DAO/EmpresaDAO.php';

$objDAO = new EmpresaDAO();
$empresas = $objDAO->ConsultarEmpresa();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
 
include_once '_head.php';
?>
<body>
<div id="wrapper">

<?php
include_once '_topo.php';
include_once '_menu.php';
?>
         
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Consultar empresa</h2>   
                        <h5>Consute suas empresas aqui </h5>
                       <? include_once '_msg.php';?>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span> Empresas cadastradas, caso deseja alterar, clique no botão </span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da empresa</th>
                                            <th>Telefone</th>
                                            <th>Endereço</th>
                                            <th>Ação</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($empresas as $emp){ ?>

                                        <tr>

                                            <td><?=$emp['nome_empresa']?></td>
                                            <td><?=$emp['telefone_empresa']?></td>
                                            <td><?=$emp['endereco_empresa']?></td>
                                            <td><a href="alterar_empresa.php?cod=<?= $emp['id_empresa'] ?>" class="btn btn-warning">Alterar</a></td>
                                            
                                        </tr>

                                        <?php } ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
    </div>
</div>
           
    
   
</body>
</html>
