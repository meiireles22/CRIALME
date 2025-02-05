<?php
session_start();
//unset($_SESSION['email']); // logout .. fazer a destruição dos sessions .. session_destroy();
/*if (!isset($_SESSION['email'])) {
    header("Location: loggin.php"); // Redireciona para a página de login se não estiver logado
    exit();
}*/
?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="styles.css">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <?php include "./header.php";?>
    
    

    <!-- svg icon -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="arrow-left" viewBox="0 0 256 256">
            <path fill="currentColor"
                d="M220 128a4 4 0 0 1-4 4H49.66l65.17 65.17a4 4 0 0 1-5.66 5.66l-72-72a4 4 0 0 1 0-5.66l72-72a4 4 0 0 1 5.66 5.66L49.66 124H216a4 4 0 0 1 4 4" />
        </symbol>
        <symbol id="arrow-right" viewBox="0 0 256 256">
            <path fill="currentColor"
                d="m218.83 130.83l-72 72a4 4 0 0 1-5.66-5.66L206.34 132H40a4 4 0 0 1 0-8h166.34l-65.17-65.17a4 4 0 0 1 5.66-5.66l72 72a4 4 0 0 1 0 5.66" />
        </symbol>
        <symbol id="man" viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38c-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6M432 480H80a31 31 0 0 1-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75c1.94 10.73-.68 21.34-7.18 29.11A31 31 0 0 1 432 480" />
        </symbol>
        <symbol id="search" viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M456.69 421.39L362.6 327.3a173.8 173.8 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.8 173.8 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3M97.92 222.72a124.8 124.8 0 1 1 124.8 124.8a124.95 124.95 0 0 1-124.8-124.8" />
        </symbol>
        <symbol id="expand" viewBox="0 0 32 32">
            <path fill="currentColor"
                d="m25.545 23.328l-7.627-7.705l7.616-7.616l1.857 1.857l2.26-8.428l-8.428 2.258l1.836 1.836l-7.603 7.604l-7.513-7.59L9.81 3.695L1.392 1.394l2.215 8.44l1.848-1.83l7.524 7.604l-7.515 7.515l-1.856-1.855l-2.26 8.427l8.43-2.257L7.94 25.6l7.503-7.502l7.614 7.693l-1.867 1.848l8.416 2.3l-2.213-8.438z" />
        </symbol>
        <symbol id="wishlist" viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M256 448a32 32 0 0 1-18-5.57c-78.59-53.35-112.62-89.93-131.39-112.8c-40-48.75-59.15-98.8-58.61-153C48.63 114.52 98.46 64 159.08 64c44.08 0 74.61 24.83 92.39 45.51a6 6 0 0 0 9.06 0C278.31 88.81 308.84 64 352.92 64c60.62 0 110.45 50.52 111.08 112.64c.54 54.21-18.63 104.26-58.61 153c-18.77 22.87-52.8 59.45-131.39 112.8a32 32 0 0 1-18 5.56" />
        </symbol>
        <symbol id="cart" viewBox="0 0 512 512">
            <circle cx="176" cy="416" r="32" fill="currentColor" />
            <circle cx="400" cy="416" r="32" fill="currentColor" />
            <path fill="currentColor"
                d="M456.8 120.78a23.92 23.92 0 0 0-18.56-8.78H133.89l-6.13-34.78A16 16 0 0 0 112 64H48a16 16 0 0 0 0 32h50.58l45.66 258.78A16 16 0 0 0 160 368h256a16 16 0 0 0 0-32H173.42l-5.64-32h241.66A24.07 24.07 0 0 0 433 284.71l28.8-144a24 24 0 0 0-5-19.93" />
        </symbol>
        <symbol id="play" viewBox="0 0 512 512">
            <path fill="currentColor" d="m96 448l320-192L96 64z" />
        </symbol>
        <symbol id="down" viewBox="0 0 24 24">
            <g fill="none" fill-rule="evenodd">
                <path
                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                <path fill="currentColor"
                    d="M13.06 16.06a1.5 1.5 0 0 1-2.12 0l-5.658-5.656a1.5 1.5 0 1 1 2.122-2.121L12 12.879l4.596-4.596a1.5 1.5 0 0 1 2.122 2.12l-5.657 5.658Z" />
            </g>
        </symbol>
    </svg>
    

    <?php include "./cart.php";?>

    <main id="billboard">
        <div class="position-relative">
          <div class="container">
            <div class="centered-content">
              <img src="imagens/logo_cinz.png" alt="Logo Crialme">
            </div>
          </div>
        </div>
      </main>      

    <section id="collection">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-lg-6 ps-lg-0">
                    <div class="position-relative img-fluid"
                        style=" background: url(imagens/women.jpg);background-size: cover; background-repeat: no-repeat; background-position: center; height: 100vh;">
                        <div class="text position-absolute text-center m-auto w-100 top-50">
                            <h3 class="display-2 text-white mb-3">WOMEN</h3>
                            <div>
                                    <!-- PRODUTOS MULHER -->
                                <a href="products3.php" class="btn btn-light">SHOP COLLECTION </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0">
                    <div class="position-relative img-fluid"
                        style="background: url(imagens/men.jpg);background-size: cover; background-repeat: no-repeat; background-position: center; height: 100vh;">
                        <div class="text position-absolute text-center m-auto w-100 top-50">
                            <h3 class="display-2 text-white mb-3">MEN</h3>
                            <div>
                                <!-- PRODUTOS HOMEM -->
                                <a href="products2.php" class="btn btn-light">SHOP COLLECTION </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="subscribe" class="padding-medium">
        <div class="container">
            <h3 class="display-1 text-center mb-5 text-muted opacity-25 ">SUBSCRIBE US</h3>
            <div class="offset-lg-3 col-lg-6">
                <form>
                    <div class="input-group">
                        <input type="email" class="form-control rounded-0 border-black"
                            placeholder="Write your email address here...">
                        <span class="input-group-btn">
                            <button class="btn btn-dark rounded-0 px-5" type="submit">Subscribe</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="footer" class="bg-black text-white">
        <style>
            .logo img {
            width: 200px; /* Aumenta o tamanho do logotipo */
            height: auto;
            }
        </style>
        <div class="container padding-medium">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="logo" >
                        <a href="index.php">
                            <img src="imagens/logo_original.png" alt="logo">
                        </a> 
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <nav>
                        <ul class="list-unstyled">
                            <li class="nav-item mb-2">
                                <a class="nav-link nav-link-ltr" href="about-us.php">ABOUT</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link nav-link-ltr" href="products.php">PRODUCTS</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link nav-link-ltr" href="contacts.php">CONTACTS</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <nav>
                        <ul class="list-unstyled">
                            <li class="nav-item mb-2"><a class="nav-link nav-link-ltr" href="https://www.facebook.com/profile.php?id=100045189715035">FACEBOOK</a></li>
                            <li class="nav-item mb-2"><a class="nav-link nav-link-ltr" href="https://www.instagram.com/crialme/">INSTAGRAM</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    Do you have any queries?<br>
                    <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=new" class="text-decoration-underline text-white">gera@crialme.pt</a> <br>
                    If you need support? Give us a call. <br>
                    (+351) 255 868 200
                </div>
            </div>
        </div>
        <hr>
        <div class="copyright text-center">
            <p class="m-0 pb-3">Crialme © 2016
        </div>
    </section>

    <!-- Video Popup -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg class="bi"
                            width="40" height="40">
                            <use xlink:href="#close-sharp"></use>
                        </svg></button>
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <!-- Seta animada -->
    <div class="scroll-indicator">
        <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
            <use xlink:href="#down"></use>
        </svg>
    </div>
</body>

</html>

