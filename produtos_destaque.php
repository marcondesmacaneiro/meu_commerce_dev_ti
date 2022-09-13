<h3>Produtos em Destaque</h3>

<?php if (isset($_GET['categoria'])) {
    $sql_produtos_destaque = '
       SELECT p.id, p.descricao, p.valor, p.resumo, p.imagem
        FROM produtos p
        WHERE p.categoria_id in (select id from categorias where categoria_pai = :categoria_id or id = :categoria_id)
        ORDER BY RAND()
        LIMIT 4
    ';
    $sql_produtos_destaque = $conn->prepare($sql_produtos_destaque);
    $sql_produtos_destaque->execute(['categoria_id' => $_GET['categoria']]);
} else {
    $sql_produtos_destaque = '
        SELECT id, descricao, valor, resumo, imagem
        FROM produtos
        ORDER BY RAND()
        LIMIT 4;
    ';
    $sql_produtos_destaque = $conn->prepare($sql_produtos_destaque);
    $sql_produtos_destaque->execute();
} ?>
<div class="row">
    <?php while ($produto = $sql_produtos_destaque->fetch()) { ?>
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
    <?php } ?>
</div>