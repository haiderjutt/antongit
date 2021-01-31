<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class Testimonials extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       $testimonials = Database::$database->query("SELECT * from `testimonials`");
       $data = [
            'testimonials' =>$testimonials,
             
        ];
        $view = new \Altum\Views\View('admin/contents/testimonials', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addTestimonial', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function saveTestimonial()
    {
        
       if(!empty($_POST)) {
            $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $_POST['description'] =$_POST['description'];
            $_POST['company'] = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
            $_POST['designation'] = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
            /* Define some variables */
           // $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
           //upload image
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
                }
                $stmt = Database::$database->prepare("INSERT INTO `testimonials` (`client_name`, `client_company`, `client_desig`,`client_message`,`client_profile`) VALUES (?,?,?,?,?)");
                $stmt->bind_param('sssss', $_POST['name'],$_POST['company'],$_POST['designation'], $_POST['description'],$banner_new_name);
                    
            }
            else
            {
              $stmt = Database::$database->prepare("INSERT INTO `testimonials` (`client_name`, `client_company`, `client_desig`,`client_message`) VALUES (?,?,?,?)");
              $stmt->bind_param('ssss', $_POST['name'],$_POST['company'],$_POST['designation'], $_POST['description']);
            }
           //end upload image
            /* Main Tab */
            $stmt->execute();
            $stmt->close();
            $_SESSION['success'][] = $this->language->global->success_message->basic;
            redirect('admin/testimonials');
            
            
          
       }
    }
    public function editTestimonials()
    {
       $id = (isset($this->params[0])) ? $this->params[0] : false;
         Authentication::guard('admin');
       $testimonialsDetail = Database::$database->query("SELECT * from `testimonials` where `test_id` = '{$id}' ")->fetch_object();
       $data = [
            'testimonialsDetail' =>$testimonialsDetail,
             
        ]; 
        $view = new \Altum\Views\View('admin/contents/editTestimonial', (array) $this);

        $this->add_view_content('content', $view->run($data)); 
    }
    public function updateTestimonial()
    {
        if(!empty($_POST)) {
            /* Define some variables */
           // $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $_POST['description'] =$_POST['description'];
            $_POST['company'] = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
            $_POST['designation'] = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
            
            
            
            
            $stmt = Database::$database->prepare("UPDATE `testimonials`  SET `client_name`=?, `client_company`=?, `client_desig`=?,`client_message`=?,`status`=? WHERE `test_id`=?");
                    $stmt->bind_param('ssssss', $_POST['name'],$_POST['company'],$_POST['designation'], $_POST['description'],$_POST['status'],$_POST['test_id']);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/testimonials');
            
            
          
       }    
    }
   
}

?>