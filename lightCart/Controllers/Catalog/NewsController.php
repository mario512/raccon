<?php
class NewsController
{
    private $components;

    public function __construct()
    {
        $this->components = Registry::get('load');
    }

    public function actionNewsById($id)
    {
        $formRegister = $this->components->load('controllers_catalog_formRegisterController');
        
        $language = Registry::get('language')->getLanguage('news');
        $image    = Registry::get('image');
        
        $dataPage['form_register'] = $formRegister;
        
        $news = $this->components->load('models_catalog_news')->getNewsById($id);
        if ($news) {
            $newsData['id']                 = $news['news_id'];
            $newsData['title']              = $news['news_title'];
            $newsData['text']               = htmlspecialchars_decode($news['news_text'], ENT_QUOTES);
            $newsData['date']               = Date::getDate($news['news_date']);
            $newsData['meta_date']          = Date::getDate($news['news_date'],"Y-m-d");
            $newsData['text_meta_author']   = $language['text_meta_author'];
            $newsData['meta_logo']          = $image->resize(LOGO);
            $newsData['category']           = $news['news_category_name'];
            $newsData['text_category_name'] = $language['text_category_name'];
            $newsData['href']               = Router::getUrlLink('/news/');
            $newsData['button_name_return'] = $language['button_name_return'];       
            
            $dataPage['news'] = $newsData;
        } else {
            $dataPage['news'] = '';
        }
        

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_newsPage'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();
        
        return true;
    }

    public function actionNews($page = 1)
    {
        $language = Registry::get('language')->getLanguage('news');
        $image    = Registry::get('image');
        
        $formRegister = $this->components->load('controllers_catalog_formRegisterController');
        
        $dataPage['form_register']  = $formRegister;
        $dataPage['text_news_h1']   = $language['text_news_h1'];
        
        $limitNews = 5;

        if ((int)$page != 0) {
            $newsParam = array(
                'limit' => $limitNews,
                'page'  => $page
            );

            $news = $this->components->load('models_catalog_news');
        } else {
            Errors::err404();
        }
        $newsList   = $news->getNews($newsParam);
        $newsTotal  = $news->getNewsTotal();

        $newsPage = array();
        
        if ($newsList) {
            foreach ($newsList as $k => $vNews) {
                $newsPage[] = array(
                    'id'                    => $vNews['news_id'],
                    'title'                 => $vNews['news_title'],
                    'text'                  => htmlspecialchars_decode($vNews['news_text'], ENT_QUOTES),
                    'date'                  => Date::getDate($vNews['news_date']),
                    'meta_date'             => Date::getDate($vNews['news_date'],"Y-m-d"),
                    'text_meta_author'      => $language['text_meta_author'],
                    'meta_logo'             => $image->resize(LOGO),  
                    'category'              => $vNews['news_category_name'],
                    'href'                  => Router::getUrlLink('/news-' . $vNews['news_id']),
                    'text_category_name'    => $language['text_category_name'],
                    'button_name'           => $language['button_name'],
                );
            }
            $dataPage['news'] = $newsPage;
        } else {
            $dataPage['news'] = '';
        }
        
        // Паттерн для пангинации
        $pattern = array(       
        '~/page-[0-9]+~',
        '~/[0-9]+~'
        );
        // Ключ URL для формирования ссылки
        $keyUrl = 'page-';
        
        $dataPage['pagination_nav'] = (new Pagination($newsTotal, (int)$page, (int)$limitNews, $keyUrl, $pattern))->get();

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_newsList'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();
        
        return true;
    }
}