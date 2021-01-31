<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class PageSections extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       
         $iconsList = Database::$database->query("SELECT * from `vbio_icons`");
       $data = [
            'iconsList' =>$iconsList,
             
        ];
        $view = new \Altum\Views\View('admin/contents/flatIconsList', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function middle_three()
    {
      Authentication::guard('admin');
         $vbio_apps = Database::$database->query("SELECT * from `vbio_apps`");
         $vbio_image= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_Three'")->fetch_object();
        
         
         $data = [
            'vbio_apps' =>$vbio_apps,
              'vbio_image' =>$vbio_image,
        ];
      
        $view = new \Altum\Views\View('admin/contents/middleThree', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function addNewApp()
    {
       Authentication::guard('admin');
        $data = array();
       $view = new \Altum\Views\View('admin/contents/addvBioApp', (array) $this);

        $this->add_view_content('content', $view->run($data));     
    }
    public function savenewApp()
    {
     Authentication::guard('admin');
        if(!empty($_POST)) {
             $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
             $_POST['desc'] = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
             $stmt = Database::$database->prepare("INSERT INTO `vbio_apps` (`app_title`,`app_short_description`) VALUES (?,?)");
                    $stmt->bind_param('ss', $_POST['title'],$_POST['desc']);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/pagesections/middle_three');
       } 
        
    }
    public function deleteApp()
    {
           Authentication::guard('admin');
        $id = (isset($this->params[0])) ? $this->params[0] : false; 
        $stmt = Database::$database->prepare("DELETE FROM `vbio_apps` WHERE `app_id`=?");
                    $stmt->bind_param('s',$id);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/pagesections/middle_three');
    }
    public function editMiddleThree()
    {
           Authentication::guard('admin');
         $id = (isset($this->params[0])) ? $this->params[0] : false; 
      
         $vbio_app = Database::$database->query("SELECT * from `vbio_apps` WHERE `app_id`={$id}")->fetch_object();
         
         
         $data = [
            'vbio_app' =>$vbio_app,
             
        ];
      
        $view = new \Altum\Views\View('admin/contents/editvBioApp', (array) $this);

        $this->add_view_content('content', $view->run($data)); 
    }
    public function updatevBioApp()
    {
        Authentication::guard('admin'); 
        $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $_POST['desc'] = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
        $stmt = Database::$database->prepare("UPDATE `vbio_apps` SET `app_title`=?,`app_short_description`=?, `app_status`=? WHERE  `app_id`=?");
        $stmt->bind_param('ssss',$_POST['title'],$_POST['desc'],$_POST['app_status'],$_POST['app_id']);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'][] = $this->language->global->success_message->basic;
       redirect('admin/pagesections/middle_three');
    }
    public function saveImage()
    {
         $banner = (!empty($_FILES['file']['name']));
            $banner_name = $banner ? '' : $this->settings->logo;
              $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico','gif','webp'];
            
            if($banner) {
                $banner_file_name = $_FILES['file']['name'];
                $banner_file_extension = explode('.', $banner_file_name);
                $banner_file_extension = strtolower(end($banner_file_extension));
                $banner_file_temp = $_FILES['file']['tmp_name'];
                $banner_file_size = $_FILES['file']['size'];
                list($banner_width, $banner_height) = getimagesize($banner_file_temp);
               
                if(!in_array($banner_file_extension, $image_allowed_extensions)) {
                    $_SESSION['error'][] = $this->language->global->error_message->invalid_file_type;
                }

                if(!is_writable(UPLOADS_PATH . 'images/')) {
                    $_SESSION['error'][] = sprintf($this->language->global->error_message->directory_not_writable, UPLOADS_PATH . 'images/');
                }
               
                if(empty($_SESSION['error'])) {

                   

                    /* Generate new name for banner */
                    $banner_new_name = md5(time() . rand()) . '.' . $banner_file_extension;

                    /* Upload the original */
                    move_uploaded_file($banner_file_temp, UPLOADS_PATH . 'images/' . $banner_new_name);

                    /* Execute query */
                    //Database::$database->query("UPDATE `settings` SET `value` = '{$logo_new_name}' WHERE `key` = 'logo'");
                    // delete your existing hero section
                    
                    //end deleting
                   
                    if($_POST['action']=="new")
                    {
                     $stmt = Database::$database->prepare("INSERT INTO `homepage_images` (`image_name`, `image_section`) VALUES (?,?)");
                     $stmt->bind_param('ss',$banner_new_name, $_POST['section_name'] );
                       
                    }
                    else {
                     
                         $stmt = Database::$database->prepare("UPDATE `homepage_images` SET `image_name`=? WHERE `image_section`=?");
                     $stmt->bind_param('ss',$banner_new_name, $_POST['section_name'] );
                    }
                   $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    //link for redirect.
                    if($_POST['section_name']=='Middle_Three')
                    {
                     redirect('admin/pagesections/middle_three');   
                    }
                  if($_POST['section_name']=='Middle_Two')
                    {
                     redirect('admin/pagesections/middle_two');   
                    }
                    
                     if($_POST['section_name']=='Section_faq')
                    {
                     redirect('admin/faqs');   
                    }
                    if($_POST['section_name']=='Middle_One')
                    {
                     redirect('admin/pagesections/middle_one');   
                    }
                    
                }
            }
    }
    public function middle_two()
    {
        
       Authentication::guard('admin');
         $vbio_features = Database::$database->query("SELECT * from `vbio_minifeatures`");
         $vbio_image= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_Two'")->fetch_object();
         $section_contents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Middle_Two'")->fetch_object();
         
         $data = [
            'vbio_features' =>$vbio_features,
            'vbio_image' =>$vbio_image,
            'section_contents'=>$section_contents
        ];
          
        $view = new \Altum\Views\View('admin/contents/middleTwo', (array) $this);

        $this->add_view_content('content', $view->run($data));  
    }
    public function addNewFeature()
    {
      Authentication::guard('admin');
        $data = array();
       $view = new \Altum\Views\View('admin/contents/addvBiomini', (array) $this);

        $this->add_view_content('content', $view->run($data));       
    }
    public function savenewMini()
    {
       Authentication::guard('admin');
        if(!empty($_POST)) {
             $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
             $_POST['desc'] = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
             $stmt = Database::$database->prepare("INSERT INTO `vbio_minifeatures` (`mf_title`,`mf_description`) VALUES (?,?)");
                    $stmt->bind_param('ss', $_POST['title'],$_POST['desc']);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/pagesections/middle_two');
       }
    }
    public function editMiddleTwo()
    {
      Authentication::guard('admin');
         $id = (isset($this->params[0])) ? $this->params[0] : false; 
      
         $vbio_features = Database::$database->query("SELECT * from `vbio_minifeatures` WHERE `mf_id`={$id}")->fetch_object();
         
         
         $data = [
            'vbio_features' =>$vbio_features,
             
        ];
      
        $view = new \Altum\Views\View('admin/contents/editvBiomini', (array) $this);

        $this->add_view_content('content', $view->run($data));    
    }
    public function updatevBioMini()
    {
      Authentication::guard('admin'); 
        $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $_POST['desc'] = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
        $_POST['mf_status'] = filter_var($_POST['mf_status'], FILTER_SANITIZE_STRING);
        $stmt = Database::$database->prepare("UPDATE `vbio_minifeatures` SET `mf_title`=?,`mf_description`=?, `mf_status`=? WHERE  `mf_id`=?");
        $stmt->bind_param('ssss',$_POST['title'],$_POST['desc'],$_POST['mf_status'],$_POST['mf_id']);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'][] = $this->language->global->success_message->basic;
       redirect('admin/pagesections/middle_two');  
    }
    public function sectionTowContents()
    {
        $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $_POST['small_title'] = filter_var($_POST['small_title'], FILTER_SANITIZE_STRING);
        $_POST['section_name'] = filter_var($_POST['section_name'], FILTER_SANITIZE_STRING);
        if($_POST['action']=="new")
       {
            $stmt = Database::$database->prepare("INSERT INTO `sections_contents` (`sc_title`, `sc_small_title`,`sc_text`,`sc_section_name`) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss',$_POST['title'], $_POST['small_title'],$_POST['content'],$_POST['section_name'] );
                       
       }
       else {
         
            $stmt = Database::$database->prepare("UPDATE `sections_contents` SET `sc_title`=?,`sc_small_title`=?,`sc_text`=?  WHERE `sc_section_name`=?");
            $stmt->bind_param('ssss',$_POST['title'], $_POST['small_title'],$_POST['content'],$_POST['section_name'] );
       }
       $stmt->execute();
       $stmt->close();
      $_SESSION['success'][] = $this->language->global->success_message->basic;
       if($_POST['section_name']=='Section_faq')
      {
            redirect('admin/faqs');   
       }
       if($_POST['section_name']=='Middle_Two')
      {
           redirect('admin/pagesections/middle_two'); 
       }
        if($_POST['section_name']=='Middle_One')
      {
           redirect('admin/pagesections/middle_one'); 
       }
    }
    public function videoSetting()
    {
     
    Authentication::guard('admin');
       $video_setting =Database::$database->query("SELECT * from `videosetting`")->fetch_object();
         $data = [
            'video_setting' =>$video_setting,
        ];
       $view = new \Altum\Views\View('admin/contents/videoSetting', (array) $this);

        $this->add_view_content('content', $view->run($data)); 
    }
    public function saveVideSetting()
    {
      $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $_POST['small_title'] = filter_var($_POST['small_title'], FILTER_SANITIZE_STRING);
        $_POST['video_url'] = filter_var($_POST['video_url'], FILTER_SANITIZE_STRING);
            $banner = (!empty($_FILES['file']['name']));
            $banner_name = $banner ? '' : $this->settings->logo;
              $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
            
            if($banner) {
                $banner_file_name = $_FILES['file']['name'];
                $banner_file_extension = explode('.', $banner_file_name);
                $banner_file_extension = strtolower(end($banner_file_extension));
                $banner_file_temp = $_FILES['file']['tmp_name'];
                $banner_file_size = $_FILES['file']['size'];
                list($banner_width, $banner_height) = getimagesize($banner_file_temp);
               
                if(!in_array($banner_file_extension, $image_allowed_extensions)) {
                    $_SESSION['error'][] = $this->language->global->error_message->invalid_file_type;
                }

                if(!is_writable(UPLOADS_PATH . 'images/')) {
                    $_SESSION['error'][] = sprintf($this->language->global->error_message->directory_not_writable, UPLOADS_PATH . 'images/');
                }
               
                if(empty($_SESSION['error'])) {

                   

                    /* Generate new name for banner */
                    $banner_new_name = md5(time() . rand()) . '.' . $banner_file_extension;

                    /* Upload the original */
                    move_uploaded_file($banner_file_temp, UPLOADS_PATH . 'images/' . $banner_new_name);
                     if($_POST['action']=="new")
       {
            $stmt = Database::$database->prepare("INSERT INTO `videosetting` (`video_title`, `video_small_title`,`video_background`,`video_link`) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss',$_POST['title'], $_POST['small_title'],$banner_new_name,$_POST['video_url'] );
                       
       }
       else {
            if(!empty($_FILES['file']['name'])){
            $stmt = Database::$database->prepare("UPDATE `videosetting` SET `video_title`=?,`video_small_title`=?,`video_background`=?,`video_link`=? ");
            $stmt->bind_param('ssss',$_POST['title'], $_POST['small_title'],$banner_new_name,$_POST['video_url'] );
            }
            else {
                $stmt = Database::$database->prepare("UPDATE `videosetting` SET `video_title`=?,`video_small_title`=?,`video_link`=? ");
            $stmt->bind_param('sss',$_POST['title'], $_POST['small_title'],$_POST['video_url'] );
            
            }
            
            }
            $stmt->execute();
            $stmt->close();
           $_SESSION['success'][] = $this->language->global->success_message->basic;
           redirect('admin/pagesections/videoSetting');  
                }
            }
            else {
            $stmt = Database::$database->prepare("UPDATE `videosetting` SET `video_title`=?,`video_small_title`=?,`video_link`=? ");
            $stmt->bind_param('sss',$_POST['title'], $_POST['small_title'],$_POST['video_url'] );
            $stmt->execute();
            $stmt->close();
           $_SESSION['success'][] = $this->language->global->success_message->basic;
           redirect('admin/pagesections/videoSetting'); 
          }
        
         
    }
    public function deleteMiniF()
    {
       Authentication::guard('admin');
        $id = (isset($this->params[0])) ? $this->params[0] : false; 
        $stmt = Database::$database->prepare("DELETE FROM `vbio_minifeatures` WHERE `mf_id`=?");
                    $stmt->bind_param('s',$id);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/pagesections/middle_two');  
    }
    public function middle_one()
    {
        
        
      Authentication::guard('admin');
        
         $vbio_image= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_One'")->fetch_object();
         $section_contents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Middle_One'")->fetch_object();
         
         $data = [
           
            'vbio_image' =>$vbio_image,
            'section_contents'=>$section_contents
        ];
          
        $view = new \Altum\Views\View('admin/contents/middleOne', (array) $this);

        $this->add_view_content('content', $view->run($data));  
    }
}
?>