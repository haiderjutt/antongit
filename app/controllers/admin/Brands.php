<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class Brands extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       $brands = Database::$database->query("SELECT * from `brands`");
       $data = [
            'brands' =>$brands,
             
        ];
        $view = new \Altum\Views\View('admin/contents/brands', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addBrand', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function saveBrand()
    {
        
       if(!empty($_POST)) {
            /* Define some variables */
            $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['description'] =$_POST['description'];
            //$_POST['btnurl'] = filter_var($_POST['btnurl'], FILTER_SANITIZE_STRING);
            
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
                    
                    //end deleting
                    $stmt = Database::$database->prepare("INSERT INTO `brands` (`brand_title`, `brand_detail`, `brand_logo`) VALUES (?, ?,?)");
                    $stmt->bind_param('sss', $_POST['title'],$_POST['description'],$banner_new_name );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/brands');
                }
            }
            
            
          
       }
    }
    public function editBrand()
    {
        $id = (isset($this->params[0])) ? $this->params[0] : false;
         Authentication::guard('admin');
       $brandDetail = Database::$database->query("SELECT * from `brands` where `brand_id` = '{$id}' ")->fetch_object();
       $data = [
            'brandDetail' =>$brandDetail,
             
        ];
        $view = new \Altum\Views\View('admin/contents/editBrand', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function updateBrand()
    {
      if(!empty($_POST)) {
            /* Define some variables */
            $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['description'] =$_POST['description'];
            $_POST['brand_id'] = filter_var($_POST['brand_id'], FILTER_SANITIZE_STRING);
            $_POST['brand_status'] = filter_var($_POST['brand_status'], FILTER_SANITIZE_STRING);
            
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
                    
                    //end deleting
                    $stmt = Database::$database->prepare("UPDATE `brands` SET `brand_title`=?, `brand_detail`=?, `brand_logo`=?,`brand_status`=? WHERE `brand_id`=?");
                    $stmt->bind_param('sssss', $_POST['title'],$_POST['description'],$banner_new_name,$_POST['brand_status'], $_POST['brand_id'] );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/brands');
                }
            }
            
            
          
       }  
    }
    public function deleteBrand()
    {
         Authentication::guard('admin');
        $id = (isset($this->params[0])) ? $this->params[0] : false;
        Database::$database->query("DELETE from`brands` where `brand_id`='{$id}'");
        $_SESSION['success'][] = $this->language->global->success_message->basic;
        redirect('admin/brands');
        
                  
    }
   
}
?>