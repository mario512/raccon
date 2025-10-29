<?php

class HeaderFrontController
{

    private $image;
    private $component;
    private $metaTagData;
    public function __construct($data)
    {
        $this->image        = Registry::get('image');
        $this->component    = Registry::get('load');
        if (isset($data['meta_tag_data'])) {
            $this->metaTagData = $data['meta_tag_data'];
        } else {
            $this->metaTagData = NULL;
        }
        
    }

    public function getHeaderMenu()
    {

        $language = Registry::get('language')->getLanguage('header');
        $result = $this->component->getData('config_headerMenu', true);

        $menuHeader = array();

        foreach ($result as $key => $value) {
            if ($value['parrent'] == '0' && $value['active'] !== false) {

                $childrenHeaderMenu = array();

                foreach ($result as $childKey => $childVal) {
                    if ($key == $childVal['parrent']) {
                        $childrenHeaderMenu[$childKey] = array(
                            'name' => (isset($language[$childVal['name']])) ? $language[$childVal['name']] : $childVal['name'],
                            'href' => Router::getUrlLink(array()) . $childVal['href']
                        );
                    }
                }

                $menuHeader[] = array(
                    'name'  => (isset($language[$value['name']])) ? $language[$value['name']] : $value['name'],
                    'href'  => Router::getUrlLink(array()) . $value['href'],
                    'child' => $childrenHeaderMenu
                );
            }
        }
        return $menuHeader;
    }
    
    public function headerAction()
    {
        $language = Registry::get('language')->getLanguage('header');
        
        $dataPage = array();
        
        $dataPage['favicon']    = Router::getUrlLink(array()) . CATALOG_IMAGE . '/' . FAVICON;
        $dataPage['logo']       = $this->image->resize(LOGO);
        
        if (is_null($this->metaTagData)) {
            $dataPage['text_header_title'] = $language['text_header_title'];
            
        } else {
            $dataPage['text_header_title'] = $this->metaTagData['text_header_title'];
        }
                
        $dataPage['text_meta_description']      = $language['text_meta_description'];
        $dataPage['text_label_menu']            = $language['text_label_menu'];
        $dataPage['text_register_header']       = $language['text_register_header'];
        $dataPage['text_login_header']          = $language['text_login_header'];
        $dataPage['og_meta_description']        = $language['og_meta_description'];
        $dataPage['og_meta_title']              = $language['og_meta_title'];
        $dataPage['og_site_name']               = $language['og_site_name'];
        $dataPage['yandex_verification']        = $language['yandex_verification'];
        $dataPage['google_site_verification']   = $language['google_site_verification'];

        $dataPage['url']        = Router::getUrlLink(array());
        $dataPage['url_assets'] = Router::getUrlLink(Router::getUrlAsets());

        $dataPage['href_login']     = Router::getUrlLink(array('login'));
        $dataPage['href_register']  = Router::getUrlLink(array('register'));
        
        $dataPage['header_menu'] = $this->getHeaderMenu();
        
        require_once(Template::get('layouts_header'));
    }
}
