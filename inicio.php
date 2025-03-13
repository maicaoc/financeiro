<?php


require_once './DAO/UtilDAO.php';
UtilDAO::verificarlogado();

require_once './DAO/MovimentoDAO.php';

$objDAO = new MovimentoDAO();

$totalEntrada = $objDAO->TotalDeEntrada();
$totalSaida = $objDAO->TotalDeSaida();
$movs = $objDAO->UltimosDezMovimentos();

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
                        <h2>Sistema Intranet de Controle Financeiro.</h2>
                        <h5>Seja bem vindo(a) <strong><?= UtilDAO::nomelogado(); ?></strong>, todos os Módulos de trabalho você pode acessar no MENU lateral.</h5>
                    </div>
                </div>
                <hr>


                <div class="row">

                    <div class="col-md-6">

                        <div class="panel panel-primary text-center no-border bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?=number_format($totalEntrada[0]['Total'],2,',','.' ) ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Total de Entrada
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-border bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?=number_format($totalSaida[0]['Total'],2,',','.' ) ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Total de Entrada
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        resultado encontrado
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>

                                        <th class="alignbtn">ID</th>
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
    </div>
</body>

</html>