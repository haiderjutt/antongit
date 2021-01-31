                                                               
    <!--====== PAGE TITLE PART START ======-->
    
    <div class="page-title-area bg_cover" style="background-image: url(<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/page-bg.png';?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                        <h3 class="title">Blog Page</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--====== PAGE TITLE PART ENDS ======-->

    <!--====== BLOG PART START ======-->
    
    <section id="news" class="blog-area blog-page">
        <div class="container">
            <div class="row justify-content-center">
                 <?php foreach($data->blogs as $blog ){?>
              <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="blog-item mt-30">
                        <div class="blog-thumb">
                            <img style="min-height: 243px;" src="<?= SITE_URL . UPLOADS_URL_PATH . 'blogs/' . $blog['blog_feature_image']; ?>" alt="blog">
                        </div>
                        <div class="blog-content">
                            <ul>
                                <li><a href="#"><i class="fa fa-clock-o"></i> <?php echo $blog['blog_created_on'];?></a></li>
                                <li><a href="#"><i class="fa fa-comments-o"></i> 
                                    <?php 
                                    $id = $blog['blog_id'];
                                     $query = Altum\Database\Database::$database->query("SELECT * FROM `comments` where `comment_on`='{$id}'");
                                    echo $query->num_rows;
                                     ?>
                                    comments
                                    </a></li>
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
    