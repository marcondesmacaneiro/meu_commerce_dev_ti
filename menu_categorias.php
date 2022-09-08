<?php
$sql_categorias = 'SELECT * from categorias order by id';
$sql_prepara = $conn->prepare($sql_categorias);
$sql_prepara->execute();

while ($categoria = $sql_prepara->fetch()) {
    if (!empty($categoria['categoria_pai'])) {
        $identacao = '&nbsp;&nbsp;&nbsp;';
    } else {
        $identacao = '';
    }
    echo "{$identacao}<a href=\"?pagina=produtos&categoria={$categoria['id']}\" class=\"btn btn-link\">{$categoria['descricao']}</a><br>";
}
?>