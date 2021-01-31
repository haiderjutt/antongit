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

    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details__main">
                        <div class="blog-details__image">
                            <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'blogs/' . $data->blog->blog_feature_image; ?>" alt="<?php echo $data->blog->blog_title; ?>">
                        </div><!-- /.blog-details__image -->
                        <div class="blog-details__content">
                            <div class="blog-one__meta">
                                <a href="#"><i class="fa fa-clock-o"></i><?php echo $data->blog->blog_created_on; ?></a>
                                <a href="#"><i class="fa fa-comments-o"></i> <?php echo $data->comments->num_rows;?> comments</a>
                            </div><!-- /.blog-one__meta -->
                            <h3><?php echo $data->blog->blog_title; ?></h3>
                           <?php echo $data->blog->blog_description; ?>
                        </div><!-- /.blog-details__content -->
                      
                    </div><!-- /.blog-details__main -->

                    <div class="blog-author">
                        <div class="blog-author__image">
                            <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/author.jpg';?>" alt="author" style="width:140px;">
                        </div><!-- /.blog-author__image -->
                        <div class="blog-author__content">
                            <h3><?php echo $data->blog->name;?></h3>
                            
                        </div><!-- /.blog-author__content -->
                    </div><!-- /.blog-author -->

                    <div class="comment-one">
                        <h3 class="comment-one__block-title"><?php echo $data->comments->num_rows;?> Comments</h3><!-- /.comment-one__block-title -->
                        <?php foreach ($data->comments as $comment){?>
                        <div class="comment-one__single">
                            <div class="comment-one__image">
                                <img src="<?= SITE_URL . ASSETS_URL_PATH . '/theme/images/comment-1-1.jpg';?>" alt="">
                            </div><!-- /.comment-one__image -->
                            <div class="comment-one__content">
                                <h3><?php echo $comment['name']; ?></h3>
                                <p class="comment-one__date"><?php echo $comment['comment_date']; ?></p>
                                <p><?php echo $comment['message']; ?></p>
                            </div><!-- /.comment-one__content -->
                           
                            <!-- /.thm-btn comment-one__btn -->
                        </div><!-- /.comment-one__single -->
                        <?php }?>
                     
                    </div><!-- /.comment-one -->
                    <div class="comment-form">
                        <h3 class="comment-one__block-title">Leave a Comment</h3><!-- /.comment-one__block-title -->
                        <form  action="<?php echo SITE_URL.'blogs/submitComment'; ?>" method="post" class="contact-one__form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <input type="text" placeholder="Your name" name="name" required="">
                                        <input type="hidden" name="blog_id" value="<?php echo $data->blog->blog_id; ?>">
                                    </div>
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <input type="email" placeholder="Email Address" name="email" required="">
                                    </div>
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <input type="text" placeholder="Phone number" name="number" required="">
                                    </div>
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <input type="text" placeholder="Subject" name="subject" required="">
                                    </div>
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <textarea placeholder="Write Message" name="message" required=""></textarea>
                                    </div>
                                </div><!-- /.col-lg-12 -->
                                <div class="col-lg-12 text-left">
                                    <div class="input-box">
                                        <button type="submit" class="main-btn">Submit Comment</button>
                                    </div>
                                    <!-- /.thm-btn contact-one__btn -->
                                </div><!-- /.col-lg-12 -->
                            </div><!-- /.row -->
                        </form><!-- /.contact-one__form -->
                    </div><!-- /.comment-form -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                       
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Latest Posts</h3><!-- /.sidebar__title -->
                            <div class="sidebar__post-wrap">
                                <?php foreach($data->latestBlogs as $latest){?>
                                 <div class="sidebar__post__single">
                                    <div class="sidebar__post-image">
                                        <div class="inner-block"><img src="<?= SITE_URL . UPLOADS_URL_PATH . 'blogs/' . $latest['blog_feature_image']; ?>"
                                                alt="<?php echo $latest['blog_title'];?>" /></div>
                                        <!-- /.inner-block -->
                                    </div><!-- /.sidebar__post-image -->
                                    <div class="sidebar__post-content">
                                        <h4 class="sidebar__post-title"><a href="<?php echo SITE_URL.'blogs/blog_detail/'.$latest['blog_id']; ?>"><?php echo $latest['blog_title'];?></a></h4>
                                        <!-- /.sidebar__post-title -->
                                    </div><!-- /.sidebar__post-content -->
                                </div><!-- /.sidebar__post__single -->
                                <?php }?>
                               
                            </div><!-- /.sidebar__post-wrap -->
                        </div><!-- /.sidebar__single -->
                        <div class="sidebar__single sidebar__category">
                            <h3 class="sidebar__title">Categories</h3><!-- /.sidebar__title -->
                            <ul class="sidebar__category-list">
                                <?php foreach ($data->categories as $category){ ?>
                                <li class="sidebar__category-list-item"><a href="<?php echo SITE_URL.'blogs/category'.'/'.$category['cat_title']; ?>"><?php echo $category['cat_title']; ?></a></li>
                                <?php }?>
                             </ul><!-- /.sidebar__category-list -->
                        </div><!-- /.sidebar__single -->
                      
                    </div><!-- /.sidebar -->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-details -->

    <!--====== FOOTER PART START ======-->