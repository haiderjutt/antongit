<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Add New Feature
     <a href="<?php echo SITE_URL.'admin/features-section' ?>" class="btn btn-default">Go Back</a>
    </h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/features-section/savefeature'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input required="" value=""type="text" name="title" class="form-control form-control-lg" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Icon</label>
                        (<span style="font-size: 9px; color: red;">Please visit <a href="https://www.flaticon.com/" target="_blank">flaticon</a> icons to select icon</span>)
                        <input type="text" required="" value="" name="iconname" class="form-control form-control-lg" />
                    </div>
                </div>
                <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="pageContent" name="content" class="form-control form-control-lg"></textarea>
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
