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

        public function getProdutoUnidadeById($identidicador){
            try{
            $sql = "SELECT * FROM `produto_unidade` WHERE `id` = $identidicador";
            $query = $this->$conexao->query($sql);
            $query->execute();
            $ProdutoUnidade = $query->fetchAll();
            
            return $ProdutoUnidade[0];
            }catch(exception $e){
                return $e->getMessage();
            }
            
        }

        public function pesquisaProdutoUnidade($string){
            try{
                $sql = "SELECT * FROM produto_unidade WHERE sigla LIKE concat('%',:string,'%') OR descricao LIKE concat('%',:string,'%')";
                $consultaProdutoUnidade = $this->$conexao->prepare($sql);

                $consultaProdutoUnidade->bindParam(':string', $string, PDO::PARAM_STR);
                $consultaProdutoUnidade->execute();
                
                return $consultaProdutoUnidade->fetchAll();
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function cadastrarUnidade($data){

            $sql = "INSERT INTO produto_unidade (id, sigla, descricao) VALUES (:id, :sigla, :descricao)";

            $insert = $this->$conexao->prepare($sql);
            try{
                $insert->execute($data);
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function editarUnidade($data){

            $sql = "UPDATE produto_unidade SET sigla = :sigla, descricao = :descricao WHERE produto_unidade.id = :id";

            $update = $this->$conexao->prepare($sql);

            try{
                $update->execute($data);
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function deleteUnidade($identificador){
            
            try{
                $sql = 'DELETE FROM produto_unidade WHERE produto_unidade.id = :id';
                $deleteUnidade = $this->$conexao->prepare($sql);
                $deleteUnidade->bindParam(':id', $identificador, PDO::PARAM_INT );
                $deleteUnidade->execute();
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }
    }