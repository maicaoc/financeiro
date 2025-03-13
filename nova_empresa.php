<?php


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();



 require_once './DAO/EmpresaDAO.php';

 if(isset($_POST['btngravar'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

$objDAO = new EmpresaDAO();

$ret = $objDAO->CadastrarEmpresa($nome, $telefone, $endereco);

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
                     <h2>Nova Empresa</h2>   
                        <h5>Aqui você podera cadastrar todas as suas Empresas</h5>
                        <?php include_once '_msg.php'?>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <form ction="nova_empresa.php" method="post">
                 <div class="form-group">
                    <label>Nome da empresa</label>
                    <input class="form-control" placeholder="Digite o nome da empresa" name="nome" id="nome" value="<?= isset($nome) ? $nome : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="number" class="form-control" placeholder="Digite o telefone da empresa" name="telefone" id="telefone" value="<?= isset($telefone) ? $telefone : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" placeholder="Digite o endereço da empresa" name="endereco" id="endereco" value="<?= isset($endereco) ? $endereco : '' ?>" />
                </div>
                <button class="btn btn-success" name="btngravar" onclick="return ValidarEmpresa();">salvar</button>
                </form>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
  
    
   
</body>
</html>
