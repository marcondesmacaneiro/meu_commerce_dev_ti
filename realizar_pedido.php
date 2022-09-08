<h1>
    Finalizar pedido.
</h1>

<?php if (isset($_POST['gravar_pedido'])) {
    //gerar a venda
    $sql_insere_venda = 'INSERT into vendas (usuario_id,data_venda) values (:id, now())';
    $sql_insere_venda = $conn->prepare($sql_insere_venda);
    $sql_insere_venda->execute(['id' => $_SESSION['usuario']['id']]);

    $venda_id = $conn->lastInsertId();

    //gravar os itens da venda
    foreach ($_SESSION['sacola'] as $item) {
        $sql_insert_item = "
            INSERT into vendas_produtos
            (venda_id, produto_id, valor_venda)
            values(:venda_id, :produto_id, (select valor from produtos where id = :produto_id ))
        ";
        $sql_insert_item = $conn->prepare($sql_insert_item);
        $sql_insert_item->execute(['venda_id' => $venda_id, 'produto_id' => $item[0]]);
    }
    echo '<div class="alert alert-success" role="alert">
            Pedido realizado com sucesso!
        </div>';
    //zera o carrinho
    unset($_SESSION['sacola']);
} else {
     ?>

<form method="post">
    <input class="btn btn-success" type="submit" name="gravar_pedido" value="Confirmar!">
</form>

<?php
}
?>