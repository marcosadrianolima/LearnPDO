<?php
    class Conn {

        private static $instance;
        private $hostname = "127.0.0.1";
        private $dbname = "crud";
        private $username = "root";
        private $password = "";

        private function __construct() {
            //
        }

        private static function Conexao(){
            
            try{
                self::$instance = new PDO('mysql:host=127.0.0.1;port=3306;dbname=crud','root','');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'connect success';
            }catch (Exception $e){
                echo 'ERROR:'.$e->getMessage();
            }
        }
        public static function getConexao(){
            
            if(!self::$instance){
                self::Conexao();
            }
            return self::$instance;
        }

    }

?>