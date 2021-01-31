<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Models\Plan;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Altum\Date;

class Blogs extends Controller {

    public function index() {
            
        Authentication::guard('admin');
       $blogs = Database::$database->query("SELECT * from `blogs` left join users on users.user_id=blogs.blog_author");
       $data = [
            'blogs' =>$blogs,
             
        ];
        $view = new \Altum\Views\View('admin/contents/blogs', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function addnew()
    {
     Authentication::guard('admin');
     $category = Database::$database->query("SELECT * from `blog_categories`");
       $data = [
            'categories' =>$category,
             
        ];
    
        $view = new \Altum\Views\View('admin/contents/addBlog', (array) $this);

        $this->add_view_content('content', $view->run($data));   
    }
    public function addCategory()
    {
        Authentication::guard('admin');
     $data = array();
        $view = new \Altum\Views\View('admin/contents/addCategory', (array) $this);
        $this->add_view_content('content', $view->run($data));  
    }
    public function saveCategory()
    {
       if(!empty($_POST)) {
             $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
             $stmt = Database::$database->prepare("INSERT INTO `blog_categories` (`cat_title`) VALUES (?)");
                    $stmt->bind_param('s', $_POST['title']);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/blogs');
       } 
    }

    public function saveBlog()
    {
//        echo'<pre>';
//        print_r($_POST);
//        die();
       if(!empty($_POST)) {
            /* Define some variables */
            $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

            /* Main Tab */
            $data = array();
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
             $_POST['seotitle'] = filter_var($_POST['seotitle'], FILTER_SANITIZE_STRING);
              $_POST['category'] = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
              
            $_POST['description'] =$_POST['description'];
            $_POST['seokeywords'] =$_POST['seokeywords'];
            $_POST['seodescription'] =$_POST['seodescription'];
            
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

                if(!is_writable(UPLOADS_PATH . 'blogs/')) {
                    $_SESSION['error'][] = sprintf($this->language->global->error_message->directory_not_writable, UPLOADS_PATH . 'images/');
                }

                if(empty($_SESSION['error'])) {

                    

                    /* Generate new name for banner */
                    $banner_new_name = md5(time() . rand()) . '.' . $banner_file_extension;

                    /* Upload the original */
                    move_uploaded_file($banner_file_temp, UPLOADS_PATH . 'blogs/' . $banner_new_name);

                    /* Execute query */
                    //Database::$database->query("UPDATE `settings` SET `value` = '{$logo_new_name}' WHERE `key` = 'logo'");
                    // delete your existing hero section
                    
                    //end deleting
                    $stmt = Database::$database->prepare("INSERT INTO `blogs` (`blog_title`, `blog_seo_title`, `blog_seo_description`,`blog_seo_keyword`,`blog_category`,`blog_description`,`blog_author`,`blog_created_on`,`blog_feature_image`) VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param('sssssssss', $_POST['title'],$_POST['seotitle'],$_POST['seodescription'],$_POST['seokeywords'],$_POST['category'],$_POST['description'],$_SESSION['user_id'],Date::$date,$banner_new_name );
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'][] = $this->language->global->success_message->basic;
                    redirect('admin/blogs');
                }
            }
            
            
          
       }
    }
    public function blogDetail()
    {
         $id = (isset($this->params[0])) ? $this->params[0] : false;
       
         Authentication::guard('admin');
       $blog = Database::$database->query("SELECT * from `blogs` WHERE `blog_id`={$id}")->fetch_object();
      
       
       $data = [
            'blog' =>$blog,
             
        ];
        $view = new \Altum\Views\View('admin/contents/blogDetail', (array) $this);

        $this->add_view_content('content', $view->run($data));
    }
    public function comments()
    {
        $id = (isset($this->params[0])) ? $this->params[0] : false;
         Authentication::guard('admin');
       $comments = Database::$database->query("SELECT * from `comments` left join `blogs` on blogs.blog_id=comments.comment_on  where comment_on = '{$id}' ");
       $data = [
            'comments' =>$comments,
             
        ];
        $view = new \Altum\Views\View('admin/contents/comments', (array) $this);

        $this->add_view_content('content', $view->run($data)); 
    }
   
}
?>