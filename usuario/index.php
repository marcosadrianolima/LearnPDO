<?php
require ".././Config.php";
require "./UsuarioDAO.php";
error_reporting(0);

        $title = "Usuários";
        $usuario = new UsuarioDAO();
        $usuarios = $usuario->listarUsuarios();
        $message = '';
        if($_GET['message']){
            $message = $_GET['message'];
        } 
        if($_POST){
           $usuario = new UsuarioDAO();
           $usuarios = $usuario->pesquisaUsuario($_POST["pesquisa-usuarios"]);
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
                <div class="row">
                    <div class="col-md-6">
                        <h5>Pesquisa</h5>
                        <form name="edita_cadastra_usuarios" method="post" action="index.php" style="display: flex;">
                            <div class="form-group">
                                <input class="form-control" name="pesquisa-usuarios"type="text" placeholder="Faça sua pesquisa aqui">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                                <a href="<?= RAIZ_PROJETO ?>usuario" class="btn btn-danger">Limpar filtro</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <h5>Cadastrar novo usuário</h5>
                        <a href="./usuario_crud.php?" class="btn btn-success">Cadastrar</a>
                    </div>
                </div>
                <?php if (!empty($message)): ?>
                    <div class="row">
                        <h3><?= $message ?></h3>
                    </div>
                <?php endif ?>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    <?php if ($usuarios): ?>
                        <form method="post" id="form">
                        
                        <?php foreach($usuarios as $key=>$usuario): ?>
                        <tr>
                            <th scope="row"name="<?= $usuario['id'] ?>" form="form"><?= $usuario['id'] ?></th>
                            <td name="<?= $usuario['nome'] ?>" form="form"><?= $usuario['nome'] ?></td>
                            <td name="<?= $usuario['idade'] ?>" form="form"><?= $usuario['idade'] ?></td>
                            <td><a href="./usuario_crud.php?id=<?= $usuario['id'] ?>"> Editar</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </form>
                    <?php endif ?>
                    </tbody>
                  </table>
            </section>
          </div>
        </section>
      </div>
    <?php include '../template/footer.php';?>
    
        
        
    


    

    
    