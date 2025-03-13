<?php

// Essa Classe tera a finalidade de criar a Sessão d Log do Usuário!

class UtilDAO
{
    private static function iniciarsessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

   
    
        public static function criarssesao($cod, $nome)
        {
            self::iniciarsessao();
            $_SESSION['cod'] = $cod;
            $_SESSION['nome'] = $nome;
        }
    
        public static function nomelogado()
        {
            self::iniciarsessao();
            return $_SESSION['nome'];
        }
    
        public static function UsuarioLogado()
        {
            self::iniciarsessao();
            return $_SESSION['cod'];
        }
    
        public static function deslogar()
        {
            self::iniciarsessao();
            unset($_SESSION['cod']);
            unset($_SESSION['nome']);
            session_destroy();
            header('location: index.php');
            exit;
        }
    
        public static function verificarlogado()
        {
            self::iniciarsessao();
            if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
                header('location: index.php');
                exit;
            }
        }
    }