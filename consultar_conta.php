<?php


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();

   require_once './DAO/ContaDAO.php';

   $objDAO = new ContaDAO();

   $contas = $objDAO->ConsultarConta();


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
include_once '_head.php';
?>
<body>
<?php
include_once '_topo.php';
include_once '_menu.php';
?>
			            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Consultar contas</h2>   
                        <h5>Consulte suas contas aqui </h5>
                        <?php include_once '_msg.php'; ?>                      
                    </div>
                </div>
            
                 <hr />
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             contas cadastradas, caso deseja alterar, clique no botão
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agencia</th>
                                            <th>Numero da conta</th>
                                            <th>Saldo</th>
                                            <th>Ação</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($contas as $ctn) { ?>
                                        <tr>
                                            <td><?= $ctn['banco_conta']?></td>
                                            <td><?= $ctn['agencia_conta']?></td>
                                            <td><?= $ctn['numero_conta']?></td>
                                            <td><?= number_format($ctn['saldo_conta'] , 2 , ',', '.') ?></td>
                                            
                                             <td><a href="alterar_conta.php?cod=<?=$ctn['id_conta'] ?>" class="btn btn-warning btn-sm">alterar</a></td>
                                            
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
      
   </form>
    
   
</body>
</html>
