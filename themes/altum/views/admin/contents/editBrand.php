<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Add New Brand</h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/brands/updateBrand'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input required="" value="<?php echo $data->brandDetail->brand_title; ?>"type="text" name="title" class="form-control form-control-lg" />
                        <input type="hidden" name="brand_id" value="<?php echo $data->brandDetail->brand_id; ?>">
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Brand Logo</label>
                    <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->brandDetail->brand_logo; ?>"  width="140">
                    <input type="file" name="file" required=""class="form-control form-control-lg">
                   
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Brand Logo</label>
                    <select class="form-control form-control-lg" name="brand_status">
                        <option value="1" <?= $data->brandDetail->brand_status==1?"selected":"";?>>Active</option>
                         <option value="0" <?= $data->brandDetail->brand_status==0?"selected":"";?>>Disable</option>
                    </select>
                    </div>
                </div>
                <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="pageContent" name="description" class="form-control form-control-lg"><?php echo $data->brandDetail->brand_detail; ?></textarea>
                    </div>
                </div>
                 
            </div>

            <div class="mt-4">
                <input type="submit" name="btnsubmit" value="Save Feature" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script src="<?= SITE_URL . ASSETS_URL_PATH . 'js/libraries/tinymce/tinymce.min.js' ?>"></script>
<script>
    tinymce.init({
        selector: '#pageContent',
        plugins: 'code preview fullpage autolink directionality visualblocks visualchars fullscreen image link media codesample table hr pagebreak nonbreaking toc advlist lists imagetools',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent | removeformat code',
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
