<?php

if (!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['usuario'])){
    die ("Voce nao pode acessar essa pagina, <a href='login.php'>Entre</a>");
}
?>