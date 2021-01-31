<?php defined('ALTUMCODE') || die() ?>
<link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH . 'css/flaticon.css';?>">

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>All Icons</h1>
    <div class="col-auto" style="display: none;">
        <a href="<?php echo SITE_URL.'admin/flat_icons/addNew' ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>Add New Icon</a>
    </div>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            
            <div class="row">
             <div class="col-sm-12 col-md-6">
                 <table class="table table-custom dataTable no-footer table-bordered table-striped">
                     <thead class="thead-black">
                     <th>
                      #
                     </th> 
                      <th>
                       Icon
                     </th> 
                     <th>
                       Class
                     </th> 
                     </thead> 
                     <tbody>
                      <?php 
                      $i=0;
                      while($row = $data->iconsList->fetch_object()): 
                         ?>
                        <tr>
                           <td><?php echo $i;?></td>  
                           <td><i class="<?php echo $row->icon_name;?>"></i></td>  
                           <td><?php echo $row->icon_name;?></td>  
                         </tr>
                       <?php $i++;
                       endwhile ?>
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
