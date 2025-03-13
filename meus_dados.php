<?php

require_once './DAO/UtilDAO.php';

UtilDAO::verificarlogado();

require_once './DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO();

if (isset($_POST['btnSalvar'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $ret = $objDAO->GravarMeusDados($nome, $email, $senha);
}

$dados_user = $objDAO->CarregarMeusDados();

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
                        <h2>Alterar Meus Dados.</h2>
                        <h5>Aqui você pode alterar seus dados de cadastro.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr>
                <form action="meus_dados.php" method="POST">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite seu Nome:</label>
                            <input class="form-control" placeholder="Digite seu Nome aqui..." name="nome" id="nome" value="<?= $dados_user['0']['nome_usuario'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite seu E-mail:</label>
                            <input type="email" class="form-control" placeholder="Digite seu E-mail aqui..." name="email" id="email" value="<?= $dados_user['0']['email_usuario'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Altere sua Senha:</label>
                            <input type="password" class="form-control" placeholder="Digite seu Senha aqui..." name="senha" id="senha" value="<?= $dados_user['0']['senha_usuario'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" name="btnSalvar" onclick="return ValidarMeusDados()">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>