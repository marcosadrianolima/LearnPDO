<?php
require "./UsuarioDAO.php";
require "./Usuario.php";
error_reporting(0);
        $title = "Cadastro Usuário";
        $NomePagina = "Cadastro usuário";
        $message = "";

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $identificador = $_GET['id'];
            $usuario = new UsuarioDAO();
            $usuarioEdit = $usuario->getUsuarioById($identificador);
            $title = "Edição Usuário";
            $NomePagina = "Usuário ".$usuarioEdit["nome"];
        }   
        
        
        if($_GET['message']){
            $message = $_GET['message'];
        }
        if($_POST){
            if(isset($_POST["id"])){
                
                $usuario = new UsuarioDAO();
                $data = [
                    'id' => $_POST['id'], 
                    'nome' => $_POST['nome'], 
                    'idade' =>$_POST['idade']
                ];
                if(empty($data["id"]) || empty($data["nome"]) || empty($data["idade"])){
                    $message = 'Usuário com dados incompletos, informe todos os campos';
                    header("location: ./usuario_crud.php?id=".$data['id']."&message=$message");
                }else{
                    
                    if($_POST["delete"]){
                        if($usuario->deleteUsuario($data)){
                            $message = 'Usuario '.$data["nome"].' excluído com sucesso';
                            header("location: ./index.php?message=$message");
                        }else{
                            $message = 'Usuario '.$data["nome"].' não foi excluído';
                            header("location: ./usuario_crud.php?id=".$data['id']."&message=$message");
                        }                        
                    }
                    if($_POST["salvar"]){
                        $message = $usuario->editarUsuario($data);
                        header("location: ./index.php?message=$message");
                    }
                }
                
            }else{
                $usuario = new UsuarioDAO();
                $data = [
                    'id' => NULL, 
                    'nome' => $_POST['nome'], 
                    'idade' =>$_POST['idade']
                ];
                if(empty($data["nome"]) || empty($data["idade"])){
                    $message = 'Preencha todos os dados';
                }else{
                    $message = $usuario->cadastrarUsuario($data);
                }
            }            
        } 
        
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
        <header>
            <div class="container menu">
                <ul>
                    <li><a href="../usuario">Usuarios</a></li>
                    <li><a href="../usuario">Usuarios</a></li>
                </ul>
            </div>
        </header>
        <main>
            <section class="container">
                <h5><?= $NomePagina ?></h5>
                
                <?php if (!empty($message)): ?>
                    <div class="row">
                        <h1><?= $message ?></h1>
                    </div>
                <?php endif ?>
                
                <form name="edita_cadastra_usuarios" method="post" action="usuario_crud.php">
                    <?php if ($usuarioEdit): ?>
                        <input type="hidden" name="id" value="<?= $usuarioEdit["id"] ?>">
                        <div class="form-group">
                        <label>Nome completo</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nomecompleto" 
                        value="<?= $usuarioEdit["nome"] ?>">
                        <small class="form-text text-muted">Informe nome e sobrenome.</small>
                        </div>
                        <div class="form-group">
                        <label>Idade</label>
                        <input name="idade" type="text" class="form-control" placeholder="Idade"
                        value="<?= $usuarioEdit["idade"] ?>">
                        <small class="form-text text-muted">Informe a idade em forma numérica.</small>
                        </div>
                        <button type="submit" name="salvar" value="salvar" class="btn btn-primary">Salvar</button>
                        <button type="submit" name="delete" value="delete" class="btn btn-danger">Excluir</button>
                    <?php else: ?>
                        <div class="form-group">
                        <label>Nome completo</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nomecompleto" >
                        <small class="form-text text-muted">Informe nome e sobrenome.</small>
                        </div>
                        <div class="form-group">
                        <label>Idade</label>
                        <input name="idade" type="text" class="form-control" placeholder="Idade">
                        <small class="form-text text-muted">Informe a idade em forma numérica.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    <?php endif ?>
                </form>
            </section>
        </main>
        <footer>

        </footer>
        
        <script src="../public/js/bootstrap.bundle.min.js"></script>
        <script src="../public/js/bootstrap.esm.min.js"></script>
        <script src="../public/js/bootstrap.min.js"></script>
</body>
</html>
        
        
    


    

    
    