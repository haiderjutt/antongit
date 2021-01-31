<?php defined('ALTUMCODE') || die() ?>
<!doctype html>
<html lang="<?= $this->language->language_code ?>">

<head>
   
    <!--====== Required meta tags ======-->
     <base href="<?= SITE_URL; ?>">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="content-language" content="<?= $this->language->language_code ?>" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title><?= \Altum\Title::get() ?></title>
    
    <!--====== Favicon Icon ======-->
    <?php if(!empty($this->settings->favicon)): ?>
            <link href="<?= SITE_URL . UPLOADS_URL_PATH . 'favicon/' . $this->settings->favicon ?>" rel="shortcut icon" />
        <?php endif ?>

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/bootstrap.min.css';?>">
    
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/font-awesome.min.css';?>">
    
    <!--====== flaticon css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/flaticon.css';?>">
    
    <!--====== odometer css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/odometer.min.css';?>">
    
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/magnific-popup.css';?>">
    
    <!--====== animate css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/animate.min.css';?>">
    
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/slick.css';?>">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/default.css';?>">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/style.css';?>">
  
  
</head>

<body>

    <!-- PRELOADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END PRELOADER -->
   
    <!--====== side menu PART START ======-->

    <div class="side-menu__block">
        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">

                <a href="#" class="side-menu__toggler side-menu__close-btn"><img src=" <?= SITE_URL . ASSETS_URL_PATH . '/theme/images/close.png';?>" alt=""></a>
            </div><!-- /.side-menu__top -->


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
            <div class="side-menu__content">
                <p>Manage and create your biolinks with phpBiolinks.com.</p>
                <p><a href="mailto:aegitalgroup@gmail.com"></a> <br> </p>
                <div class="side-menu__social">
                    <a href="#"><i class="fa fa-facebook-square"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                </div>
            </div><!-- /.side-menu__content -->
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->

    <!--====== side menu PART ends ======-->

    <!--====== HEADER PART START ======-->
    
    <header id="home" class="header-area header-v1-area">
        <div class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navigation">
                            <nav class="navbar navbar-expand-lg navbar-light ">
                                <a class="navbar-brand" href="<?= SITE_URL; ?>">phpBioLinks.com</a> <!-- logo -->
                                <a class="navbar-brand-2" href="<?= SITE_URL; ?>">phpBioLinks.com</a> <!-- logo -->
                                <span class="side-menu__toggler"><i class="fa fa-bars"></i></span><!-- /.side-menu__toggler -->
                                                                  
                                <div class="collapse navbar-collapse sub-menu-bar main-nav__main-navigation" id="navbarSupportedContent">
                                    <ul class="navbar-nav m-auto main-nav__navigation-box">
                                        <li class="nav-item active">
                                            <a class="nav-link page-scroll" href="#home">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="#features">Features</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="#pricing">Pricing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="#testimonials">Testimonials</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="#screens">Screens</a>
                                        </li>
                                       
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="<?php echo SITE_URL.'blogs' ?>">Blogs</a>
                                            
                                        </li>
                                         <?php if(\Altum\Middlewares\Authentication::check()): ?>
                                        <li class="nav-item">
                                        <a class="nav-link page-scroll" href="<?= url('dashboard') ?>"> <?= $this->language->dashboard->menu ?></a>
                                        </li>
                                         <li class="nav-item dropdown">
                                            <a class="nav-link page-scroll" href="#">
                                                 <?= $this->user->name ?> <span class="caret"></span>
                                                
                                            </a>
                                            <ul class="sub-menu">
                                                 <?php if(\Altum\Middlewares\Authentication::is_admin()): ?>
                                                <li><a href="<?= url('admin') ?>"><?= $this->language->global->menu->admin ?></a></li>
                                                  <?php endif ?>
                                                
                                                <li><a href="<?= url('account') ?>"><?= $this->language->account->menu ?></a></li>
                                                 <?php if($this->settings->links->domains_is_enabled): ?>
                                                     <li><a href="<?= url('domains') ?>"><?= $this->language->domains->menu ?></a></li>
                                                <?php endif ?>
                                                <li><a href="<?= url('account-package') ?>"><?= $this->language->account_package->menu ?></a></li>
                                                 <li><a href="<?= url('account-payments') ?>"><?= $this->language->account_payments->menu ?></a></li>
                                                  <li><a href="<?= url('account-logs') ?>"><?= $this->language->account_logs->menu ?></a></li>
                                                   <li><a href="<?= url('logout') ?>"><?= $this->language->global->menu->logout ?></a></li>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="<?= url('login') ?>"><?= $this->language->login->menu ?></a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link page-scroll" href="<?= url('register') ?>"><?= $this->language->register->menu ?></a>
                                        </li>
                                        <?php endif ?>
                                    </ul>
                                </div> <!-- navbar collapse -->
                               
                            </nav>
                        </div> <!-- navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!--====== HEADER PART ENDS ======-->
                                                                  
  <?= $this->views['content'] ?>
    <!--====== FOOTER PART START ======-->
    
    <section class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-download d-block d-lg-flex justify-content-between align-items-center wow fadeInUp" data-wow-duration="1500ms">
                        <div class="item">
                            <h3 class="title">phpBiolinks.com</h3>
                            <p>Get Start to create multiple biolinks</p>
                        </div>
                        <div class="link">
                            <a class="main-btn" href="#">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="footer-widget footer-widget-about">
                        <a href="#">phpBiolinks.com</a>
                        <p>Create Your multiple Biolinks</p>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget footer-widget-list">
                        <div class="list-item d-flex">
                            <div class="item mr-100">
                                <p>© copyright <?php echo date('Y');?> by phpBiolinks.com</p> 
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-9">
                     <div class="list-item d-flex">
                      <div class="item">
                        <ul>
                             <?php
                              //$pages = Database::$database->query("SELECT * FROM `pages`");
                              $query = Altum\Database\Database::$database->query("SELECT * FROM `pages`");
                                   
                             foreach($query as $q){ ?>
                            <li><a href="<?= $q['url']; ?>" target="<?= $q['target']; ?>"><?= $q['title']; ?></a></li>
                             <?php } ?>
                                </ul> 
                            </div> 
                        </div>
                   
                </div>
            </div>
        
        </div>
    </section>
    
    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== GO TO TOP PART START ======-->
    
    <div class="go-top-area">
        <div class="go-top-wrap">
            <div class="go-top-btn-wrap">
                <div class="go-top go-top-btn">
                    <i class="fa fa-angle-double-up"></i>
                    <i class="fa fa-angle-double-up"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!--====== GO TO TOP PART ENDS ======-->
    
    
    





    <!--====== jquery js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/vendor/modernizr-3.6.0.min.js';?>"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/vendor/jquery-3.5.0.js';?>"></script>

    <!--====== Bootstrap js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/popper.min.js';?>"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/bootstrap.min.js';?>"></script>
    
    <!--====== Slick js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/slick.min.js';?>"></script>
    
    <!--====== wow js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/wow.js';?>"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/scrolling-nav.js';?>"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/jquery.easing.min.js';?>"></script>
    
    <!--====== odometer js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/odometer.min.js';?>"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/jquery.appear.min.js';?>"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/jquery.magnific-popup.min.js';?>"></script>
    
    <!--====== Main js ======-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/js/main.js';?>"></script>

</body>

</html>
