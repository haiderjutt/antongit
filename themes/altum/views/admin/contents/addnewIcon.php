<?php defined('ALTUMCODE') || die() ?>
<link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . '/theme/css/flaticon.css';?>">
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Add New Category
     <a href="<?php echo SITE_URL.'admin/flat_icons' ?>" class="btn btn-default">Go Back</a>
    </h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/flat_icons/saveIcons'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label> <i class="flaticon-clock"></i>Icon Class</label>
                        <input required="" value=""type="text" name="title" class="form-control form-control-lg" />
                    </div>
                </div>
                 
            </div>

            <div class="mt-4">
                <input type="submit" name="btnsubmit" value="Save Icon" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script src="<?= SITE_URL . ASSETS_URL_PATH . 'js/libraries/tinymce/tinymce.min.js' ?>"></script>
<script>
     
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
