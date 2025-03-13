<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class ContaDAO extends Conexao{
        public function CadastrarConta($banco, $agencia, $numero, $saldo){
            if ($banco == '' || $agencia == '' || $numero == '' || $saldo == '') {
                return 0;
            } else {
                //return 1;

                $conexao = parent::retornarConexao();

                $comando_sql = 'INSERT INTO tb_conta(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) 
                VALUES(?, ?, ?, ?, ?);';


                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $banco);
                $sql->bindValue(2, $agencia);
                $sql->bindValue(3, $numero);
                $sql->bindValue(4, $saldo);
                $sql->bindValue(5, UtilDAO::UsuarioLogado());

                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
            }
        }
        

        public function ConsultarConta(){
            $conexao =  parent::retornarConexao();

            $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta FROM tb_conta WHERE id_usuario = ? ORDER BY banco_conta ASC;';


            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::UsuarioLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }



    

        public function Detalharconta($idconta){
            if ($idconta == '') {
                return 0;
            } else {

                $conexao = parent::retornarConexao();

                $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta FROM tb_conta WHERE id_conta = ? AND id_usuario = ?;';


                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $sql->bindvalue(1, $idconta);
                $sql->bindvalue(2, UtilDAO::UsuarioLogado());

                $sql->setFetchMode(PDO::FETCH_ASSOC);

                $sql->execute();

                return $sql->fetchAll();
            }
        }

        public function AlterarConta($banco, $agencia, $numero, $saldo, $idconta){
            if ($banco == '' || $agencia == '' || $numero == '' || $saldo == '' || $idconta == '') {
                return 0;
            } else {
                //return 1;

                $conexao = parent::retornarConexao();

                $comando_sql = 'UPDATE tb_conta SET banco_conta = ?, agencia_conta = ?, numero_conta = ?, saldo_conta = ? WHERE id_conta = ? AND id_usuario = ?;';


                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $i = 1;

                $sql->bindValue($i++, $banco);
                $sql->bindValue($i++, $agencia);
                $sql->bindValue($i++, $numero);
                $sql->bindValue($i++, $saldo);
                $sql->bindValue($i++, $idconta);
                $sql->bindValue($i++, UtilDAO::UsuarioLogado());

                try {
                    $sql->execute();
                    return 1;
                } catch (PDOException $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
            }
        }

        public function excluirconta($idconta){
            if ($idconta == '') {
                return 0;
            } else {
                $conexao = parent::retornarConexao();

                $comando_sql = 'DELETE FROM tb_conta WHERE id_conta = ? AND  id_usuario = ?';

                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $idconta);
                $sql->bindValue(2, UtilDAO::UsuarioLogado());

                try {
                    $sql->execute();
                    return 1;
                } catch (exception $ex) {
                    echo $ex->getMessage();
                    return -4;
                }
            }
        }
    }