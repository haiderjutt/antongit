<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i>Comments</h1>
    <div class="col-auto">
         <a href="<?php echo SITE_URL.'admin/blogs/addCategory' ?>" class="btn btn-info"><i class="fa fa-fw fa-plus-circle"></i>Add Category</a>
    
        <a href="<?php echo SITE_URL.'admin/blogs/addnew' ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>Add New Blog</a>
    </div>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            
            <div class="row">
             <div class="col-sm-12 col-md-12">
                 <table class="table table-custom dataTable no-footer table-bordered table-striped">
                     <thead class="thead-black">
                    
                     <th>Name</th> 
                      <th>Email</th>
                      <th>Phone</th> 
                       <th>Subject</th> 
                     <th>Comment</th>
                     <th>Date</th>
                    <th>Action</th>
                     </thead> 
                     <tbody>
                           <?php while($row = $data->comments->fetch_object()): ?>
                         <tr>
                           
                            <td><?= $row->name; ?></td> 
                             <td><?= $row->email; ?></td>
                             <td> <?= $row->phone; ?> </td>
                             <td> <?= $row->subject; ?> </td>
                              <td> <?= $row->message; ?> </td>
                              <td> <?= $row->comment_date; ?> </td>
                             <td>
                               <a href="<?php echo SITE_URL.'admin/blogs/deleteComment'.'/'.$row->comment_id; ?>">delete</a> 
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
