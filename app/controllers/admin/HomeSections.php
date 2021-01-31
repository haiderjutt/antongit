<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class HomeSections extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       
        $data = array();
        $view = new \Altum\Views\View('admin/contents/pageSections', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
   
}
?>