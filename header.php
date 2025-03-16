
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo isset($description) ? $description : 'We redefine modest fashion as not just clothing but a statement of empowerment and sophistication'; ?>">
    <meta name="keywords" content="<?php echo isset($keyword1) ?  $keyword1 : 'Zain store boutique';?>, <?php echo isset($keyword2) ?  $keyword2 : 'Zain store boutique';?>, <?php echo isset($keyword3) ?  $keyword3 : 'Zain store boutique';?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zain Store Boutique">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($title) ?  $title : 'Zain store boutique';?></title>

    <meta property="og:title" content="<?php echo isset($title) ?  $title : 'Zain store boutique';?>">
    <meta property="og:description" content="<?php echo isset($description) ? $description : 'We redefine modest fashion as not just clothing but a statement of empowerment and sophistication';?>">
    <meta property="og:image" content="<?php echo isset($title_image) ? $title_image : 'logo.png';?>">
    <meta property="og:url" content="zainstoresboutique.com">
    <meta property="og:type" content="website"> <!-- can be "article", "video", etc., depending on your content -->
    <meta property="og:site_name" content="Zain Stores Boutique">
    <link rel="icon" type="icon/jpg" href="img/logo.png">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="shop-wishlist"><span class="icon_heart_alt"></span>
                <div class="tip"><?php echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0; ?></div>
            </a></li>
            <li><a href="shop-cart"><span class="icon_bag_alt"></span>
                <div class="tip"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index">
                <h2 style="font-family:Cookie; font-weight: bolder;">Zain Stores</h2>
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <?php
            if(!empty($_SESSION['user_id'])){
            ?>
            <a href="edit">Profile</a>
            <?php
            }else{
            ?>
            <a href="login">Login</a>
            <a href="register">Register</a>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header" style="position:fixed;top:0%;left:0;z-index: 100;width: 100%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index"> 
                            <h2 style="font-family:Cookie; font-weight: bolder;">Zain Stores</h2>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index">Home</a></li>
                            
                            <li><a href="#">Cloths</a>
                                <ul class="dropdown">
                                    <li><a href="./product-sort?sort=Dresses">Dresses</a></li>
                                    <li><a href="./product-sort?sort=Shorts">Shorts</a></li>
                                    <li><a href="./product-sort?sort=Overall">Overall</a></li>
                                    <li><a href="./product-sort?sort=Jackets">Jackets</a></li>
                                    <li><a href="./product-sort?sort=Tops">Tops</a></li>
                                    <li><a href="./product-sort?sort=Bottoms">Bottoms</a></li>
                                    <li><a href="./product-sorts?sort=Bubu">Bubu</a></li>
                                </ul>
                            </li>
                            <li><a href="./product-sort?sort=Accessories">Accessory</a></li>
                            <li><a href="./shop">Shop</a></li>
                            <li><a href="#">Category</a>
                                <ul class="dropdown">
                                    <li><a href="./product-sort?sort=Traditional Attires">Traditional Attires</a></li>
                                    <li><a href="./product-sort?sort=Traditional Attires">Abaya</a></li>
                                    <li><a href="./product-sort?sort=Corporate/Formal Wears">Corporate/Formal Wears</a></li>
                                    <li><a href="./product-sort?sort=Summer Wears">Summer Wears</a></li>
                                    <li><a href="./product-sort?sort=Denim/Jeans">Denim/Jeans</a></li>
                                    <li><a href="./product-sort?sort=Street Wears">Street Wears</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <?php
                            if(!empty($_SESSION['user_id'])){
                            ?>
                            <a href="edit">Profile</a>
                            <?php
                            }else{
                            ?>
                            <a href="login">Login</a>
                            <a href="register">Register</a>
                            <?php
                            }
                            ?>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                            <li>
                                <a href="shop-wishlist">
                                    <span class="icon_heart_alt"></span>
                                    <div class="tip">
                                        <?php echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0; ?>
                                    </div>
                                </a>
                            </li>

                            <li><a href="shop-cart"><span class="icon_bag_alt"></span>
                                <div class="tip"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></div>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header><br><br><br>