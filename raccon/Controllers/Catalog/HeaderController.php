<?php
class HeaderController extends Controller
{
    public function headerAction($templateHeader = '')
    {
        $language = $this->language->getLanguage('header');
        
        $dataPage = [];
        $dataPage['favicon']    = CATALOG_IMAGE . '/' . FAVICON;
        $dataPage['url_assets'] = Router::getUrlAsets();   
        $dataPage['title']      = (!empty($this->doom->getTitle()) ? $this->doom->getTitle() : $language->get('title'));
        
        
        if (empty($templateHeader)) {
            echo Template::view('common_headerIndex',$dataPage);
        } else {
            echo Template::view($templateHeader,$dataPage);
        }
    }
}
