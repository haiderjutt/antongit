<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Update Testimonial</h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/testimonials/updateTestimonial'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Client Name</label>
                        <input required="" value="<?php echo $data->testimonialsDetail->client_name; ?>"type="text" name="name" class="form-control form-control-lg" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Company</label>
                    <input type="text" value="<?php echo $data->testimonialsDetail->client_company; ?>" name="company" required=""class="form-control form-control-lg">
                   
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Designation</label>
                    <input type="text" value="<?php echo $data->testimonialsDetail->client_desig; ?>" name="designation" required=""class="form-control form-control-lg">
                    <input type="hidden" value="<?php echo $data->testimonialsDetail->test_id; ?>" name="test_id" required=""class="form-control form-control-lg">
                   
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      
                    <label>Status</label>
                    <select name="status" class="form-control form-control-lg">
                        <option value="1"  <?= $data->testimonialsDetail->status==1?"selected":"";?>>Active</option>
                          <option value="0" <?= $data->testimonialsDetail->status==0?"selected":"";?>>Disable</option>
                    </select>
                    </div>
                </div>
                <div id="description_container" class="col-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="pageContent" name="description" class="form-control form-control-lg"><?php echo $data->testimonialsDetail->client_message; ?></textarea>
                    </div>
                </div>
                 
            </div>

            <div class="mt-4">
                <input type="submit" name="btnsubmit" value="Update Testimonials" class="btn btn-primary">
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
