<?php

class Breadcrumbs
{

    public function __construct()
    {
        $this->language = Registry::get('language')->getLanguage('site');
    }

    public function getBreadcrumbs($data)
    {

        $currentPosition = array_pop($data);

        $html  = '<div class="breadcrumbs">';
        $html .= '<ol class="breadcrumb">';

        $html .= '<li><a href="/">' . $this->language['text_home_page'] . '</a></li>';

        foreach ($data as $dataKey => $dataVal) {
            $html .= '<li><a href="' . $dataVal['href_category_name'] . '">' . $dataVal['text_category_name'] . '</a></li>';
        }

        $html .= '<li class="active">' . $currentPosition['text_category_name'] . '</li>';
        $html .= '</ol>';
        $html .= '</div>';

        return $html;
    }
}
