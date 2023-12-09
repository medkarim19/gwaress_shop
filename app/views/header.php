<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Gwaress</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/css/price-range.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<header id="header">
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="index.php"><img src="assets/images/home/logo.jpg" alt="" class="img-fluid" /></a>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <li class="nav-item"><a href='#'><?php echo $_SESSION['user_name']; ?></a></li>
                                <li class="nav-item"><a href="index.php?page=cart" class="nav-link"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li class="nav-item"><a href="index.php?page=logout" class="nav-link"><i class="fa fa-lock"></i> Logout</a></li>
                            <?php else : ?>
                                <li class="nav-item <?php echo ($currentPage === 'login') ? 'active' : ''; ?>"><a href="index.php?page=login" class="nav-link"><i class="fa fa-lock"></i> Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li class="nav-item <?php echo ($currentPage === 'home') ? 'active' : ''; ?>"><a href="index.php?page=home" class="nav-link">Home</a></li>
                            <li class="nav-item <?php echo ($currentPage === 'menshop') ? 'active' : ''; ?>"><a href="index.php?page=menshop" class="nav-link">Men</a></li>
                            <li class="nav-item <?php echo ($currentPage === 'womenshop') ? 'active' : ''; ?>"><a href="index.php?page=womenshop" class="nav-link">Women</a></li>
                            <li class="nav-item <?php echo ($currentPage === 'contact') ? 'active' : ''; ?>"><a href="index.php?page=contact" class="nav-link">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
