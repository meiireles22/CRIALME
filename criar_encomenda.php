<?php
// Iniciar sessão e incluir a configuração da base de dados
include 'config.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$email = $_SESSION['email'];

// Obtém o ID do utilizador logado
$sql_user = "SELECT idUsers FROM users WHERE email = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(['success' => false, 'message' => 'Erro: Usuário não encontrado.']);
    exit;
}

$row = $result->fetch_assoc();
$user_id = $row['idUsers']; // ID do utilizador logado

// Verificar se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $codigo_postal = $_POST['codigo_postal'];
    $localidade = $_POST['localidade'];
    $cidade = $_POST['cidade'];
    $pais = $_POST['pais'];
    $pagamento = $_POST['pagamento'];

    // Buscar os produtos no carrinho do utilizador
    $sql = "SELECT idProduct FROM cart WHERE idUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $produtos = [];
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row['idProduct'];
    }

    if (count($produtos) === 0) {
        echo json_encode(['success' => false, 'message' => 'Carrinho de compras vazio.']);
        exit;
    }

    // Transformar os IDs dos produtos em uma string separada por hífen
    $produtosIdsString = implode('-', $produtos);

    // Iniciar transação
    $conn->begin_transaction();

    try {
        // Inserir a encomenda na tabela 'orders'
        $sqlInsert = "INSERT INTO orders (idUser, adress, postalCode, locality, city, country, name, active, idPaymentType, productId) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("issssssss", $user_id, $endereco, $codigo_postal, $localidade, $cidade, $pais, $nome, $pagamento, $produtosIdsString);
        $stmtInsert->execute();

        // Apagar os produtos do carrinho do usuário
        $sqlDelete = "DELETE FROM cart WHERE idUser = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $user_id);
        $stmtDelete->execute();

        // Confirmar a transação
        $conn->commit();

        // Resposta de sucesso
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        // Reverter a transação em caso de erro
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
