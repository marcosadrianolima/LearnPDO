<?php
require ".././Config.php";
require "./ProdutoDAO.php";

        $title = "Produtos";
        $Produto = new ProdutoDAO();
        $Produtos = $Produto->Listar();
        
        $message = '';
        if($_GET['message']){
            $message = $_GET['message'];
        } 
        if($_POST && !empty($_POST["pesquisa-usuarios"])){
          $Produtos = $Produto->Pesquisar($_POST["pesquisa-usuarios"]);
          $message = 'Resultado para a pesquisa: "'.$_POST["pesquisa-usuarios"].'"';
        }
?>

<?php include '../template/head.php';?>
<?php include '../template/header.php';?>
<?php include '../template/sidebar-navegation.php';?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= $title ?></h4>
                        </div>
                        <?php if (!empty($message)): ?>
                        <div class="card-header">
                            <h6><?= $message ?></h6>
                        </div>
                        <?php endif ?>
                        <div class="form-group" style="display: inline-flex; padding: 10px 25px;">
                            <div style=" width: 50%;">
                                <form name="edita_cadastra_usuarios" method="post" action="index.php"
                                    style="display: flex;">
                                    <div class="form-group">
                                        <input class="form-control" name="pesquisa-usuarios" type="text"
                                            placeholder="Faça sua pesquisa aqui">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-lg">Pesquisar</button>
                                        <a href="" class="btn btn-danger btn-lg">Limpar filtro</a>
                                    </div>
                                </form>
                            </div>
                            <div style=" width: 50%; text-align: right;">
                                <a href="<?= RAIZ_PROJETO ?>Produto/produto_crud.php?"
                                    class="btn btn-success btn-lg">Cadastrar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#ID</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($Produtos): ?>
                                        <form method="post" id="form">

                                            <?php foreach($Produtos as $key=>$item): ?>
                                            <tr>
                                                <th scope="row" name="<?= $item['id'] ?>" form="form">
                                                    <?= $item['id'] ?></th>
                                                <td name="<?= $item['nome'] ?>" form="form">
                                                    <?= $item['nome'] ?></td>
                                                <td name="<?= $item['descricao'] ?>" form="form">
                                                    <?= $item['descricao'] ?></td>
                                                <td><a
                                                        href="<?= RAIZ_PROJETO ?>Produto/produto_crud.php?id=<?= $item['id'] ?>">
                                                        Editar</a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </form>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php';?>