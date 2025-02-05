<?php
session_start();
unset($_SESSION['email']); // logout .. fazer a destruição dos sessions .. session_destroy();
session_destroy();
header("Location: index.php"); // Redireciona para a página de login se não estiver logado

?>