<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Middle Section3(vBio Apps)</h1>
    <div class="col-auto">
        <a href="<?php echo SITE_URL.'admin/pagesections/addNewApp' ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>Add New</a>
    </div>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            <div class="row">
                <div class="col-sm-12 col-md-12" style="margin-bottom: 10px; border-bottom: 2px solid;padding-bottom: 10px;">
                    
                        
                   
                    <h2>Section Image</h2> 
                    <form  action="<?php echo url('admin/pagesections/saveImage'); ?>" method="post" role="form" enctype="multipart/form-data">
                   <?php if($data->vbio_image !=NULL){ ?>
                        <img style="margin-bottom:10px;" src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->vbio_image->image_name; ?>" alt="No Image" height="100" width="100">
                        <div class="form-group">
                        <label>Select Image to Update</label>
                    <input type="hidden" name="action" value="edit">
                   <?php } else{?>
                     <label>Select Image</label>
                     <input type="hidden" name="action" value="new">
                     
                   <?php }?> 
                      <input type="hidden" name="section_name" value="Middle_Three">
                      <input type="file" name="file" class="form-control-file" required="">
                        </div>
                     <input type="submit" name="btnSubmit" value="Upload Image" class="btn btn-info" style="margin-top: 10px;">
                    </form>
                </div> 
            </div>
            <div class="row">
             <div class="col-sm-12 col-md-12">
                 <h2>Contents</h2>
                 <table class="table table-custom dataTable no-footer table-bordered table-striped">
                     <thead class="thead-black">
                     <th>App Title</th> 
                      <th>Short Description</th>
                      <th>Status</th>
                      <th>Action</th>
                     </thead> 
                     <tbody>
                           <?php while($row = $data->vbio_apps->fetch_object()): ?>
                         <tr>
                             <td><?= $row->app_title; ?> </td> 
                            <td><?= $row->app_short_description; ?></td> 
                          <td><?= $row->app_status==1?"Active":"Not Active"; ?> </td> 
                             <td>
                                 
                                 <a href="<?php echo SITE_URL.'admin/pagesections'.'/editMiddleThree/'.$row->app_id; ?>"><i class="fa fa-eye"></i></a> |
                                <a href="<?php echo SITE_URL.'admin/pagesections'.'/deleteApp/'.$row->app_id; ?>"><i class="fa fa-trash"></i></a> 
                               
                             </td> 
                         </tr>
                           <?php endwhile ?>
                        
                     </tbody>
                 </table>
            </div>

             
            </div>

            
      

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
