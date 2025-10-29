<?php

class HeaderController 
{
    private $language;
    private $component;
    private $image;

    public function __construct()
    {
        $this->language     = Registry::get('language')->getLanguage('header', true);;
        $this->component    = Registry::get('load');
        $this->image        = Registry::get('image');
    }
    public function getHeaderMenu()
    {

        $language = $this->language;
        
        $result = $this->component->getData('config_headerAdminMenu', true);
        
        $menuHeader = array();
        $k = 0;
        foreach ($result as $key => $value) {
            if ($value['parrent'] == '0' && $value['active'] !== false) {

                $childrenHeaderMenu = array();

                foreach ($result as $childKey => $childVal) {
                    if ($key == $childVal['parrent']) {
                        $childrenHeaderMenu[$childKey] = array(
                            'key'           => $k++,
                            'name'          => (isset($language[$childVal['name']])) ? $language[$childVal['name']] : $childVal['name'],
                            'href'          => Router::getUrlLink(array()) . $childVal['href'],
                            'active_class'  => ($_SERVER['REQUEST_URI'] == $childVal['href']) ? 'active' : ''
                        );
                    }
                }

                $menuHeader[] = array(
                    'name'          => (isset($language[$value['name']])) ? $language[$value['name']] : $value['name'],
                    'href'          => $value['href'],
                    'active_class'  => ($_SERVER['REQUEST_URI'] == $value['href']) ? 'active' : '',
                    'child'         => $childrenHeaderMenu,
                );
            }
        }
        return $menuHeader;
    }

    public function getHeader()
    {
        $dataPage['logo']  = $this->image->resize('logo.jpg', 100 ,100);
        
        $dataPage['text_title']             = $this->language['text_title'];
        $dataPage['text_menu_light_mode']   = $this->language['text_menu_light_mode'];
        $dataPage['text_menu_dark_mode']    = $this->language['text_menu_dark_mode'];
        $dataPage['text_menu_auto_mode']    = $this->language['text_menu_auto_mode'];
        
        $dataPage['user_name']  = Session::get()->user_name;
        $dataPage['user_email'] = Session::get()->user_email;
        
        $userLogo = (Session::get()->user_logo) ? Session::get()->user_logo : 'group1157.png';
        
        $dataPage['user_logo'] =  $this->image->resize($userLogo, 40, 40);

        $dataPage['text_menu_settings'] = $this->language['text_menu_settings'];
        $dataPage['text_menu_orders']   = $this->language['text_menu_orders'];
        $dataPage['text_menu_sign_out'] = $this->language['text_menu_sign_out'];
        
        $dataPage['href_assets']    = Router::getUrlLink(Router::getUrlAsets(true));
        $dataPage['href_index']     = Router::getUrlLink('/admin-control-panel/');
        $dataPage['href_settings']  = Router::getUrlLink('/admin-user-edit/');
        $dataPage['href_exit']      = Router::getUrlLink('/admin-exit/');
        

        $headerMenu = $this->getHeaderMenu();
        
        if ($headerMenu) {
            $dataPage['header_menu'] = $headerMenu;
        } else {
            $dataPage['header_menu'] = false;
        }
        
        require_once(Template::get('layouts_header', 'admin'));
    }
}