<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao
{
    public function ValidarLogin($email, $senha)
    {
        if ($email == '' || $senha == '') {
            return 0;
        } else if (strlen($senha) < 6 || strlen($senha) > 8) {
            return -2;
        }


        $conexao = parent::retornarconexao();

        $comando_sql = 'SELECT id_usuario, nome_usuario FROM tb_usuario WHERE   email_usuario = ? AND  senha_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindvalue(1, $email);
        $sql->bindvalue(2, $senha);

        $sql->setfetchmode(PDO::FETCH_ASSOC);

        $sql->execute();

        $user = $sql->fetchAll();

        if (count($user) == 0) {
            return -5;
        } else {
            $cod = $user[0]['id_usuario'];
            $nome = $user[0]['nome_usuario'];

            UtilDAO::criarssesao($cod, $nome);

            header('location: inicio.php');
            exit;
        }
    }

    public function CriarCadastro($nome, $email, $senha, $repsenha)
    {
        if ($nome == '' || $email == '' || $senha == '' || $repsenha == '') {
            return 0;
        }else if(strlen($senha) < 6 || strlen($senha) > 8){
            return -2;
        }else if($senha != $repsenha){
            return -3;

        } else {
            // return 1;

            if($this->ValidarEmailDuplicadocadastrar($email) != 0){
                return -6;
            }

            $conexao = parent::retornarconexao();

            $comando_sql = "INSERT INTO tb_usuario (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                                VALUES (?, ?, ?, ?)";

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $email);
            $sql->bindValue(3, $senha);
            $sql->bindValue(4, date('Y-m-d'));

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ValidarEmailDuplicadoCadastrar($email)
    {
        if ($email == '') {
            return 0;
        } else {
            $conexao = parent::retornarconexao();

            $comando_sql = 'SELECT COUNT(email_usuario) AS contar  FROM tb_usuario WHERE   email_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindvalue(1, $email);
            // $sql->bindvalue(2, UtilDAO::UsuarioLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $contar = $sql->fetchAll();


            return $contar[0]['contar'];
        }
    }

    public function ValidarEmailDuplicadoAlterar($email)
    {
        if ($email == '') {

            return 0;
        } else {
            $conexao = parent::retornarconexao();

            $comando_sql = 'SELECT COUNT(email_usuario) AS contar  FROM tb_usuario WHERE   email_usuario = ? AND  id_usuario != ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindvalue(1, $email);
            $sql->bindvalue(2, UtilDAO::UsuarioLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $contar = $sql->fetchAll();


            return $contar[0]['contar'];
        }
    }



    public function CarregarMeusDados()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT nome_usuario, email_usuario, senha_usuario FROM tb_usuario WHERE id_usuario = ?;';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        // Esse comando realiza uma consulta via PDO no Banco de Dados e retorna um Array com os dados encontrados!
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email, $senha)
    {
        if ($nome == '' || $email == '' || $senha == '') {
            return 0;
        } else if (strlen($senha) < 6 || strlen($senha) > 8) {
            return -2;
        } else {
            //return 1;

            if($this->ValidarEmailDuplicadoAlterar($email) != 0){
                return -6;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'UPDATE tb_usuario SET nome_usuario = ?, email_usuario = ?, senha_usuario = ? WHERE id_usuario = ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $email);
            $sql->bindValue(3, $senha);
            $sql->bindValue(4, UtilDAO::UsuarioLogado());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }
}
