<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class InterfaceSection extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       $interfaces = Database::$database->query("SELECT * from `interface_images`");
       $data = [
            'interfaces' =>$interfaces,
             
        ];
        $view = new \Altum\Views\View('admin/contents/interfaceImages', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addImage', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function saveImage()
    {
        
       if(!empty($_POST)) {
            /* Define some variables */
            $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            
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

                if(!is_writable(UPLOADS_PATH . 'slider/')) {
                    $_SESSION['error'][] = sprintf($this->language->global->error_message->directory_not_writable, UPLOADS_PATH . 'images/');
                }

                if(empty($_SESSION['error'])) {

                    

                    /* Generate new name for banner */
                    $banner_new_name = md5(time() . rand()) . '.' . $banner_file_extension;

                    /* Upload the original */
                    move_uploaded_file($banner_file_temp, UPLOADS_PATH . 'slider/' . $banner_new_name);

                   
                    //end deleting
                    $stmt = Database::$database->prepare("INSERT INTO `interface_images` (`int_image_name`, `int_created_date`) VALUES (?,?)");
                    $stmt->bind_param('ss',$banner_new_name,Date::$date );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/interface_slider');
                }
            }
            
            
          
       }
    }
    public function deleteImage() {
         $id = (isset($this->params[0])) ? $this->params[0] : false;
          //$status = (isset($this->params[1])) ? $this->params[1] : false;
        Database::$database->query("DELETE from`interface_images` where `int_id`='{$id}'");
        $_SESSION['success'][] = $this->language->global->success_message->basic;
        redirect('admin/interface_slider');
    }
   
}
?>