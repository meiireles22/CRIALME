<?php
//session_start();
include 'config.php'; // Certifique-se de que já tem essa conexão feita

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    echo("Erro: Usuário não autenticado.");
}

// Obtém o e-mail do usuário logado
$email = $_SESSION['email'];

// Obtém o ID do usuário a partir do e-mail
$sql_user = "SELECT idUsers FROM users WHERE email = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo("Erro: Usuário não encontrado.");
}

$row = $result->fetch_assoc();
$user_id = $row['idUsers']; // ID do utlizador logado

// Obtém o ID do produto enviado via POST
/*if (!isset($_POST['produto_id'])) {
    echo("Erro: Nenhum produto selecionado.");
}*/

// Captura os valores do formulário
$comprimentoCentroCostas = $_POST['comprimentoCentroCostas'] ?? 0;
$medidaPeito = $_POST['medidaPeito'] ?? 0;
$medidaOmbro = $_POST['medidaOmbro'] ?? 0;
$larguraCostas = $_POST['larguraCostas'] ?? 0;
$comprimentoManga = $_POST['comprimentoManga'] ?? 0;
$medidaCinta = $_POST['medidaCinta'] ?? 0;
$medidaAnca = $_POST['medidaAnca'] ?? 0;
$coxa = $_POST['coxa'] ?? 0 ;
$entrePerna = $_POST['entrePerna'] ?? 0;
$corTecido = $_POST['corTecido'] ?? "";
$tipoForro = $_POST['tipoForro'] ?? "";
$tipoBotao = $_POST['tipoBotao'] ?? "";
$corCalcas = $_POST['corCalcas'] ?? "";
$tipoTecidoCalcas = $_POST['tipoTecidoCalcas'] ?? "";
$suitTag = $_POST['suitTag'] ?? "";




// Query SQL utilizando Prepared Statement
$sql_insert = "INSERT INTO customsuit (
                    comprimentoCentroCostas,
                    medidaPeito,
                    medidaOmbro,
                    larguraCostas,
                    comprimentoManga,
                    medidaCinta,
                    medidaAnca,
                    coxa,
                    entrePerna,
                    corTecido,
                    tipoForro,
                    tipoBotao,
                    corCalcas,
                    tipoTecidoCalcas,
                    suitTag
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


// Prepara a query
$stmt = $conn->prepare($sql_insert);

// Associa os parâmetros (sssss para strings, d para números decimais/integer)
$stmt->bind_param("sssssssssssssss", 
    $comprimentoCentroCostas, 
    $medidaPeito, 
    $medidaOmbro, 
    $larguraCostas,
    $comprimentoManga,
    $medidaCinta, 
    $medidaAnca, 
    $coxa, 
    $entrePerna, 
    $corTecido, 
    $tipoForro, 
    $tipoBotao, 
    $corCalcas, 
    $tipoTecidoCalcas, 
    $suitTag
);


$stmt->execute();

$sql_insert = "INSERT INTO cart (idCart, idUser, product, price) 
               VALUES (0, ?, ?, 930)";
$stmt = $conn->prepare($sql_insert);

$product_name = "Custom Suit";

$stmt->bind_param("is", $user_id, $product_name);

$stmt->execute();

$conn->close();


header("Location: custom-Suit.php");
exit();

?>


