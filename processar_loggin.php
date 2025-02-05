<?php 
session_start();

// Configuração da base de dasdos
$host = 'localhost'; // Endereço do servidor
$db = 'crialme'; // Nome da base de dasdos
$user = 'root'; // Utlizador da base de dasdos
$password = ''; // Passoword da base de dasdos

// Conexão com a base de dasdos
$conn = new mysqli($host, $user, $password, $db);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validação básica
    if (!empty($email) && !empty($password)) {
        // Consulta para verificar o login
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Iniciar sessão e redirecionar
            $_SESSION['email'] = $email; // Armazena o e-mail na sessão 
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                    alert('E-mail ou senha incorretos.');
                    window.location.href = 'loggin.php';
                </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            alert('Por favor, preencha todos os campos.');
            window.location.href = 'loggin.php';
        </script>";
    }
}

$conn->close();
?>