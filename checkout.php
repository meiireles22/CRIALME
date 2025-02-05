<!DOCTYPE html>
<html lang="pt">
<head>
    <title>CRIALME</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--Bootstrap ================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--Link Swiper's CSS ================================================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Style Sheet ================================================== -->
    <link rel="stylesheet" href="styles/checkout.css">
    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>
<body>

<div class="checkout-container">
    <div class="backpage">
        <a href="index.php">
            <button class="back-button">←</button>
        </a> 
    <h2>Finalizar Compra </h2>
</div>

    <!-- Formulário de Dados Pessoais e Pagamento -->
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
    </div>

    <div class="form-group">
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" required>
    </div>

    <div class="form-group">
        <label for="codigo_postal">Código Postal</label>
        <input type="text" id="codigo_postal" name="codigo_postal" required>
    </div>

    <div class="form-group">
        <label for="localidade">Localidade</label>
        <input type="text" id="localidade" name="localidade" required>
    </div>

    <div class="form-group">
        <label for="cidade">Cidade</label>
        <input type="text" id="cidade" name="cidade" required>
    </div>

    <div class="form-group">
        <label for="pais">País</label>
        <input type="text" id="pais" name="pais" required>
    </div>

    <div class="form-group">
        <label for="pagamento">Método de Pagamento</label>
        <select id="pagamento" name="pagamento" required>
            <option value="EC">Envio à Cobrança</option>
            <option value="TB">Transferência Bancária</option>
        </select>
    </div>

    <div class="form-group" id="iban-container" style="display: none;">
        <label for="iban">IBAN da Empresa</label>
        <input type="text" id="iban" name="iban" value="PT50 001 800 080 205 747 802 087" readonly>
    </div>

    <button type="submit" class="submit-btn" onclick="finalizeOrder()">Finalizar Compra</button>

    <div class="form-group">

    <?php
            include 'config.php';

            if (!isset($_SESSION['email'])) {
                echo "<li class='list-group-item'>Tem de efetuar Login.</li>";
                exit;
            }

            $email = $_SESSION['email'];

            // Obtém o ID do usuário
            $sql_user = "SELECT idUsers FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql_user);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                echo "<li class='list-group-item'>Erro: Usuário não encontrado.</li>";
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
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                            Total:
                            <span class='badge bg-primary rounded-pill'>€ {$total_itens}</span>
                        </li>";
                echo "</ul>";
            } else {
                echo "<li class='list-group-item'>Seu carrinho está vazio.</li>";
            }

            // Atualiza a contagem de itens no carrinho
            echo "<script>document.getElementById('cart-count').innerText = '$total_itens';</script>";

            $conn->close();
        ?>
    </div>

</div>






<!-- Popup de Confirmação -->
<div class="popup" id="popup">
    <div class="popup-content">
        <h3>Encomenda Feita com Sucesso!</h3>
        <button onclick="closePopup()">OK!</button>
    </div>
</div>

<script>

    // Adiciona o evento 'change' para o select de pagamento
    document.getElementById('pagamento').addEventListener('change', togglePaymentFields);
    
    // Chama a função inicial para garantir que o IBAN esteja correto no início
    togglePaymentFields();

    function togglePaymentFields() {
        const paymentMethod = document.getElementById('pagamento').value;
        const ibanContainer = document.getElementById('iban-container');
    
        if (paymentMethod == 'TB') {
            ibanContainer.style.display = 'block'; // Exibe o campo IBAN
        } else {
            ibanContainer.style.display = 'none'; // Oculta o campo IBAN
        }
    }

    function finalizeOrder() {
        // Verificar se o formulário foi preenchido corretamente
        const nome = document.getElementById('nome').value;
        const endereco = document.getElementById('endereco').value;
        const codigo_postal = document.getElementById('codigo_postal').value;
        const localidade = document.getElementById('localidade').value;
        const cidade = document.getElementById('cidade').value;
        const pais = document.getElementById('pais').value;
        const pagamento = document.getElementById('pagamento').value;

        if (nome && endereco && codigo_postal && localidade && cidade && pais && pagamento) {
            // Enviar os dados para o PHP usando AJAX
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('endereco', endereco);
            formData.append('codigo_postal', codigo_postal);
            formData.append('localidade', localidade);
            formData.append('cidade', cidade);
            formData.append('pais', pais);
            formData.append('pagamento', pagamento);

            fetch('criar_encomenda.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // Obtém a resposta como texto primeiro
            })
            .then(responseText => {
                console.log("Resposta do servidor:", responseText); // Mostra a resposta na consola

                try {
                    const data = JSON.parse(responseText); // Tenta converter para JSON
                    if (data.success) {
                        document.getElementById('popup').classList.add('active'); // Mostra o popup de sucesso
                    } else {
                        alert('Erro ao processar a encomenda: ' + (data.message || 'Tente novamente!'));
                    }
                } catch (error) {
                    console.error('Erro ao analisar JSON:', error);
                    alert('Erro ao interpretar a resposta do servidor.');
                }
            })
            .catch(error => {
                console.error('Erro no fetch:', error);
                alert('Erro ao enviar requisição. Verifique a conexão ou tente novamente.');
            });


        } else {
            alert('Por favor, preencha todos os campos!');
        }
    }

function closePopup() {
    document.getElementById('popup').classList.remove('active');
    window.location.href= "index.php";
}
</script>

</body>
</html>

