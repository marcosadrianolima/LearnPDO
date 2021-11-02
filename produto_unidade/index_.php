<?php
require ".././Config.php";
require "./ProdutoUnidadeDAO.php";
error_reporting(0);
        
        $title = "Unidade de produtos";
        $ProdutoUnidade = new ProdutoUnidadeDAO();
        $ProdutoUnidades = $ProdutoUnidade->ListarProdutoUnidade();
        // echo"<pre>";
        // var_dump($ProdutoUnidades);
        // die("");
        $message = '';
        if($_GET['message']){
            $message = $_GET['message'];
        } 
        if($_POST){
          //  $usuario = new UsuarioDAO();
          //  $usuarios = $usuario->pesquisaUsuario($_POST["pesquisa-usuarios"]);
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
                                <a href="" class="btn btn-danger">Limpar filtro</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <h5>Cadastrar nova unidade</h5>
                        <a href="./usuario_crud.php?" class="btn btn-success">Cadastrar</a>
                    </div>
                </div>
                <?php if (!empty($message)): ?>
                    <div class="row">
                        <h1><?= $message ?></h1>
                    </div>
                <?php endif ?>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Sigla</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    <?php if ($ProdutoUnidades): ?>
                        <form method="post" id="form">
                        
                        <?php foreach($ProdutoUnidades as $key=>$ProdutoUnidade): ?>
                        <tr>
                            <th scope="row"name="<?= $usuario['id'] ?>" form="form"><?= $ProdutoUnidade['id'] ?></th>
                            <td name="<?= $ProdutoUnidade['sigla'] ?>" form="form"><?= $ProdutoUnidade['sigla'] ?></td>
                            <td name="<?= $ProdutoUnidade['descricao'] ?>" form="form"><?= $ProdutoUnidade['descricao'] ?></td>
                            <td><a href="./usuario_crud.php?id=<?= $ProdutoUnidade['id'] ?>"> Editar</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </form>
                    <?php endif ?>
                    </tbody>
                  </table>
            </section>
          </div>
        </section>
        <?php include '../template/sidebar-style.php';?>
      </div>
    <?php include '../template/footer.php';?>
    
        
        
    


    

    
    