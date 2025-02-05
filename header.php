<?php
// Detecta o nome da página atual
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header class="position-absolute top-0 start-0 w-100 z-1 myheader">
    <?php if ($currentPage === 'about-us.php' || $currentPage === 'products.php' || $currentPage == 'contacts.php' 
    || $currentPage == 'custom-Suit.php' || $currentPage == 'menOurWomen.php'
    || $currentPage == 'products2.php' || $currentPage == 'products3.php' || $currentPage == 'loggin.php' 
    ||$currentPage == 'product1.php' ||$currentPage == 'product2.php' ||$currentPage == 'product3.php' 
    ||$currentPage == 'product4.php' ||$currentPage == 'product5.php' ||$currentPage == 'product6.php' 
    ||$currentPage == 'product7.php' ||$currentPage == 'productW1.php' ||$currentPage == 'productW2.php'
    ||$currentPage == 'productW3.php' ||$currentPage == 'productW4.php' ||$currentPage == 'productW5.php' ||$currentPage == 'productW6.php'): ?>
        <div class="logo">
            <a href="index.php">
                <img src="imagens/logo_original.png" alt="Logotipo">
            </a>
        </div>
    <?php endif; ?>


    <nav class="navbar navbar-expand-lg navbar-light pt-4">
        <div class="container-fluid align-items-center align-items-lg-start mx-lg-5">
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- LOGIN -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="d-flex d-lg-none list-unstyled mt-3">
                    <div class="login me-3 align-items-center">
                        <li>
                            <?php
                            if (!isset($_SESSION['email'])) {
                                ?>
                            <a class="nav-link nav-link-ltr" href="loggin.php"><svg class="man" width="15" height="15">
                                    <use xlink:href="#man"></use> </svg> &nbsp; LOGIN</a>                                
                                <?php
                            } else {
                                ?>
                            <a class="nav-link nav-link-ltr" href="logout.php"><svg class="man" width="15" height="15">
                                    <use xlink:href="#man"></use> </svg> &nbsp; LOGOUT</a>

                                <?php
                            }
                            ?>
                        </li>
                    </div>
                    <!-- CARRINHO --> 
                    <div class="cart me-3">
                        <li><a class="nav-link nav-link-ltr" href="cart.php" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart"><svg class="cart"
                                    width="15" height="15">
                                    <use xlink:href="#cart"></use>
                                </svg> &nbsp; (0)</a></li>
                    </div>
                </ul>
                <!-- LINKS PÁGINAS -->
                <ul class="navbar-nav d-flex ms-auto me-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr text-white" href="about-us.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr text-white" href="products.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr text-white" href="contacts.php">CONTACTS</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav d-lg-block d-none list-unstyled">
                <div class="login">
                    <li>
                        <?php
                        if (!isset($_SESSION['email'])) {
                            ?>
                        <a class="nav-link nav-link-ltr text-white" href="loggin.php"><svg class="man" width="15"
                                height="15">
                                <use xlink:href="#man"></use>
                            </svg> &nbsp; LOGIN</a>
                            <?php
                        } else {
                            ?>
                        <a class="nav-link nav-link-ltr text-white" href="logout.php"><svg class="man" width="15"
                                height="15">
                                <use xlink:href="#man"></use>
                            </svg> &nbsp; <?=$_SESSION['email']?> : LOGOUT</a>
                            <?php
                        }
                        ?>                            
                    </li>
                </div>
                <!-- CARRINHO -->
                <div class="cart">
                    <li>
                        <a class="nav-link nav-link-ltr text-white" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <svg class="cart" width="15" height="15">
                                <use xlink:href="#cart"></use>
                            </svg> 
                            &nbsp;
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
</header>
