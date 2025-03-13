<?php

require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();

require_once './DAO/MovimentoDAO.php';

$tipoMov = '';

$dtInicio = '';

$dtFinal = '';


if (isset($_POST['btnPesquisar'])) {
    $tipoMov = $_POST['tipoMov'];
    $dtInicio = $_POST['dtInicio'];
    $dtFinal = $_POST['dtFinal'];

    $objDAO = new MovimentoDAO();
    $movs = $objDAO->ConsultarMovimento($tipoMov, $dtInicio, $dtFinal);
} else if (isset($_POST['btnExcluir'])) {
    $idmov = $_POST['idMov'];
    $idconta = $_POST['idconta'];
    $tipomov = $_POST['tipomov'];
    $valor = $_POST['valor'];

    $objDAO = new MovimentoDAO();
    $ret = $objDAO->Excluirmovimento($idmov, $idconta, $tipomov, $valor);
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

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include '_msg.php' ?>
                        <h2>Consultar movimento</h2>
                        <h5>Consulte todos os movimentos em um determinado periodo</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="consultar_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>tipo do movimento</label>
                            <select class="form-control" placeholder="Selecione o tipo do movimento" name="tipoMov">

                                <option value="0" <?= $tipoMov == "0" ? "selected" : "" ?>>TODOS</option>
                                <option value="1" <?= $tipoMov == "1" ? "selected" : "" ?>>Entrada</option>
                                <option value="2" <?= $tipoMov == "2" ? "selected" : "" ?>>Saida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label>data inicial*</label>
                            <input type="date" class="form-control" placeholder="Digite o telefone da empresa " name="dtInicio" id="datainicial" value="<?= isset($dtInicio) ? $dtInicio : '' ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label>data final*</label>
                            <input type="date" class="form-control" placeholder="Digite o telefone da empresa " name="dtFinal"  id="datafinal"value="<?= isset($dtFinal) ? $dtFinal : '' ?>" />
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-info" name="btnPesquisar" onclick="return ConsultarMovimento();">pesquisar</button>
                    </center>
                </form>

                <?php if (isset($movs)) { ?>

                    <hr>



                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    resultado encontrado
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>

                                                    <th class="alignbtn">Tipo</th>
                                                    <th class="alignbtn">Data</th>
                                                    <th class="alignbtn">Valor</th>
                                                    <th class="alignbtn">Categoria</th>
                                                    <th class="alignbtn">Empresa</th>
                                                    <th class="alignbtn">Conta</th>
                                                    <th class="alignbtn">Observação</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $total = 0;

                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }


                                                ?>


                                                    <tr>
                                                        
                                                        <td class="alignBtn"> <?= $movs[$i]['tipo_movimento'] == 1 ? '<strong style="color:#006400;">entrada</strong>' : '<strong style="color:#ff0000;">saida</strong>' ?>
                                                        </td>
                                                        <td class="alignBtn"><?= $movs[$i]['data_movimento'] ?></td>
                                                        <td class="alignBtn">R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                        <td class="alignBtn"><?= $movs[$i]['nome_categoria'] ?></td>
                                                        <td class="alignBtn"><?= $movs[$i]['nome_empresa'] ?></td>
                                                        <td class="alignBtn">
                                                            <?= $movs[$i]['banco_conta'] ?> | Agência: <?= $movs[$i]['agencia_conta'] ?> | N. Conta: <?= $movs[$i]['numero_conta'] ?>
                                                        </td>
                                                        <td><?= $movs[$i]['obs_movimento'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $i ?>">Excluir</a>
                                                            <form action="consultar_movimento.php" method="post">
                                                                <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                                <input type="hidden" name="idconta" value="<?= $movs[$i]['id_conta'] ?>">
                                                                <input type="hidden" name="tipomov" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                                <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">
                                                                <!-- Inicio da modal -->
                                                                <div class="modal fade" id="myModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir a Conta Bancária?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                deseja excluir o movimento:
                                                                                <span class="alignBtn"> <?= $movs[$i]['tipo_movimento'] == 1 ? '<strong style="color:#006400;">entrada</strong>' : '<strong style="color:#ff0000;">saida</strong>' ?> </strong></span>
                                                                                <br>
                                                                                <span>data: </span><strong><?= $movs[$i]['data_movimento'] ?></strong>
                                                                                <br>
                                                                                <span>valor do movimento: </span><strong><?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></strong>
                                                                                <br>
                                                                                <span>nome da categoria: </span><strong><?= $movs[$i]['nome_categoria'] ?></strong>
                                                                                <br>
                                                                                <span>nome da empresa: </span><strong><?= $movs[$i]['nome_empresa'] ?></strong>
                                                                                <br>
                                                                                <span>conta bancaria: </span><strong><?= $movs[$i]['banco_conta'] ?> | Agência: <?= $movs[$i]['agencia_conta'] ?> | N. Conta: <?= $movs[$i]['numero_conta'] ?>
                                                                                </strong>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                                                                                <button type="submit" class="btn btn-danger" name="btnExcluir">Sim</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div style="text-align: center;">
                                            <strong>Total: </strong>
                                            <span style="color: <?= $total < 0 ? '#ff0000' : '#006400'; ?>">
                                                <strong>R$ <?= number_format($total, 2, ',', '.'); ?></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

</body>

</html>