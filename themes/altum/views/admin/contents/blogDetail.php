<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Update Blog</h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/blogs/updateBlog'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Blog Title</label>
                        <input required="" value="<?= $data->blog->blog_title;?>"type="text" name="title" class="form-control form-control-lg" />
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Seo Title</label>
                        <input required="" value="<?= $data->blog->blog_seo_title;?>"type="text" name="seotitle" class="form-control form-control-lg" />
                    </div>
                </div>
                 
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Blog Category</label>
                    <select name="category" class="form-control form-control-lg">
                        <option>Please Select</option>
                        <option value="Videos">Videos</option>
                    </select>
                   
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Blog Feature Image</label>
                        <input required="" type="file" name="file" class="form-control form-control-lg"/>
                    </div>
                </div>
                <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="pageContent" name="description" class="form-control form-control-lg"><?= $data->blog->blog_description;?></textarea>
                    </div>
                </div>
                 <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Seo Kye Words</label>
                        <textarea id="pageContent3" name="seokeywords" class=" pageContent2 form-control form-control-lg"><?= $data->blog->blog_seo_keyword;?></textarea>
                    </div>
                </div>
                   <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Seo Description</label>
                        <textarea id="pageContent3" name="seodescription" class="pageContent2 form-control form-control-lg"><?= $data->blog->blog_seo_description;?></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <input type="submit" name="btnsubmit" value="Update Blog" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script src="<?= SITE_URL . ASSETS_URL_PATH . 'js/libraries/tinymce/tinymce.min.js' ?>"></script>
<script>
     tinymce.init({
        selector: '.pageContent2',
        plugins: 'code preview fullpage autolink directionality visualblocks visualchars fullscreen image link media codesample table hr pagebreak nonbreaking toc advlist lists imagetools',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent | removeformat code',
    });
    
    tinymce.init({
        selector: '#pageContent',
        plugins: 'code preview fullpage autolink directionality visualblocks visualchars fullscreen image link media codesample table hr pagebreak nonbreaking toc advlist lists imagetools',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent | removeformat code',
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
