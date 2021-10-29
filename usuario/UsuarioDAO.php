<?php
    require ".././Conn.php";
    
    class UsuarioDAO {
        private static $conexao;
        public function __construct(){
            $this->$conexao = Conn::getConexao();
        }
        public function listarUsuarios(){
            $query = $this->$conexao->query("SELECT * from usuarios");
            $query->execute();
            $usuarios = $query->fetchAll();
            return $usuarios;
        }

        public function getUsuarioById($identidicador){
            
            $sql = "SELECT * from usuarios WHERE id = $identidicador";
            $query = $this->$conexao->query($sql);
            $query->execute();
            $usuario = $query->fetchAll();
            // echo"<pre>";
            // var_dump($usuario[0]);
            // die();
            return $usuario[0];
            
        }

        public function cadastrarUsuario($data){
            
            $sql = "INSERT INTO usuarios (id, nome, idade) VALUES (:id, :nome, :idade)";
                       
            $insert= $this->$conexao->prepare($sql);
            try{
                $insert->execute($data);
                return 'Usuário inserido com sucesso';
            }catch(exception $e){
                return "Exceção capturada: ".  $e->getMessage(). "\n";
            }
        }

        public function editarUsuario($data){
            try {
                $sql = "UPDATE usuarios SET nome = ?, idade = ? where id = ?";
        
                $usuarioUpdate = $this->$conexao->prepare($sql);
        
                $usuarioUpdate->bindParam(1, $data['nome']);
                $usuarioUpdate->bindParam(2, $data['idade']);
                $usuarioUpdate->bindParam(3, $data['id']);
                
        
                $usuarioUpdate->execute();
                $message = 'Usuário '.$data["nome"].' foi alterado com sucesso';
                return $message;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }

        public function deleteUsuario($data){
            try {
                $sql = "DELETE FROM `usuarios` WHERE id = ?";
        
                $usuarioUpdate = $this->$conexao->prepare($sql);
        
                $usuarioUpdate->bindParam(1, $data['id']);
                
        
                $usuarioUpdate->execute();
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
        public function pesquisaUsuario(string $pesquisa){
            
            try {
                
                $sql = "SELECT * FROM `usuarios` WHERE `nome` LIKE concat('%', ?, '%') OR `idade` LIKE concat('%', ?, '%') OR `id` LIKE concat('%', ?, '%')";
        
                $query = $this->$conexao->prepare($sql);
                $query->bindParam(1, $pesquisa);
                $query->bindParam(2, $pesquisa);
                $query->bindParam(3, $pesquisa);
                
        
                $query->execute();
                $usuarios = $query->fetchAll();
                return $usuarios;
                
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
    }
    
?>