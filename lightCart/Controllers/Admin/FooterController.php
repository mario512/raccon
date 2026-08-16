<?php
class FooterController
{
    public function getFooter()
    {
        $dataPage['href_assets']    = Router::getUrlLink(Router::getUrlAsets(true));
        require_once(Template::get('layouts_footer', 'admin'));
    }
}