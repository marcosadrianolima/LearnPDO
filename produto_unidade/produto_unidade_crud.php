<?php
require ".././Config.php";
require "./ProdutoUnidadeDAO.php";
// error_reporting(0);
        
        $title = "Unidade de produtos";
        $NomePagina = "Unidade de medida";
        $message = "";
        if($_GET['message']){
          $message = $_GET['message'];
        }
        if(isset($_GET['id']) && $_GET['id']){
          $ProdutoUnidade = new ProdutoUnidadeDAO();
          $unidade = $ProdutoUnidade->getProdutoUnidadeById($_GET['id']);
        }
        if($_POST['button'] && $_POST['sigla'] && $_POST['descricao']){
            if($_POST['button'] == "cadastrar"){
                // CADASTRAR    
                $data = [
                  'id' => NULL, 
                  'sigla' => $_POST['sigla'], 
                  'descricao' =>$_POST['descricao']
                ];
                $unidade = new ProdutoUnidadeDAO();
                $message = $unidade->cadastrarUnidade($data);
                if($message === true){
                  $message = 'Unidade "'.$data['sigla'].'" inserida com sucesso!';
                  header("location: ".RAIZ_PROJETO."produto_unidade/?&message=$message");
                }else{
                  $message = "Algum erro conteceu, tente a inserção novamente";
                  header("location: ".RAIZ_PROJETO."produto_unidade/produto_unidade_crud.php?&message=$message");
                }
            
            }elseif($_POST['button'] == "editar"){
              // EDITAR
              $data = [
                'id' => $_POST['id'], 
                'sigla' => $_POST['sigla'], 
                'descricao' =>$_POST['descricao']
              ];
              $unidade = new ProdutoUnidadeDAO();
              $message = $unidade->editarUnidade($data);
              
              if($message === true){
                $message = 'Unidade "'.$data['sigla'].'" alterada com sucesso!';
                header('location: '.RAIZ_PROJETO.'produto_unidade/?message='.$message);
              }else{
                $message = "Algum erro conteceu, tente alterar novamente";
                header('location: '.RAIZ_PROJETO.'produto_unidade/produto_unidade_crud.php?id='.$data['id'].'&message='.$message);
              }
            }
            elseif($_POST['button'] == "delete"){
              // EXCLUIR
              
              $unidade = new ProdutoUnidadeDAO();
              $ExisteUnidade = $unidade->getProdutoUnidadeById($_POST['id']);
              if($ExisteUnidade["id"]){
                
                $message = $unidade->deleteUnidade($ExisteUnidade["id"]);
                if($message === true){
                  $message = 'Unidade "'.$ExisteUnidade['sigla'].'" alterada com sucesso!';
                  header('location: '.RAIZ_PROJETO.'produto_unidade/?message='.$message);
                }else{
                  $message = "Algum erro conteceu, tente alterar novamente";
                  header('location: '.RAIZ_PROJETO.'produto_unidade/produto_unidade_crud.php?id='.$POST['id'].'&message='.$message);
                } 
              }else{
                $message = "Usuário não existe";
                header('location: '.RAIZ_PROJETO.'produto_unidade/produto_unidade_crud.php?id='.$POST['id'].'&message='.$message);
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
                  <form name="edita_cadastra_unidades" method="post" action="produto_unidade_crud.php">
                    <?php if ($unidade): ?>
                      <input type="hidden" name="id" value="<?= $unidade["id"] ?>">
                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <label>Sigla</label>
                              <input value="<?= $unidade["sigla"] ?>" name="sigla" type="text" class="form-control" placeholder="Sigla">
                              <small class="form-text text-muted">Informe a sigla da unidade a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-9">
                              <label>Descrição</label>
                              <input value="<?= $unidade["descricao"] ?>" name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição da unidade a ser cadastrada.</small>
                          </div>
                      </div>
                      <div class="card-footer">
                        <a href="<?= RAIZ_PROJETO ?>produto_unidade" class="btn btn-primary"> Voltar</a>
                        <button type="submit" name="button" value="editar"
                            class="btn btn-success pull-right">Salvar</button>
                        <button type="submit" name="button" value="delete"
                            class="btn btn-danger pull-right">Excluir</button>
                    </div>
                    <?php else: ?>
                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <label>Sigla</label>
                              <input name="sigla" type="text" class="form-control" placeholder="Sigla">
                              <small class="form-text text-muted">Informe a sigla da unidade a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-9">
                              <label>Descrição</label>
                              <input name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição da unidade a ser cadastrada.</small>
                          </div>
                      </div>
                      <div>
                        <a href="<?= RAIZ_PROJETO ?>produto_unidade" class="btn btn-primary"> Voltar</a>
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