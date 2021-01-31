<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class HomeIcons extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       
         $iconsList = Database::$database->query("SELECT * from `vbio_icons`");
       $data = [
            'iconsList' =>$iconsList,
             
        ];
        $view = new \Altum\Views\View('admin/contents/flatIconsList', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addNew()
    {
      Authentication::guard('admin');
       
        $data = array();
        $view = new \Altum\Views\View('admin/contents/addnewIcon', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
   
}
?>