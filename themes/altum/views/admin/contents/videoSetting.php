<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i> <?= $this->language->hero_section->contents ?></h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

        <form action="<?php echo url('admin/pagesections/saveVideSetting'); ?>" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <div class="row">
             <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input required="" value="<?=$data->video_setting!=NULL?$data->video_setting->video_title:"";?>"type="text" name="title" class="form-control form-control-lg" />
                        <input type="hidden" value="<?=$data->video_setting!=NULL?"edit":"new"; ?>" name="action">
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Small Heading</label>
                        <input type="text" required="" value="<?=$data->video_setting!=NULL?$data->video_setting->video_small_title:"";?>" name="small_title" class="form-control form-control-lg" />
                    </div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Link</label>
                        <input type="url" name="video_url" required="" value="<?=$data->video_setting!=NULL?$data->video_setting->video_link:"";?>" class="form-control form-control-lg" placeholder="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Video Section Background</label>
                         <img src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->video_setting->video_background; ?>" class="img-fluid" style="max-height: 2.5rem;height: 2.5rem;" />
                         <input type="file" name="file" value="" <?php if(!isset($data->video_setting->video_background)) {?>required=""<?php }?> class="form-control form-control-lg">
                    </div>
                </div>
                
            </div>

            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script src="<?= SITE_URL . ASSETS_URL_PATH . 'js/libraries/tinymce/tinymce.min.js' ?>"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'code preview fullpage autolink directionality visualblocks visualchars fullscreen image link media codesample table hr pagebreak nonbreaking toc advlist lists imagetools',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent | removeformat code',
    });

    $('[name="type"]').on('change', (event) => {

        let selectedOption = $(event.currentTarget).find(':selected').attr('value');

        switch(selectedOption) {

            case 'internal':

                $('#url_label').html(<?= json_encode($this->language->admin_pages->input->url_internal) ?>);
                $('#url_prepend').show();
                $('input[name="url"]').attr('placeholder', <?= json_encode($this->language->admin_pages->input->url_internal_placeholder) ?>);
                $('#description_container').show();

                break;

            case 'external':

                $('#url_label').html(<?= json_encode($this->language->admin_pages->input->url_external) ?>);
                $('#url_prepend').hide();
                $('input[name="url"]').attr('placeholder', <?= json_encode($this->language->admin_pages->input->url_external_placeholder) ?>);
                $('#description_container').hide();

                break;
        }

    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
