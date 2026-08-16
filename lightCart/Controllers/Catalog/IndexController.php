<?php
class IndexController extends Controller
{
    public function actionIndex()
    {
       
        $language = $this->language->getLanguage('index');
        $language = $this->language->getLanguage('header');

        $logoImgWH = explode('x',LOGO_HEADER_SIZE);
        
        $dataPage = [];
        $dataPage['url_assets']                 = Router::getUrlAsets(); 
        $dataPage['logo']                       = $this->image->resize(LOGO, $logoImgWH[0], $logoImgWH[1]);
        $dataPage['h2_title']                   = $language->get('h2_title');
        $dataPage['text_intro']                 = $language->get('text_intro');
        $dataPage['text_button_download']       = $language->get('text_button_download');
        $dataPage['title_logo']                 = $language->get('title_logo');
        $dataPage['text_philosophy']            = $language->get('text_philosophy');
        $dataPage['text_search_placeholder']    = $language->get('text_search_placeholder');

        $this->component->load('controllers_catalog_headerController')->headerAction();
       
        echo Template::view('index',$dataPage);
        
        $this->component->load('controllers_catalog_footerController')->footerAction();

        return true;
    }

    
}
