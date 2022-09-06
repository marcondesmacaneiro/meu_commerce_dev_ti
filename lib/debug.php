<?php
if (isset($_SESSION['debug']) & ($_SESSION['debug'] == 'true')) {
    echo '<pre>';
    print_r($_GET);
    print_r($_POST);
    print_r($_SERVER);
    print_r($_SESSION);
    echo '</pre>';
}