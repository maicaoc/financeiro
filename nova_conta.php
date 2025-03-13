<?php


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();


require_once './DAO/contaDAO.php';

if (isset($_POST['btnsalvar'])){

$banco = $_POST['banco'];
$numero = $_POST['numero'];
$agencia = $_POST['agencia'];
$saldo = $_POST['saldo'];    

$objdao = new ContaDAO();
$ret = $objdao->CadastrarConta($banco, $agencia, $numero, $saldo);


}

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
<body>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                     <h2>Nova conta*</h2>   
                        <h5>Aqui você podera cadastrar todas as suas contas</h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <form action="nova_conta.php" method="post">
                 <div class="form-group">
                    <label>Nome do banco*</label>
                    <input class="form-control" placeholder="Digite o nome do banco" name="banco" id="banco" value="<?= isset($banco) ? $banco : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Agencia*</label>
                    <input type="number"  class="form-control" placeholder="Digite o telefone da agencia" name="agencia" id="agencia" value="<?= isset($agencia) ? $agencia : '' ?>" />
                </div>
                
                <div class="form-group">
                    <label>Numero da conta*</label>
                    <input type="number"  class="form-control" placeholder="Digite o numero da conta" name="numero" id="numero" value="<?= isset($numero) ? $numero : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Saldo*</label>
                    <input type="number"  class="form-control" placeholder="Digite o saldo da conta" name="saldo" id="saldo" value="<?= isset($saldo) ? $saldo : '' ?>" />
                </div>
                <button type="submit" class="btn btn-success" name="btnsalvar" onclick="return Validarconta();">Salvar</button>
                </form>
    </div> 
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
  
    
   
</body>
</html>
