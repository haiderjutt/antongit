<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3"><i class="fa fa-fw fa-xs fa-file-alt text-primary-900 mr-2"></i> <?= $this->language->home_sections->header; ?></h1>
</div>

<?php display_notifications() ?>

<div class="card">
    <div class="card-body">

            
            <div class="row">
             <div class="col-sm-12 col-md-12">
                 <table class="table table-custom  dataTable no-footer table-bordered table-striped">
                     <thead class="thead-black">
                     <th>
                        <?= $this->language->home_sections->table->name; ?>
                     </th> 
                      <th>
                        <?= $this->language->home_sections->table->action; ?>
                     </th> 
                     <th>
                        <?= $this->language->home_sections->table->name; ?>
                     </th> 
                      <th>
                        <?= $this->language->home_sections->table->action; ?>
                     </th> 
                     </thead> 
                     <tbody>
                         <tr>
                             <td>Hero Section</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/home-page-hero' ?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                              <td>Features</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/features-section' ?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                         </tr>
                        
                         <tr>
                             <td>Brand Slider</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/brands';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                             
                             <td>Testimonials</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/testimonials';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                         </tr>
                            
                        
                          <tr>
                             <td>FAQs</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/faqs';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                             <td>Blogs</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/blogs';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                         </tr>
                        
                          <tr>
                             <td>Interfaces Slider</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/interface_slider';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                               <td>Middle Hero Section1</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/pagesections/middle_one';?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                         </tr>
                          <tr>
                           
                         </tr>
                         
                         <tr>
                             <td>Middle Hero Section2(Mini Features)</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/pagesections/middle_two' ?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                              <td>Middle Hero Section3(vBio Apps)</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/pagesections/middle_three' ?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                         </tr>
                         
                     <tr>
                             <td>Home Page Icons</td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/flat_icons' ?>"><i class="fa fa-fw fa-eye"></i></a>
                             </td>
                             <td>
                              Video Setting   
                             </td>
                             <td>
                                 <a href="<?php echo SITE_URL.'admin/pagesections/videoSetting' ?>"><i class="fa fa-fw fa-eye"></i></a>
                              
                             </td>
                         </tr>
                        
                        
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
