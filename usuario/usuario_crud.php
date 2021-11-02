<?php
require "../Config.php";
require "./UsuarioDAO.php";
error_reporting(0);
        $title = "Cadastro Usuário";
        $NomePagina = "Cadastro usuário";
        $message = "";
  
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            //EDITAR USUÁRIO
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
                    //DELETAR USUÁRIO
                    if($_POST["delete"]){
                        if($usuario->deleteUsuario($data)){
                            $message = 'Usuario '.$data["nome"].' excluído com sucesso!';
                            header("location: ./index.php?message=$message");
                        }else{
                            $message = 'Usuario '.$data["nome"].' não foi excluído';
                            header("location: ./usuario_crud.php?id=".$data['id']."&message=$message");
                        }                        
                    }
                    //EDITAR USUÁRIO
                    if($_POST["salvar"]){
                        $message = $usuario->editarUsuario($data);
                        header("location: ./index.php?message=$message");
                    }
                }
                
            }else{
                //CADASTRAR USUÁRIO 
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
                    if($message === true){
                      $message = 'Usuario '.$data["nome"].' inserido com sucesso!';
                      header("location: ./?id=".$data['id']."&message=$message");
                    }else{
                      $message = 'Erro ao inserir usuário';
                    }
                }
            }            
        } 
        
?>
    <?php include '../template/head.php';?>
    <?php include '../template/header.php';?>
    <?php include '../template/sidebar-navegation.php';?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <section class="container-fluid">
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
                        <a href="../usuario" class="btn btn-primary"> Voltar</a>
                        <button type="submit" name="salvar" value="salvar" class="btn btn-success pull-right">Salvar</button>
                        <button type="submit" name="delete" value="delete" class="btn btn-danger pull-right">Excluir</button>
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
                        <a href="../usuario" class="btn btn-primary"> Voltar</a>
                        <button type="submit" class="btn btn-success pull-right">Salvar</button>
                    <?php endif ?>
                </form>
            </section>
          </div>
        </section>
      </div>
    <?php include '../template/footer.php';?>
    
        
        
    


    

    
    