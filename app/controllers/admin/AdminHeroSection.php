<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class AdminHeroSection extends Controller {

    public function index() {
            
        Authentication::guard('admin');
        $heroSection = Database::$database->query("SELECT * from `hero_section`")->fetch_object();
        //$heroSection = Database::get('*', 'hero_section');
          /* Main View */
      
      
        $data = [
            'heroSection' => $heroSection,
             
        ];
        
        $view = new \Altum\Views\View('admin/contents/hero', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function updateContents()
    {
       if(!empty($_POST)) {
            /* Define some variables */
            $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $_POST['btnurl'] = filter_var($_POST['btnurl'], FILTER_SANITIZE_STRING);
            
            $banner = (!empty($_FILES['file']['name']));
            $banner_name = $banner ? '' : $this->settings->logo;
            
            
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
                     Database::$database->query("DELETE FROM `hero_section`");
                    //end deleting
                    $stmt = Database::$database->prepare("INSERT INTO `hero_section` (`hs_image`, `hs_header`, `hs_small_header`,`hs_link`) VALUES (?, ?, ?,?)");
                    $stmt->bind_param('ssss', $banner_new_name, $_POST['title'],$_POST['description'],$_POST['btnurl'] );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/home-page-hero');
                }
            }
            else
            {
               $stmt = Database::$database->prepare("UPDATE  `hero_section` SET `hs_header`=?, `hs_small_header`=?,`hs_link`=? ");
                    $stmt->bind_param('sss', $_POST['title'],$_POST['description'],$_POST['btnurl'] );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/home-page-hero'); 
            }
            
            
          
       }
    }
}
?>