<?php

class AdminPageController extends Admin
{

    private $components;
    
    public function __construct()
    {
        self::isAdmin();
        $this->components   = Registry::get('load');
    }
    
    public function ActionIndex()
    {
        
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_index', 'admin'));
        
        $this->components->load('controllers_admin_footerController')->getFooter();

        return true;
    }
    
    public function actionExit()
    {
        User::logout();
        return true;
    }
}
