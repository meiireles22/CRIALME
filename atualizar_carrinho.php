<?php
include 'config.php';

if (!isset($_SESSION['email'])) {
    echo "<li class='list-group-item'>Tem de efetuar Login.</li>";
    exit;
}

$email = $_SESSION['email'];

// Obtém o ID do utilizador
$sql_user = "SELECT idUsers FROM users WHERE email = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<li class='list-group-item'>Erro: Utilizador não encontrado.</li>";
    exit;
}

$row = $result->fetch_assoc();
$user_id = $row['idUsers'];

// Busca os produtos do carrinho
$sql = "SELECT product, price FROM cart
        WHERE idUser = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total_itens = 0;

if ($result->num_rows > 0) {
    echo "<ul class='list-group mb-4'>";
    while ($row = $result->fetch_assoc()) {
        $total_itens += $row['price'];
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                {$row['product']}
                <span class='badge bg-primary rounded-pill'>€ {$row['price']}</span>
              </li>";
    }
    echo "</ul>";
} else {
    echo "<li class='list-group-item'>Seu carrinho está vazio.</li>";
}

// Atualiza a contagem de itens no carrinho
echo "<script>document.getElementById('cart-count').innerText = '$total_itens';</script>";

$conn->close();
?>
