<?php
require ".././Config.php";
require "./ProdutoDAO.php";

        $title = "Produtos";
        $NomePagina = "Cadastro produto";
        $message = "";

        $Produto = new ProdutoDAO();
        $categorias = $Produto->GetCategoria();
        if($_GET['message']){
          $message = $_GET['message'];
        }
        if(isset($_GET['id']) && $_GET['id']){
          $Produto = new ProdutoDAO();
          $produtos = $Produto->GetById($_GET['id']);
        }
        
        if($_POST['button'] && $_POST['nome'] && $_POST['descricao']){
            if($_POST['button'] == "cadastrar"){
                // CADASTRAR    
                var_dump($_POST);
                die("_POST");
                $data = [
                  'id' => NULL, 
                  'nome' => $_POST['nome'], 
                  'descricao' =>$_POST['descricao']
                ];
                $produto = new ProdutoDAO();
                $message = $produto->Cadastrar($data);
                
                if($message === true){
                  $message = 'produto "'.$data['nome'].'" inserida com sucesso!';
                  header("location: ".RAIZ_PROJETO."Produto/?&message=$message");
                }else{
                  $message = "Algum erro conteceu, tente a inserção novamente";
                  header("location: ".RAIZ_PROJETO."Produto/Produto_crud.php?&message=$message");
                }
            
            }elseif($_POST['button'] == "editar"){
              // EDITAR
              $data = [
                'id' => $_POST['id'], 
                'nome' => $_POST['nome'], 
                'descricao' =>$_POST['descricao']
              ];
              $produto = new ProdutoDAO();
              $message = $produto->Editar($data);
              
              if($message === true){
                $message = 'produto "'.$data['nome'].'" alterada com sucesso!';
                header('location: '.RAIZ_PROJETO.'Produto/?message='.$message);
              }else{
                $message = "Algum erro conteceu, tente alterar novamente";
                header('location: '.RAIZ_PROJETO.'Produto/Produto_crud.php?id='.$data['id'].'&message='.$message);
              }
            }
            elseif($_POST['button'] == "delete"){
              // EXCLUIR
              
              $produto = new ProdutoDAO();
              $Existeproduto = $produto->GetById($_POST['id']);
              if($Existeproduto["id"]){
                
                $message = $produto->Deletar($Existeproduto["id"]);
                if($message === true){
                  $message = 'produto "'.$Existeproduto['nome'].'" alterada com sucesso!';
                  header('location: '.RAIZ_PROJETO.'Produto/?message='.$message);
                }else{
                  $message = "Algum erro conteceu, tente alterar novamente";
                  header('location: '.RAIZ_PROJETO.'Produto/Produto_crud.php?id='.$POST['id'].'&message='.$message);
                } 
              }else{
                $message = "produto não existe";
                header('location: '.RAIZ_PROJETO.'Produto/Produto_crud.php?id='.$POST['id'].'&message='.$message);
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
                  <form name="edita_cadastra_produto" method="post" action="Produto_crud.php">
                    <?php if ($produtos): ?>
                      <input type="hidden" name="id" value="<?= $produtos["id"] ?>">
                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <label>nome</label>
                              <input value="<?= $produtos["nome"] ?>" name="nome" type="text" class="form-control" placeholder="nome">
                              <small class="form-text text-muted">Informe a nome do produto a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Select2 Multiple</label>
                            <select class="form-control select2" name="categorias" multiple="">
                              
                              <option>Option 1</option>
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                              <label>Descrição</label>
                              <input value="<?= $produtos["descricao"] ?>" name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição do produto a ser cadastrada.</small>
                          </div>
                      </div>
                      
                      <div class="card-footer">
                        <a href="<?= RAIZ_PROJETO ?>Produto" class="btn btn-primary"> Voltar</a>
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
                              <small class="form-text text-muted">Informe a nome do produto a ser cadastrada.</small>
                          </div>
                          <div class="form-group col-md-9">
                              <label>Descrição</label>
                              <input name="descricao" type="text" class="form-control" placeholder="Descrição">
                              <small class="form-text text-muted">Descrição do produto a ser cadastrada.</small>
                          </div>
                      </div>
                      <div class="form-group">
                        <label>Select2 Multiple</label>
                        <select class="form-control select2" multiple="">
                          <?php foreach($categorias as $key=>$item): ?>
                            <option name="<?= $item["id"] ?>" value="<?= $item["id"] ?>"><?= $item["nome"] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div>
                        <a href="<?= RAIZ_PROJETO ?>Produto" class="btn btn-primary"> Voltar</a>
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