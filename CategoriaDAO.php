<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class CategoriaDAO extends Conexao{
        public function CadastrarCategoria($nomeCategoria){
            if ($nomeCategoria == '') {
                return 0;
            } else {
                //  return 1;

                // 1 passo: criar uma variavel para receber 
                $conexao = parent::retornarConexao();

                // 2 passo: vamos criar o script que sera executado no banco de dados pelo PDD mos criar o script
                $comando_sql = 'INSERT INTO tb_categoria (nome_categoria, id_usuario) VALUES(?, ?);';

                // 3 passo: criar um objeto com os recursos do PDO
                // PDO: Função Nativa do PHP para gerir ações no banco de dados
                $sql = new PDOStatement();

                // 4 passo: vamos adicionar um processo de Objeto sql para preparar a execuçao do script sql do banco de dados !
                $sql = $conexao->prepare($comando_sql);

                // 5 passo: vamos identificar e validar o que esta sendo passado para o Banco de Dados
                $sql->bindValue(1, $nomeCategoria);
                $sql->bindValue(2, UtilDAO::UsuarioLogado());

                //  6 passo : vamos tentar executar o codigo dezenvolvido
                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) { 
                    echo $ex->getMessage();
                    return -1;
                }
            }
        }

        public function ConsultarCategoria(){
            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_categoria, nome_categoria FROM tb_categoria WHERE id_usuario = ? ORDER BY nome_categoria ASC;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::UsuarioLogado());

            //realize a consulta no banco de dados via PDO, monta e retorna um array com tudo que foi encontrado!
            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchall();
        }

        public function DetalharCategoria($idcategoria){
            if ($idcategoria == '') {
                return 0;
            } else {
                $conexao =  parent::retornarConexao();

                $comando_sql = 'SELECT id_categoria, nome_categoria FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?;';

                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $i = 1;

                $sql->bindValue($i++, $idcategoria);
                $sql->bindValue($i++, UtilDAO::UsuarioLogado());

                $sql->setfetchmode(PDO::FETCH_ASSOC);

                $sql->execute();

                return $sql->fetchAll();
            }
        }

        public function AlterarCategoria($nomecategoria, $idcategoria){
            if ($nomecategoria == '' || $idcategoria == '') {
                return 0;
            } else {
                // return 1;

                $conexao = parent::retornarConexao();

                $comando_sql = 'UPDATE tb_categoria SET nome_categoria = ? WHERE id_categoria = ? AND id_usuario = ?;';

                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $i = 1;

                $sql->bindValue($i++, $nomecategoria);
                $sql->bindValue($i++, $idcategoria);
                $sql->bindValue($i++, UtilDAO::UsuarioLogado());

                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
            }
        }

        public function ExcluirCategoria($idcategoria){
            if ($idcategoria == '') {
                return 0;
            }else{
                $conexao = parent::retornarConexao();

                $comando_sql = 'DELETE FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?;';

                $sql = new PDOStatement();

                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $idcategoria);
                $sql->bindValue(2, UtilDAO::UsuarioLogado());

                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -4;
                }
            }
        }
    }