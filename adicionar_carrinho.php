<?php
//session_start();
include 'config.php'; // Certifica de que já tem essa conexão feita

// Verifica se o utilizador está logado
if (!isset($_SESSION['email'])) {
    die("Erro: Usuário não autenticado.");
}

// Obtém o e-mail do utlizador logado
$email = $_SESSION['email'];

// Obtém o ID do utilizador a partir do e-mail
$sql_user = "SELECT idUsers FROM users WHERE email = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Erro: Utilizador não encontrado.");
}

$row = $result->fetch_assoc();
$user_id = $row['idUsers']; // ID do usuário logado

// Obtém o ID do produto enviado via POST
if (!isset($_POST['produto_id'])) {
    die("Erro: Nenhum produto selecionado.");
}

$produto_id = $_POST['produto_id'];

// Verifica se o produto já está no carrinho do utilizador
$sql_verifica = "SELECT * FROM cart WHERE idUser = ? AND idProduct = ?";
$stmt = $conn->prepare($sql_verifica);
$stmt->bind_param("ii", $user_id, $produto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // nao faz nada
} else {
    // Caso contrário, adiciona o produto ao carrinho com o preço da base de dados
    $sql_insert = "INSERT INTO cart (idCart,idUser, product, price,idProduct) 
                   VALUES (0,?, (SELECT productName FROM product WHERE idProduct = ?), (SELECT value FROM product WHERE idProduct = ?), $produto_id )";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("iii", $user_id, $produto_id, $produto_id);
}

// Executa a inserção/atualização
if ($stmt->execute()) {
    

    echo "Produto adicionado ao carrinho!";
} else {
    echo "Erro ao adicionar produto: " . $stmt->error;
}



$conn->close();
?>

