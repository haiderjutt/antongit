<?php
 
namespace Altum\Controllers;


use Altum\Database\Database;

class Index extends Controller {

    public function index() {
      
       
        
      
        /* Check if the current link accessed is actually the original url or not ( multi domain use ) */
        $original_url_host = parse_url(url())['host'];
        $request_url_host = Database::clean_string($_SERVER['HTTP_HOST']);

        if($original_url_host != $request_url_host) {

        /* Make sure the custom domain is attached */
        $domain = Database::get(['domain_id', 'custom_index_url'], 'domains', ['host' => $request_url_host]);

        /* Redirect if custom index is set */
            if(!empty($domain->custom_index_url)) {
                header('Location: ' . $domain->custom_index_url);
                die();
            }

            $is_custom_domain = true;

        }


        /* Custom index redirect if set */
        if(!empty($this->settings->index_url)) {
            header('Location: ' . $this->settings->index_url);
            die();
        }

        /* Check if the current link accessed is actually the original url or not ( multi domain use ) */
        $original_url_host = parse_url(url())['host'];
        $request_url_host = Database::clean_string($_SERVER['HTTP_HOST']);

        if($original_url_host != $request_url_host) {
            $is_custom_domain = true;
        }

        /* Packages View */
        $data = [
            'simple_package_settings' => [
                'additional_global_domains',
                'custom_url',
                'deep_links',
                'no_ads',
                'removable_branding',
                'custom_branding',
                'custom_colored_links',
                'statistics',
                'google_analytics',
                'facebook_pixel',
                'custom_backgrounds',
                'verified',
                'scheduling',
                'seo',
                'utm',
                'socials',
                'fonts'
            ]
        ];
        $heroSection = Database::$database->query("SELECT * from `hero_section`")->fetch_object();
        $features = Database::$database->query("SELECT * from `homefeatures`");
        $brands = Database::$database->query("SELECT * from `brands` WHERE `brand_status`='1'");
        $testimonials = Database::$database->query("SELECT * from `testimonials`");
        $blogs = Database::$database->query("SELECT * from `blogs` order by `blog_id` DESC  LIMIT 3 ");
        $packages = Database::$database->query("SELECT * FROM `packages` WHERE `status`='1' ");
        $faqs = Database::$database->query("SELECT * FROM `faqs` WHERE `faq_status`='1' order by `faq_id` DESC LIMIT 4  ");
        $interFace = Database::$database->query("SELECT * FROM `interface_images` WHERE `int_status`='1'");
        $vbio_apps = Database::$database->query("SELECT * FROM `vbio_apps` WHERE `app_status`='1'");
         $middleThreeImage= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_Three'")->fetch_object();
        
       $videoSetting = Database::$database->query("SELECT * from `videosetting`")->fetch_object();
        $vbio_features = Database::$database->query("SELECT * from `vbio_minifeatures`");
         $vbio_image= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_Two'")->fetch_object();
        $middleOneImage= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Middle_One'")->fetch_object();
        $section_contents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Middle_Two'")->fetch_object();
        $middleOneContents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Middle_One'")->fetch_object();
          $faq_contents = Database::$database->query("SELECT * from `sections_contents` WHERE `sc_section_name`='Section_faq'")->fetch_object();
        $faqimage= Database::$database->query("SELECT * from `homepage_images` WHERE `image_section`='Section_faq'")->fetch_object();
        
        //$view = new \Altum\Views\View('partials/packages', (array) $this);
        
        
        //$this->add_view_content('packages', $view->run($data));


        /* Main View */
        $data = [
            'is_custom_domain' => $is_custom_domain ?? false,
            'heroSection'=>$heroSection,
            'features' =>$features,
             'featuresDetail' =>$features,
            'brands'=>$brands,
            'testimonials' =>$testimonials,
            'blogs'=>$blogs,
            'packages'=>$packages,
            'faqs'=>$faqs,
            'interFace'=>$interFace,
            'vbio_apps'=>$vbio_apps,
            'videoSetting'=>$videoSetting,
            'vbio_features'=>$vbio_features,
            'vbio_image'=>$vbio_image,
            'section_contents'=>$section_contents,
            'middleOneImage'=>$middleOneImage,
            'middleOneContents'=>$middleOneContents,
              'middleThreeImage'=>$middleThreeImage,
            'faq_contents'=>$faq_contents,
            'faqimage'=>$faqimage,
           ];
//'pages'=>$pages
        $view = new \Altum\Views\View('index/home', (array) $this);
        //$view = new \Altum\Views\View('index/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }
}


?>
