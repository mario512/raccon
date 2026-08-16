<?php

Class FormRegisterController
{
    private $language;

    public function __construct()
    {
        $this->language = Registry::get('language');
    }

    public function getFormRegister() 
    {
        $language = $this->language->getLanguage('formRegister');

        $dataPage['text_label_login_form']      = $language['text_label_login_form'];
        $dataPage['text_label_imput_login']     = $language['text_label_imput_login'];
        $dataPage['text_label_imput_password']  = $language['text_label_imput_password'];
        $dataPage['text_placeholder_login']     = $language['text_placeholder_login'];
        $dataPage['text_placeholder_password']  = $language['text_placeholder_password'];
        $dataPage['text_user_pin']              = $language['text_user_pin'];
        $dataPage['text_register']              = $language['text_register'];
        $dataPage['text_lostpass']              = $language['text_lostpass'];

        $dataPage['href_register'] = Router::getUrlLink('/register');
        $dataPage['href_lostpass'] = Router::getUrlLink('/lostpass');

        $dataPage['text_button_login'] = $language['text_button_login'];

        require_once(Template::get('form_register'));
        
        return true;

    }
}
