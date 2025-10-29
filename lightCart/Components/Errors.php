<?php
class Errors
{
    public static function goErr404()
    {
        $components = Registry::get('load');

        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        
        $language = Registry::get('language')->getLanguageSystem();
       
        $dataPage = array();

        $dataPage['text_h1_404_page']       = $language['text_h1_404_page'];
        $dataPage['text_message_404_page']  = $language['text_message_404_page'];
        $dataPage['text_button_404_page']   = $language['text_button_404_page'];

        $components->load('controllers_catalog_headerFrontController')->headerAction();
               
        require_once(ROOT . '/Views/Catalog/' . THEME . PAGE_404);

        $components->load('controllers_catalog_footerFrontController')->footerAction();
    }
    
    public static function err404()
    {
        header('Locaton: /');
        self::goErr404();
        return true;
    }
}