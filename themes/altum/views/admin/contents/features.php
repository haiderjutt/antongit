<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Features</h1>
    <div class="col-auto">
        <a href="<?php echo SITE_URL.'admin/features-section/addnew' ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>Add New Feature</a>
    </div>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            
            <div class="row">
             <div class="col-sm-12 col-md-12">
                 <table class="table table-custom dataTable no-footer table-bordered table-striped table-responsive">
                     <thead class="thead-black">
                     <th>
                      feature Title 
                     </th> 
                      <th>
                       Icon Lable
                     </th> 
                     <th>
                         Description
                     </th>
                     <th>
                         Status
                     </th>
                     <th>
                         Action
                     </th>
                     </thead> 
                     <tbody>
                           <?php while($row = $data->features->fetch_object()): ?>
                         <tr>
                             <td>
                                <?= $row->fe_title; ?> 
                             </td> 
                              <td>
                                 <?= $row->fe_icon; ?>
                             </td> 
                                <td>
                                    <blockquote>
                                    <?php echo $str = str_replace(PHP_EOL , '', $row->fe_description);?>    
                                    </blockquote>
                                      
                                   
                             </td> 
                              <td>
                                <?= $row->fe_enable==1?"Active":"Disabled"; ?> 
                             </td> 
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/features-section/editfeature'.'/'.$row->fe_id; ?>">Edit</a>
                            
                             
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
