<?php
    require "../Conn.php";
    class ProdutoDAO{
        private static $conexao;

        public function __construct(){
            $this->$conexao = Conn::getConexao();
        }
        public function Listar(){
            $sql = "SELECT * from produto order by id";
            $query = $this->$conexao->query($sql);
            $query->execute();
            $ProdutoUnidade = $query->fetchAll();
            return $ProdutoUnidade;
        }

        public function GetById($identidicador){
            try{
                $sql = "SELECT * FROM `produto` WHERE `id` = $identidicador";
                $query = $this->$conexao->query($sql);
                $query->execute();
                $ProdutoUnidade = $query->fetchAll();
                return $ProdutoUnidade[0];

            }catch(exception $e){
                return $e->getMessage();
            }
            
        }

        public function Pesquisar($string){
            try{
                $sql = "SELECT * FROM produto WHERE nome LIKE concat('%',:string,'%') OR descricao LIKE concat('%',:string,'%')";
                $consultaProdutoCategoria = $this->$conexao->prepare($sql);

                $consultaProdutoCategoria->bindParam(':string', $string, PDO::PARAM_STR);
                $consultaProdutoCategoria->execute();
                
                return $consultaProdutoCategoria->fetchAll();
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function Cadastrar($data){

            $sql = "INSERT INTO produto (id, nome, descricao) VALUES (:id, :nome, :descricao)";

            $insert = $this->$conexao->prepare($sql);
            $insert->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $insert->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
            $insert->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
            try{
                $insert->execute();
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function Editar($data){

            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao WHERE produto.id = :id";

            $update = $this->$conexao->prepare($sql);

            try{
                $update->execute($data);
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function deletar($identificador){
            
            try{
                $sql = 'DELETE FROM produto WHERE produto.id = :id';
                $categoria = $this->$conexao->prepare($sql);
                $categoria->bindParam(':id', $identificador, PDO::PARAM_INT );
                $categoria->execute();
                return true;
            }catch(exception $e){
                return $e->getMessage();
            }
        }

        public function GetCategoria($id = NULL){
            try{
                $sql = "SELECT categoria.id, categoria.nome from produto_categoria as categoria order by categoria.nome";
                $categoria = $this->$conexao->prepare($sql);
                $categoria->execute();
                return $categoria->fetchAll();
            }catch(exception $e){
                return $e.getMessage();
            }
        }
    }