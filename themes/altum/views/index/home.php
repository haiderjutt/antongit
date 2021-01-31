   <!--====== BANNER PART START ======-->
   <section class="banner-area">
        <div class="container">
            <div class="banner-items">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="banner-content">
                            <h1 class="title"><?= $data->heroSection->hs_header;?></h1>
                            <p>
                                <?= $data->heroSection->hs_small_header;?>
                            </p>
                            <a class="main-btn" href="<?= $data->heroSection->hs_link;?>">Discover More</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="banner-thumb text-right wow fadeInUp" data-wow-duration="1500ms">
                            <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->heroSection->hs_image; ?>" alt="banner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-circle-1"></div>
        <div class="banner-circle-2"></div>
        <div class="banner-circle-3"></div>
        <div class="banner-circle-4"></div>
    </section>
    
    <!--====== BANNER PART ENDS ======-->

    <!--====== FEATURES PART START ======-->
    
    <section id="features" class="features-area pt-35">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section-title text-center">
                        
                        <h3 class="title">phpBiolinks.com Prodiving the Best Features</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="features-btn">
                        <ul class="nav nav-pills d-flex justify-content-between" id="pills-tab" role="tablist">
                            <?php $i=0; while($row = $data->features->fetch_object()): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($i==0){?>active<?php }?> text-center" id="pills-<?php echo $row->fe_id;?>-tab" data-toggle="pill" href="#pills-<?php echo $row->fe_id;?>" role="tab" aria-controls="pills-<?php echo $row->fe_id;?>" aria-selected="true">
                                    <i class="<?php echo $row->fe_icon;?>"><img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/features-shape.png';?>" alt="shape"></i>
                                    <span><?php echo $row->fe_title;?></span>
                                </a>
                            </li>
                              <?php $i++;
                              endwhile 
                              ?>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <?php $i=0; foreach($data->featuresDetail as $row2){
                                
                                ?>
                            <div class="tab-pane fade show <?php if($i==0){?>active<?php }?>" id="pills-<?php echo $row2['fe_id'];?>" role="tabpanel" aria-labelledby="pills-<?php echo $row2['fe_id'];?>-tab">
                                <i class="<?php echo $row2['fe_icon'];?>"></i>
                                <h4 class="title"><?php echo $row2['fe_title'];?></h4>
                                <p>
                                   <?php echo $row2['fe_description'];?>
                                </p>
                            </div>
                             <?php $i++;
                            } 
                              ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== FEATURES PART ENDS ======-->

    <!--====== ABOUT PART START ======-->
    
    <section class="about-area pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-thumb  wow fadeInLeft" data-wow-duration="1500ms">
<!--                        <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/about-thumb.png';?>" alt="">-->
                        <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->middleOneImage->image_name; ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span><?=$data->middleOneContents->sc_small_title?$data->middleOneContents->sc_small_title:""; ?></span>
                            <h3 class="title"><?=$data->middleOneContents->sc_title?$data->middleOneContents->sc_title:""; ?></h3>
                        </div>
                        <?=$data->middleOneContents->sc_text?$data->middleOneContents->sc_text:""; ?>
                        <a class="main-btn mt-50" href="#pricing">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-shape-1"></div>
        <div class="about-shape-3"></div>
        <div class="about-shape-2">
            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/about-shape.png';?>" alt="shape">
        </div>
    </section>
    
    <!--====== ABOUT PART ENDS ======-->

    <!--====== BRAND PART START ======-->
    
    <div class="brand-area pt-120 pb-120">
        <div class="container">
            <div class="row brand-active">
                <?php foreach ($data->brands as $brand) {?>
                 <div class="col-lg-3">
                    <div class="brand-item">
                        <a href="#"> <img style="max-height: 65px;" src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_title']; ?>" title="<?php echo $brand['brand_title'];?>">
                        </a>
                    </div>
                </div>
                <?php }?>
               
            </div>
        </div>
    </div>
    
    <!--====== BRAND PART ENDS ======-->

    <!--====== BUSINESS PART START ======-->
    
    <section class="business-area pt-110 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="business-content">
                        <div class="section-title">
                            <span><?=$data->section_contents->sc_small_title?$data->section_contents->sc_small_title:""; ?></span>
                            <h3 class="title"><?=$data->section_contents->sc_title?$data->section_contents->sc_title:""; ?></h3>
                           
                        </div>
                        <div class="row mr-110">
                            <?php
                            foreach($data->vbio_features as $mini){
                            ?>
                            <div class="col-sm-4">
                                <div class="business-item">
                                    <?php  if($mini['mf_title']=="QR Code"){?>
                                    <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/qrcode.png'; ?>" height="50"><br>
                                    <?php }?>
                                     <?php  if($mini['mf_title']=="Emoji"){?>
                                    <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/emoji.png'; ?>" height="50"><br>
                                    <?php }?>
                                     <?php  if($mini['mf_title']=="phpBiolinks.com Pay"){?>
                                    <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/vbiopay.png'; ?>" height="50"><br>
                                    <?php }?>
                                    <span>
                                       <?php echo $mini['mf_title']; ?> 
                                    </span>
                                </div>
                            </div>
                            <?php }?>
<!--                            <div class="col-sm-4">
                                <div class="business-item item-2">
                                    <i class="flaticon-people"></i><br>
                                    <span>New Online <br> Marketing</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="business-item item-3">
                                    <i class="flaticon-human-resources"></i><br>
                                    <span>Top Consumer <br> Products</span>
                                </div>
                            </div>-->
                        </div>
                       <?=$data->section_contents->sc_text?$data->section_contents->sc_text:""; ?>
                           <a class="main-btn" href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="business-thumb text-right">
            <?php if(isset($data->vbio_image->image_name)) {?>
            <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/'.$data->vbio_image->image_name;?>" alt="">
            <?php } else {?>
            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/business-thumb.jpg';?>" alt="">                             
            <?php }?>
           
        </div>
        <div class="business-shape"></div>
    </section>
    
    <!--====== BUSINESS PART ENDS ======-->

    <!--====== CUSTOMERS PART START ======-->
    
    <section class="customers-area pt-120 pb-120" >
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="customers-thumb wow fadeInLeft" data-wow-duration="1500ms">
                        
<!--                        <img src="<?= SITE_URL . ASSETS_URL_PATH . 'theme/images/customers-thumb.png';?>" alt="customers">-->
                     <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->middleThreeImage->image_name; ?>" alt="customers">
                  
                    </div>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="section-title">
                        <span>We do more for your world</span>
                        <h3 class="title">Discover tools at phpBiolinks.com</h3>
                    </div>
                    <div class="customers-content">
                        <?php foreach ($data->vbio_apps as $fea){ ?>
                         <div class="mt-35">
                             <p class="item">
                               <?php  echo $fea['app_short_description']; ?>.
                            </p>
                        </div>
                        <?php } ?>
                       <div class="item">
                             <a class="main-btn mt-50" href="#pricing">Discover More</a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="customers-shape text-right">
            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/customers-shape.png';?>" alt="shape">
        </div>
        <div class="customers-shape-1"></div>
    </section>
    
    <!--====== CUSTOMERS PART ENDS ======-->

    <!--====== VIDEO PLAY PART START ======-->
    
    <div style="display:none;" class="video-play-area bg_cover" style="background-image: url(<?php if(isset($data->videoSetting)){
        echo SITE_URL . UPLOADS_URL_PATH . '/images/'.$data->videoSetting->video_background;
    }else{
        echo SITE_URL . ASSETS_URL_PATH . '/theme/images/video-play-bg.jpg';
    }?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-play-item text-center">
                        <a class="video-popup" href="<?php echo $data->videoSetting->video_link; ?>"><i class="fa fa-play"></i></a>
                        <p>
                        <?php echo $data->videoSetting->video_small_title; ?>
                        </p>
                        <h4 class="title">
                           <?php echo $data->videoSetting->video_title; ?> 
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--====== VIDEO PLAY PART ENDS ======-->

    <!--====== PRICING PART START ======-->
    
    <section id="pricing" class="pricing-one pb-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <span>Select what suits you</span>
                        <h3 class="title">Choose Your Pricing Plan</h3>
                    </div>
                    <ul class="list-inline text-center switch-toggler-list" role="tablist" id="switch-toggle-tab">
                        <li class="month active"><a href="#">Monthly</a></li>
                        <li>
                            <!-- Rounded switch -->
                            <label class="switch on">
                                <span class="slider round"></span>
                            </label>
                        </li>
                        <li class="year"><a href="#">Annualy</a></li>
                    </ul><!-- /.list-inline -->
                </div>
            </div>
            <div class="tabed-content">
                <div id="month">
                    <div class="row justify-content-center">
                        <?php $i=0;foreach ($data->packages as $pack){?>
                             <div class="col-lg-4 col-md-7 animated fadeInLeft">
                            <div class="pricing-one__single">
                                <div class="pricing-one__inner">
                                    <i class="flaticon-send"></i>
                                    <p><?php echo $pack['name']; ?></p>
                                    <h3>$<?php echo $pack['monthly_price']; ?></h3>
                                    <div class="overlay">
                                        <ul class="list-unstyled pricing-one__list" style="text-align:left;padding-left: 10px;">
                                            <?php
                                            $features = json_decode($pack['settings']);
                                            foreach($features as $key=>$value)
                                            {?>
                                            <?php if($value==1)
                                                    {?>
                                                 <li><i class="fa fa-check"></i> 
                                                     <span style="text-transform:capitalize;"> <?php 
                                                    echo str_replace("_"," ",$key);
                                                      ?>
                                                     </span>
                                                 </li>
                                                 <?php  } else{ ?>
                                                  <li><i class="fa fa-remove"></i> 
                                                    <span  style="text-transform:capitalize;"> <?php 
                                                    echo str_replace("_"," ",$key);
                                                      ?>
                                                     </span>
                                                 </li>
                                                 <?php }?>
                                            <?php }?>
                                          
                                           
                                        </ul><!-- /.list-unstyled pricing-one__list -->
                                        <a class="main-btn" href="#"><span>Choose Plan</span></a>
                                    </div>
                                    <!-- /.thm-btn -->
                                </div><!-- /.pricing-one__inner -->
                            </div><!-- /.pricing-one__single -->
                        </div>
                        
                        <?php $i++;}?>
                  
                    </div><!-- /.row -->
                </div><!-- /#month -->
                <div id="year">
                    <div class="row justify-content-center">
                       <?php $i=0;foreach ($data->packages as $pack){?>
                             <div class="col-lg-4 col-md-7 animated fadeInLeft">
                            <div class="pricing-one__single">
                                <div class="pricing-one__inner">
                                    <i class="flaticon-send"></i>
                                    <p><?php echo $pack['name']; ?></p>
                                    <h3>$<?php echo $pack['monthly_price']*10; ?></h3>
                                    <div class="overlay">
                                        <ul class="list-unstyled pricing-one__list" style="text-align:left;padding-left: 10px;">
                                            <?php
                                            $features = json_decode($pack['settings']);
                                            foreach($features as $key=>$value)
                                            {?>
                                           <?php if($value==1)
                                                    {?>
                                                 <li><i class="fa fa-check"></i> 
                                                     <span style="text-transform:capitalize;"> <?php 
                                                    echo str_replace("_"," ",$key);
                                                      ?>
                                                     </span>
                                                 </li>
                                                 <?php  } else{ ?>
                                                  <li><i class="fa fa-remove"></i> 
                                                    <span  style="text-transform:capitalize;"> <?php 
                                                    echo str_replace("_"," ",$key);
                                                      ?>
                                                     </span>
                                                 </li>
                                                 <?php }?>
                                            <?php }?>
                                          
                                           
                                        </ul><!-- /.list-unstyled pricing-one__list -->
                                        <a class="main-btn" href="#"><span>Choose Plan</span></a>
                                    </div>
                                    <!-- /.thm-btn -->
                                </div><!-- /.pricing-one__inner -->
                            </div><!-- /.pricing-one__single -->
                        </div>
                        
                        <?php $i++;}?>
                    </div><!-- /.row -->
                </div><!-- /#year -->
            </div><!-- /.tabed-content -->
        </div>
    </section>
    
    <!--====== PRICING PART ENDS ======-->

    <!--====== TESTIMONIALS PART START ======-->
    
    <section id="testimonials" class="testimonials-area bg_cover pt-120 pb-120" style="display:none;background-image: url(<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/testimonials-bg.jpg';?>);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-9">
                    <div class="testimonials-user-item">
                        <div class="testimonials-thumb pl-110">
                              <?php foreach ($data->testimonials as $profile){?>
                              <div class="item">
                                  <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/'.$profile['client_profile'];?>" alt="Testimonials" height="230" width="230">
                            </div>
                               <?php }?>
                           
                        </div>
                        <div class="testimonials-user">
                             <?php $i=1;foreach ($data->testimonials as $profile){?>
                              <div class="item-<?php echo $i;?>">
                                  <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/'.$profile['client_profile'];?>" alt="Testimonials" height="72" width="71">
                            </div>
                               <?php $i++;}?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonials-content-slide">
                        <?php foreach ($data->testimonials as $test){?>
                          <div class="testimonials-content">
                            <span>Our Testimonials</span>
                            <h3 class="title">What They Are Talking</h3>
                            <p>
                                <?php echo  $test['client_message'];?>
                            </p>
                            <div class="info">
                                <span><?php echo  $test['client_name'];?></span>
                                <p> <?php echo  $test['client_desig'];?> -  <?php echo  $test['client_company'];?></p>
                            </div>
                        </div>
                        <?php }?>
                      
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonials-shape">
            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/testimonials-shape.png';?>" alt="">
        </div>
        <div class="testimonials-map">
            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/testimonials-map.png';?>" alt="">
        </div>
        <div class="testimonials-circle-1"></div>
        <div class="testimonials-circle-2"></div>
    </section>
    
    <!--====== TESTIMONIALS PART ENDS ======-->

    <!--====== SEREENSHOT PART START ======-->
    
    <section id="screens" class="screenshot-area pb-120 pt-110">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <span>Look Before Choosing</span>
                        <h3 class="title">Checkout Our App Interface</h3>
                    </div>
                </div>
            </div>
            <div class="row screenshot-active">
               
                <?php foreach ($data->interFace as $inter){?>
                 <div class="col-lg-3">
                    <div class="screenshot-item">
                        <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'slider/' . $inter['int_image_name']; ?>" alt="">
                    </div>
                </div>
               
                <?php }?>
               
                
               
            </div>
        </div>
    </section>
    
    <!--====== SEREENSHOT PART ENDS ======-->

    <!--====== FAQ PART START ======-->
    
    <section class="faq-area pb-70 pt-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="faq-content">
                        <span><?php echo $data->faq_contents->sc_small_title; ?></span>
                        <h3 class="title"><?php echo $data->faq_contents->sc_title; ?></h3>
                       <?php echo $data->faq_contents->sc_text; ?>
                        <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/'.$data->faqimage->image_name;?>" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="faq-accordion wow fadeInRight" data-wow-duration="1500ms">
                        <div class="accrodion-grp wow fadeIn" data-wow-duration="1500ms" data-grp-name="faq-accrodion">
                            <?php $i =0; foreach ($data->faqs as $faq){?>
                              <div class="accrodion <?= $i==0?"active":"";?> ">
                                <div class="accrodion-inner">
                                    <div class="accrodion-title">
                                        <h4><?php echo $faq['faq_title']; ?></h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                         
                                           <?php echo $faq['faq_answer']; ?>     
                                         
                                        </div><!-- /.inner -->
                                    </div>
                                </div><!-- /.accrodion-inner -->
                            </div>
                                <?php $i++;}?>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== FAQ PART ENDS ======-->

    <!--====== COUNTER PART START ======-->
    
    <section class="counter-area pb-120" style="display:none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item text-center mt-30 wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="0ms">
                        <h3 class="title odometer" data-count="7024">00</h3>
                        <span>Downloads</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item text-center mt-30 item-2 wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="100ms">
                        <h3 class="title odometer"  data-count="6020">00</h3>
                        <span>App Likes</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item text-center mt-30 item-3 wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="200ms">
                        <h3 class="title odometer"  data-count="360">00</h3>
                        <span>5 Star odometer</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item text-center mt-30 item-4 wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <h3 class="title odometer"  data-count="200">00</h3>
                        <span>app awards</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== COUNTER PART ENDS ======-->

    <!--====== BLOG PART START ======-->
    
    <section id="news" class="blog-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <span>News & Articles</span>
                        <h3 class="title">From the Blog Posts</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php foreach($data->blogs as $blog ){?>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="blog-item mt-30">
                        <div class="blog-thumb">
                            <img style="min-height: 243px;" src="<?= SITE_URL . UPLOADS_URL_PATH . 'blogs/' . $blog['blog_feature_image']; ?>" alt="blog">
                        </div>
                        <div class="blog-content">
                            <ul>
                                <li><a href="#"><i class="fa fa-clock-o"></i>  <?php echo $blog['blog_created_on'];?></a></li>
                                <li><a href="#"><i class="fa fa-comments-o"></i> <?php 
                                    $id = $blog['blog_id'];
                                     $query = Altum\Database\Database::$database->query("SELECT * FROM `comments` where `comment_on`='{$id}'");
                                    echo $query->num_rows;
                                     ?> Comments</a></li>
                            </ul>
                            <h4 class="title"><a href="<?php echo SITE_URL.'blogs/blog_detail/'.$blog['blog_id']; ?>"><?php echo $blog['blog_title']; ?></a></h4>
                            <a href="<?php echo SITE_URL.'blogs/blog_detail/'.$blog['blog_id']; ?>"><i class="flaticon-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php }?>
               
            </div>
        </div>
    </section>
    
    <!--====== BLOG PART ENDS ======-->
