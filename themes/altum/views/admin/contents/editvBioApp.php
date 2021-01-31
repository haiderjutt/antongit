<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Add New App</h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">
        <pre>
      
    </pre>
        <form action="<?php echo url('admin/pagesections/updatevBioApp'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>App Name</label>
                        <input required="" value="<?= $data->vbio_app->app_title;?>" type="text" name="title" class="form-control form-control-lg" />
                        <input  value="<?= $data->vbio_app->app_id;?>"type="hidden" name="app_id" class="form-control form-control-lg" />
                  
                    </div>
                </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>One Line Description</label>
                        <input required="" value="<?= $data->vbio_app->app_short_description;?>"type="text" name="desc" class="form-control form-control-lg" />
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="app_status" class="form-control form-control-lg">
                            <option value="1" <?= $data->vbio_app->app_status==1?"selected":"";?>>Active</option>
                            <option value="0" <?= $data->vbio_app->app_status==0?"selected":"";?>>Disabled</option>
                        </select>
                        </div>
                </div>
            </div>

            <div class="mt-4">
                <input type="submit" name="btnsubmit" value="Update App" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script src="<?= SITE_URL . ASSETS_URL_PATH . 'js/libraries/tinymce/tinymce.min.js' ?>"></script>
<script>
     
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
