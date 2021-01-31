<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Models\Package;
use Altum\Routing\Router;
use Altum\Date;

class Blog extends Controller {

    public function index() {

       $blogs = Database::$database->query("SELECT * from `blogs` order by `blog_id` DESC");
       $data = [
           'blogs'=>$blogs
       ];
       $view = new \Altum\Views\View('blog/index', (array) $this);
        //$view = new \Altum\Views\View('index/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }
    public function blog_detail()
    {
       $id = (isset($this->params[0])) ? $this->params[0] : false;
       $blog = Database::$database->query("SELECT * from `blogs` left join `users` on users.user_id=blogs.blog_author WHERE `blog_id`={$id}")->fetch_object();
       $comments = Database::$database->query("SELECT * FROM `comments` where `comment_on`='{$id}'");
       $blogs = Database::$database->query("SELECT * from `blogs` order by `blog_id` DESC LIMIT 3");
       $categories = Database::$database->query("SELECT * from `blog_categories`");
      
       $data =[
            'blog' =>$blog,
           'comments'=>$comments,
           'latestBlogs'=>$blogs,
           'categories'=>$categories
       ];
       $view = new \Altum\Views\View('blog/detail', (array) $this);
        //$view = new \Altum\Views\View('index/index', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function category()
    {
      $name = (isset($this->params[0])) ? $this->params[0] : false;
        $blogs = Database::$database->query("SELECT * from `blogs` where `blog_category`='$name'  order by `blog_id` DESC");
       $data = [
           'blogs'=>$blogs
       ];
       $view = new \Altum\Views\View('blog/index', (array) $this);
        //$view = new \Altum\Views\View('index/index', (array) $this);

        $this->add_view_content('content', $view->run($data)); 
    }
    public function submitComment()
    {
        if(!empty($_POST)) {
             $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
             $_POST['blog_id'] = filter_var($_POST['blog_id'], FILTER_SANITIZE_STRING);
             $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
             $_POST['number'] = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
             $_POST['subject'] = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
             $_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
             $stmt = Database::$database->prepare("INSERT INTO `comments` (`name`,`email`,`phone`,`subject`,`message`,`comment_on`,`comment_date`) VALUES (?,?,?,?,?,?,?)");
             $stmt->bind_param('sssssss', $_POST['name'],$_POST['email'],$_POST['number'],$_POST['subject'],$_POST['message'],$_POST['blog_id'],Date::$date);
             $stmt->execute();
             $stmt->close();
             $_SESSION['success'][] = $this->language->global->success_message->basic;
             redirect('blogs');
       } 
    }
}

