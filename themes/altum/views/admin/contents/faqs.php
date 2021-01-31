<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>FAQS</h1>
    <div class="col-auto">
        <a href="<?php echo SITE_URL.'admin/faqs/addnew' ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>Add New Question</a>
    </div>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            <div class="row">
                <div class=" col-md-6" style="margin-bottom: 10px; border-bottom: 2px solid;padding-bottom: 10px;">
                    
                        
                   
                    <h2>FAQ Thumbnail</h2> 
                    <form  action="<?php echo url('admin/pagesections/saveImage'); ?>" method="post" role="form" enctype="multipart/form-data">
                     <div class="form-group">
                        <?php if($data->vbio_image !=NULL){ ?>
                        <img style="margin-bottom:10px;" src="<?= SITE_URL . UPLOADS_URL_PATH . 'images/' . $data->vbio_image->image_name; ?>" alt="No Image" height="100" width="100">
                      
                        <label>Select Image to Update</label>
                    <input type="hidden" name="action" value="edit">
                   <?php } else{?>
                     <label>Select Image</label>
                     <input type="hidden" name="action" value="new">
                     
                   <?php }?> 
                      <input type="hidden" name="section_name" value="Section_faq">
                      <input type="file" name="file" class="form-control-file" required="">
                        </div>
                        <div class="form-group">
                             <input type="submit" name="btnSubmit" value="Upload Image" class="btn btn-info" style="margin-top: 10px;">
                    </div>
                        
                     </form>
                </div> 
                 <div class=" col-md-6" style="margin-bottom: 10px; border-bottom: 2px solid;padding-bottom: 10px;">
                    
                        
                   
                    <h2>Section Contents</h2> 
                    <form  action="<?php echo url('admin/pagesections/sectionTowContents'); ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" value="<?= $data->section_contents->sc_title?$data->section_contents->sc_title:"";?>" name="title" class="form-control" required="">
                            <input type="hidden" name="section_name" value="Section_faq" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Section Small Title</label>
                            <input type="text" value="<?= $data->section_contents->sc_small_title?$data->section_contents->sc_small_title:"";?>" name="small_title" class="form-control" required=""> 
                            <?php if($data->section_contents !=NULL){?>
                            <input type="hidden" name="action" value="edit">
                            <?php } else{?>
                            <input type="hidden" name="action" value="new">
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>Section Small Title</label>
                            <textarea id="content" name="content" class="form-control form-control-lg"><?= $data->section_contents->sc_text?$data->section_contents->sc_text:"";?></textarea>
                    
                        </div>
                        <div class="form-group">
                             <input type="submit" name="btnSubmit" value="Save" class="btn btn-info" style="margin-top: 10px;">
                    
                        </div>
                    </form>
                </div> 
            </div>
            <div class="row">
             <div class="col-sm-12 col-md-12">
                 <table class="table table-custom dataTable no-footer table-bordered table-striped">
                     <thead class="thead-black">
                     <th>
                    Question Title
                     </th> 
                      <th>
                       Answer
                     </th> 
                     <th>
                         Status
                     </th>
                     <th>
                         Action
                     </th>
                     </thead> 
                     <tbody>
                           <?php while($row = $data->faqs->fetch_object()): ?>
                         <tr>
                             <td>
                                <?= $row->faq_title; ?> 
                             </td> 
                            
                                <td>
                                 
                                    <?php echo $row->faq_answer;?>    
                                    
                                      
                                   
                             </td> 
                            
                              <td>
                                <?= $row->faq_status==1?"Active":"Disabled"; ?> 
                             </td> 
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/faqs/deletefaq'.'/'.$row->faq_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">delete</a> 
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
