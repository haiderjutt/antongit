<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class FeaturesSection extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       $features = Database::$database->query("SELECT * from `homefeatures`");
       $data = [
            'features' =>$features,
             
        ];
        $view = new \Altum\Views\View('admin/contents/features', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addFeature', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function savefeature()
    {
        
        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['title'] = Database::clean_string($_POST['title']);
             $_POST['iconname'] = Database::clean_string($_POST['iconname']);
            //$_POST['content'] = Database::clean_string($_POST['content']);
          $stmt = Database::$database->prepare("INSERT INTO `homefeatures` (`fe_title`, `fe_icon`, `fe_description`) VALUES ( ?, ?,?)");
          $stmt->bind_param('sss', $_POST['title'],$_POST['iconname'],$_POST['content'] );
          $stmt->execute();
          $stmt->close();
        $_SESSION['success'][] = $this->language->global->success_message->basic;
        redirect('admin/features-section');
        }
        else
        {
            $_SESSION['error'][] = $this->language->global->error_message->basic;
             redirect('admin/features-section/addnew');
            //
        }
    }
    public function editfeature()
    {
        
      $id = (isset($this->params[0])) ? $this->params[0] : false;
         Authentication::guard('admin');
       $featureDetail = Database::$database->query("SELECT * from `homefeatures` where `fe_id` = '{$id}' ")->fetch_object();
       $data = [
            'featureDetail' =>$featureDetail,
             
        ];
        $view = new \Altum\Views\View('admin/contents/editFeature', (array) $this);

        $this->add_view_content('content', $view->run($data));    
    }
    public function updatefeature()
    {
       
        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['title'] = Database::clean_string($_POST['title']);
             $_POST['iconname'] = Database::clean_string($_POST['iconname']);
           $_POST['fe_id'] = Database::clean_string($_POST['fe_id']);
           $_POST['status'] = Database::clean_string($_POST['status']);
           $feid = $_POST['fe_id'];
          $stmt = Database::$database->prepare("UPDATE `homefeatures` SET  `fe_title` = ?, `fe_icon` = ?, `fe_description` = ?, `fe_enable` = ? WHERE `fe_id` = ?");
          $stmt->bind_param('sssss', $_POST['title'],$_POST['iconname'],$_POST['content'],$_POST['status'],$feid);
          $stmt->execute();
          $stmt->close();
        $_SESSION['success'][] = $this->language->global->success_message->basic;
        redirect('admin/features-section');
        }
        else
        {
            $_SESSION['error'][] = $this->language->global->error_message->basic;
             redirect('admin/features-section/addnew');
            //
        }
        
        
        
    }
   
}
?>