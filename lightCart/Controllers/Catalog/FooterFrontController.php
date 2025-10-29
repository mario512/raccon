<?php

class FooterFrontController
{

    
    private $image;

    public function __construct()
    {
        $this->image        = Registry::get('image');
    }

    
    public function footerAction()
    {
        $language = Registry::get('language')->getLanguage('footer');     
        
        $dataPage['logo'] = $this->image->resize(LOGO);

        $dataPage['href_telegram']                  = TELEGRAM;
        $dataPage['href_email']                     = EMAIL;
        $dataPage['href_tos']                       = Router::getUrlLink('/tos');
        $dataPage['href_notice']                    = Router::getUrlLink('/notice');
        
        $dataPage['text_telegram']                  = $language['text_telegram'];
        $dataPage['text_tos']                       = $language['text_tos'];
        $dataPage['text_notice']                    = $language['text_notice'];
        $dataPage['text_work_time']                 = $language['text_work_time'];
        $dataPage['text_login_and_email']           = $language['text_login_and_email'];
        $dataPage['text_login']                     = $language['text_login'];
        $dataPage['text_email']                     = $language['text_email'];
        $dataPage['text_password_repeat']           = $language['text_password_repeat'];
        $dataPage['text_password']                  = $language['text_password'];
        $dataPage['text_user_pin']                  = $language['text_user_pin'];
        $dataPage['text_register']                  = $language['text_register'];
        $dataPage['text_value_login']               = $language['text_value_login'];
        $dataPage['text_lostpass']                  = $language['text_lostpass'];
        $dataPage['text_tos_label_1']               = $language['text_tos_label_1'];
        $dataPage['text_tos_label_2']               = $language['text_tos_label_2'];
        $dataPage['text_tos_label_3']               = $language['text_tos_label_3'];
        
        $dataPage['placeholder_password']           = $language['placeholder_password'];
        $dataPage['placeholder_login_and_email']    = $language['placeholder_login_and_email'];

        
        require_once(Template::get('layouts_footer'));
    }
}
