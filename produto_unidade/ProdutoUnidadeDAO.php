<?php
    require "../Conn.php";
    class ProdutoUnidadeDAO{
        private static $conexao;

        public function __construct(){
            $this->$conexao = Conn::getConexao();
        }
        public function ListarProdutoUnidade(){
            $sql = "SELECT * from produto_unidade order by id";
            $query = $this->$conexao->query($sql);
            $query->execute();
            $ProdutoUnidade = $query->fetchAll();
            return $ProdutoUnidade;
        }
    }