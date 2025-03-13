<?php


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();


require_once './DAO/UtilDAO.php';


    require_once './DAO/CategoriaDAO.php';

    $objDAO = new CategoriaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idCategoria = $_GET['cod'];

        $dados = $objDAO->DetalharCategoria($idCategoria);

        if(count($dados) == 0){
            header('location: consultar_categoria.php');
            exit;
        }
    }else if(isset($_POST['btnSalvar'])){
        $nome = trim($_POST['nome']);
        $idCategoria = $_POST['cod'];

        $ret = $objDAO->AlterarCategoria($nome, $idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    }else if(isset($_POST['btnExcluir'])){
        $idCategoria = $_POST['cod'];

        $ret = $objDAO->ExcluirCategoria($idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    }else{
        header('location: consultar_categoria.php');
        exit;
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once '_head.php'; ?>

<body>
    <div id="wrapper">
        <?php
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar ou Excluir Categoria Financeira.</h2>
                        <h5>Aqui você pode ALTERAR ou EXCLUIR sua Categoria Financeira.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr>
                <form action="alterar_categoria.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Digite o Nome da Categoria:</label>
                        <input class="form-control" placeholder="Digite o Nome da Categoria aqui..." name="nome" id="nome" value="<?= $dados[0]['nome_categoria'] ?>">
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCategoria();">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>

                    <div class="panel-body">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir a Categoria Financeira?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span>Nome da Categoria Financeira: </span><strong><?= $dados[0]['nome_categoria'] ?></strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                                        <button type="submit" class="btn btn-danger" name="btnExcluir">Sim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </form>
        </div>
    </div>
    </div>    
</div>
</body>
</html>