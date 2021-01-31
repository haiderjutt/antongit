<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class Faqs extends Controller {

    public function index() {
            
       Authentication::guard('admin');
       $vbio_image= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Section_faq'")->fetch_object();
       $section_contents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Section_faq'")->fetch_object();
       $faqs = Database::$database->query("SELECT * from `faqs`");
       $data = [
            'faqs' =>$faqs,
           'vbio_image' =>$vbio_image,
            'section_contents'=>$section_contents
             
        ];
        $view = new \Altum\Views\View('admin/contents/faqs', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addFaq', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function saveFaq()
    {
        Authentication::guard('admin');
       if(!empty($_POST)) {
            /* Define some variables */
          

            /* Main Tab */
            $data = array();
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['description'] =$_POST['description'];
           
            
           //end deleting
                    $stmt = Database::$database->prepare("INSERT INTO `faqs` (`faq_title`, `faq_answer`, `faq_created_date`) VALUES (?,?,?)");
                    $stmt->bind_param('sss', $_POST['title'],$_POST['description'], Date::$date );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/faqs');
            
            
            
          
       }
    }
    public function deletefaq()
    {
        Authentication::guard('admin');
        $id = (isset($this->params[0])) ? $this->params[0] : false;
        Database::$database->query("DELETE from`faqs` where `faq_id`='{$id}'");
        $_SESSION['success'][] = $this->language->global->success_message->basic;
        redirect('admin/faqs');
    }
   
}
?>