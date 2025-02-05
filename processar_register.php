<?php
// Configuração da base de dados
$host = 'localhost'; // Endereço do servidor
$db = 'crialme'; // Nome da base de dados
$user = 'root'; // Utilizador da base de dados
$password = ''; // Password da base de dados

// Conexão com a base de dados
$conn = new mysqli($host, $user, $password, $db);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordd = isset($_POST['passwordd']) ? $_POST['passwordd'] : '';

    // Validação básica
    if (!empty($name) && !empty($email) && !empty($password)) {
        //CONFIRMA PASSWORDS
        if($password == $passwordd){
            $confirmaEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $confirmaEmail->bind_param("s", $email);
            $confirmaEmail->execute();
            $resultEmail = $confirmaEmail->get_result();

            if($resultEmail->num_rows <= 0){
                // Prepara a consulta SQL para inserção
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

                // Associa os valores aos placeholders
                $stmt->bind_param("sss", $name, $email, $password);

                // Executa a consulta
                if ($stmt->execute()) {
                    session_start();
                    $_SESSION['email'] = $email; // Armazena o e-mail na sessão 
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>
                        alert('Erro ao inserir os dados.');
                        window.location.href = 'register.php';
                    </script>";
                }

                // Fecha o statement
                $stmt->close();
            }
        }else{
            echo "<script>
                alert('Passwords não correspondem.');
                window.location.href = 'register.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Por favor, preencha todos os campos.');
            window.location.href = 'register.php';
        </script>";
    }
}

$conn->close();
?>
