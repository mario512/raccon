<?php

class FooterController
{

    
    private $image;

    public function __construct()
    {
        $this->image        = Registry::get('image');
    }

    
    public function footerAction()
    {
        $language = Registry::get('language')->getLanguage('footer');     
        $dataPage = [];


        
        $dataPage['url_assets'] = Router::getUrlAsets();   

        
        
        
        echo Template::view('common_footer',$dataPage);
    }
}
