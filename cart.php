    <!-- Offcanvas para o carrinho de compras -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart"
        aria-labelledby="My Cart">
        <!-- Cabeçalho do offcanvas -->
        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
         <!-- Corpo do offcanvas -->
        <div class="offcanvas-body">
            <?php if (!isset($_SESSION['email'])) { ?>
                <!-- Se o utlizador não estiver logado, exibir mensagem de login obrigatório -->
                <div>- Tem de efetuar Login</div>
            <?php } else { ?>
                <!-- Se o tilizador estiver logado, exibir o conteúdo do carrinho -->
                <div class="order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-primary">Your cart</span>
                    </h4>
                     <!-- Lista de itens do carrinho (será preenchida dinamicamente) -->
                    <ul id="cart-items" class="list-group mb-4">
                        <li class="list-group-item">Carregar...</li>
                    </ul>
                    
                    <!-- Botão para continuar para o checkout -->
                    <a href="checkout.php" class="w-100 btn btn-dark">Continue to checkout</a>
                </div>
            <?php } ?>
        </div>
    </div>


    <script>
        function atualizarCarrinho() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "atualizar_carrinho.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("cart-items").innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }

        // Carregar o carrinho ao abrir a página
        document.addEventListener("DOMContentLoaded", atualizarCarrinho);
    </script>
