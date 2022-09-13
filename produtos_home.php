<?php
$sql_categoria = 'SELECT * from categorias where id = :id';
$categoria = $conn->prepare($sql_categoria);
$categoria->execute(['id' => $_GET['categoria']]);
$linha_categoria = $categoria->fetch();

if (empty($linha_categoria['categoria_pai'])) {
    include 'produtos_destaque.php';
} else {
     ?>
<h3>Produtos da Categoria: <?php echo $linha_categoria['descricao']; ?> </h3>

<div class="row">
    <?php
    $sql_produtos = 'SELECT * from produtos where categoria_id = :id';
    $consulta_produtos = $conn->prepare($sql_produtos);
    $consulta_produtos->execute(['id' => $_GET['categoria']]);

    while ($produto = $consulta_produtos->fetch()) { ?>
    <div class="card" style="width: 18rem;">
        <img src="imagens/<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto[
    'descricao'
]; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $produto['descricao']; ?></h5>
            <p class="card-text"><?php echo $produto['resumo']; ?></p>
            <a href="?pagina=produto&id=<?php echo $produto['id']; ?>" class="btn btn-primary">Detalhes</a>
        </div>
    </div>
    <?php }
    ?>
</div>

<?php
} ?>