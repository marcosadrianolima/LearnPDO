<?php
require ".././Config.php";
require "./ProdutoCategoriaDAO.php";
error_reporting(0);
        
        $title = "Unidade de produtos";
        $NomePagina = "Unidade de medida";
        $message = "";
        if($_GET['message']){
          $message = $_GET['message'];
        }
        if(isset($_GET['id']) && $_GET['id']){
          $ProdutoUnidade = new ProdutoCategoriaDAO();
          $unidade = $ProdutoUnidade->GetById($_GET['id']);
        }
        
        if($_POST['button'] && $_POST['nome'] && $_POST['descricao']){
            if($_POST['button'] == "cadastrar"){
                // CADASTRAR    
                $data = [
                  'id' => NULL, 
                  'nome' => $_POST['nome'], 
                  'descricao' =>$_POST['descricao']
                ];
                $categoria = new ProdutoCategoriaDAO();
                $message = $categoria->Cadastrar($data);
                if($message === true){
                  $message = 'Categoria "'.$data['nome'].'" inserida com sucesso!';
                  header("location: ".RAIZ_PROJETO."produto_categoria/?&message=$message");
                }else{
                  $message = "Algum erro conteceu, tente a inserção novamente";
                  header("location: ".RAIZ_PROJETO."produto_categoria/produto_categoria_crud.php?&message=$message");
                }
            
            }elseif($_POST['button'] == "editar"){
              // EDITAR
              $data = [
                'id' => $_POST['id'], 
                'nome' => $_POST['nome'], 
                'descricao' =>$_POST['descricao']
              ];
              $categoria = new ProdutoCategoriaDAO();
              $message = $categoria->Editar($data);
              
              if($message === true){
                $message = 'Categoria "'.$data['nome'].'" alterada com sucesso!';
                header('location: '.RAIZ_PROJETO.'produto_categoria/?message='.$message);
              }else{
                $message = "Algum erro conteceu, tente alterar novamente";
                header('location: '.RAIZ_PROJETO.'produto_categoria/produto_categoria_crud.php?id='.$data['id'].'&message='.$message);
              }
            }
            elseif($_POST['button'] == "delete"){
              // EXCLUIR
              
              $categoria = new ProdutoCategoriaDAO();
              $ExisteCategoria = $categoria->GetById($_POST['id']);
              if($ExisteCategoria["id"]){
                
                $message = $categoria->Deletar($ExisteCategoria["id"]);
                if($message === true){
                  $message = 'Categoria "'.$ExisteCategoria['nome'].'" alterada com sucesso!';
                  header('location: '.RAIZ_PROJETO.'produto_categoria/?message='.$message);
                }else{
                  $message = "Algum erro conteceu, tente alterar novamente";
                  header('location: '.RAIZ_PROJETO.'produto_categoria/produto_categoria_crud.php?id='.$POST['id'].'&message='.$message);
                } 
              }else{
                $message = "Categoria não existe";
                header('location: '.RAIZ_PROJETO.'produto_categoria/produto_categoria_crud.php?id='.$POST['id'].'&message='.$message);
              }
              
                         
            }else{
              $message = "Preencha todos os dados";
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
            <div class="card">
                <div class="card-header">
                    <h4><?= $NomePagina ?></h4>
                    <?php if (!empty($message)): ?>
                      <h4><?= $message ?></h4>
                    <?php endif ?>
                  </div>
                <div class="card-body">
                  <form name="edita_cadastra_categoria" method="post" action="produto_categoria_crud.php">
                    <?php if ($unidade): ?>
                      <input type="hidden" name="id" value="<?= $unidade["id"] ?>">
                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <label>nome</label>
                              <input value="<?= $unidade["nome"] ?>" name="nome" type="text" class="form-control" placeholder="nome">
                              <small class="form-text text-muted">Informe a nome da unidade a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-9">
                              <label>Descrição</label>
                              <input value="<?= $unidade["descricao"] ?>" name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição da unidade a ser cadastrada.</small>
                          </div>
                      </div>
                      <div class="card-footer">
                        <a href="<?= RAIZ_PROJETO ?>produto_categoria" class="btn btn-primary"> Voltar</a>
                        <button type="submit" name="button" value="editar"
                            class="btn btn-success pull-right">Salvar</button>
                        <button type="submit" name="button" value="delete"
                            class="btn btn-danger pull-right">Excluir</button>
                    </div>
                    <?php else: ?>
                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <label>nome</label>
                              <input name="nome" type="text" class="form-control" placeholder="nome">
                              <small class="form-text text-muted">Informe a nome da unidade a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-9">
                              <label>Descrição</label>
                              <input name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição da unidade a ser cadastrada.</small>
                          </div>
                      </div>
                      <div>
                        <a href="<?= RAIZ_PROJETO ?>produto_categoria" class="btn btn-primary"> Voltar</a>
                        <button type="submit" name="button" value="cadastrar"
                            class="btn btn-success pull-right">Salvar</button>
                    </div>
                    <?php endif ?>
                  </form>
                </div>
                
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php';?>