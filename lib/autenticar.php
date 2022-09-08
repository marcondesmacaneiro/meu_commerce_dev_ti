<?php
if (isset($_POST['autenticar']) & !empty($_POST['login']) & !empty($_POST['senha'])) {
    $sql = "SELECT *
            FROM usuarios
            WHERE login = :login
            AND senha = md5(:senha)
        ";
    $consulta = $conn->prepare($sql);
    $consulta->execute(['login' => $_POST['login'], 'senha' => $_POST['senha']]);
    $usuario = $consulta->fetch();
    if ($consulta->rowCount() > 0) {
        if ($usuario['login'] == $_POST['login']) {
            $_SESSION['autenticado'] = true;
            $_SESSION['usuario'] = $usuario;
            //header('Location: ?');
        }
    } else {
        echo 'Usuário encontrado';
    }
}
?>