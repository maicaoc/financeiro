<?php

require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();




require_once './DAO/CategoriaDAO.php';

if (isset($_POST['btngravar'])) {
    $nome = trim($_POST['nome']);

    $objDAO = new CategoriaDAO();
    $ret = $objDAO->CadastrarCategoria($nome);
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
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Nova Categoria</h2>
                            <h5>Aqui você podera cadastrar todas as suas categorias</h5>
                            <?php include_once '_msg.php' ?>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form action="nova_categoria.php" method="post">
                        <div class="form-group">
                            <label>Nome da categoria</label>
                            <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: conta de luz" name="nome" id="nome" value="<?= isset($nome) ? $nome : '' ?>" />
                        </div>
                        <button type="submit" class="btn btn-success" onclick="return ValidarCategoria()" name="btngravar">gravar</button>
                    </form>
                </div>
            </div>
    </div>
    </div>
</body>

</html>