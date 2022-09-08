<?php
$sql = "SELECT *
        FROM paginas
";
$consulta = $conn->prepare($sql);
$resultado = $consulta->execute();
while ($linha_menu = $consulta->fetch()) {
    echo "<a href=\"?pagina={$linha_menu['url']}\">{$linha_menu['label']}</a> - ";
}
?>
<a href="?pagina=logout">Sair</a>
<hr>