<?php
class ReviewsController
{
    private $components;

    public function __construct()
    {
        $this->components = Registry::get('load');
    }

    public function actionAddReviews()
    {
        $language = Registry::get('language')->getLanguage('reviews');

        $errors   = array();
        $userData = array();

        // Проверка входных данных с формы
        if (isset($_POST['name'])) {
            $userData['name'] = $_POST['name'];
            if (!User::checkName($userData['name'])) {
                $errors['error_name'] = $language['error_name'];
            }
        }
        if (isset($_POST['email'])) {
            $userData['email'] = $_POST['email'];
            if (!USer::checkMail($userData['email'])) {
                $errors['error_email'] = $language['error_email'];
            }
        }
        if (isset($_POST['text'])) {
            $userData['text'] = $_POST['text'];
            if (!User::checkText($userData['text'])) {
                $errors['error_text'] = $language['error_text'];
            }
        }
        if (isset($_POST['number'])) {
            $userData['captcha'] = $_POST['number'];
            if (!Captcha::validateCaptcha($userData['captcha'])) {
                $errors['error_captcha'] = $language['error_captcha'];
            }
        }

        if ($errors) {
            $response['status']         = 'error';
            $response['status_text']    = implode(' / ', $errors);
            $response['ncapt1']         = Router::getUrlLink('/captcha/');
        } else {
            $response['status']         = 'success';
            $response['status_text']    = $language['success_status_text'];
            $response['clear']          = 'clear';
        }
        // Возвращаемый результат. Свинина идёт нахуй, т.к. отзыв опубликован не будет.
        echo json_encode($response);


        return true;
    }

    public function actionReviews($page = 1)
    {

        $language = Registry::get('language')->getLanguage('reviews');

        $formRegister   = $this->components->load('controllers_catalog_formRegisterController');
        $reviews        = $this->components->load('controllers_catalog_formReviewsController', '10');

        $dataPage['form_register'] = $formRegister;

        $dataPage['text_h1_reviews']            = $language['text_h1_reviews'];
        $dataPage['text_form_reviews']          = $language['text_form_reviews'];
        $dataPage['text_form_your_name']        = $language['text_form_your_name'];
        $dataPage['text_form_your_mail']        = $language['text_form_your_mail'];
        $dataPage['text_form_reviews']          = $language['text_form_reviews'];
        $dataPage['text_captcha_title']         = $language['text_captcha_title'];
        $dataPage['text_form_button_reviews']   = $language['text_form_button_reviews'];

        $dataPage['href_form_reviews'] = Router::getUrlLink('/reviewsAddAjax/');

        $dataPage['captcha'] = Router::getUrlLink('/captcha/');

        $limit = 10;
        
        if ((int)$page != 0) {
            $reviewsParam = array(
                'limit' => $limit,
                'page'  => $page
            );

            $reviews = $this->components->load('models_catalog_reviews');
        } else {
            Errors::err404();
        }
        $reviewsList  = $reviews->getReviews($reviewsParam);
        $reviewsTotal = $reviews->getReviewsTotal();

        $reviewsPage = array();

        if ($reviewsList) {
            foreach ($reviewsList as $review) {
                $reviewsPage[] = array(
                    'id'        => $review['reviews_id'],
                    'author'    => $review['reviews_author'],
                    'text'      => htmlspecialchars_decode($review['reviews_text'], ENT_QUOTES),
                    'meta_text' => htmlspecialchars_decode(mb_substr($review['reviews_text'], 0, 30), ENT_QUOTES),
                    'date'      => Date::getDate($review['reviews_date'], "d.m.Y"),
                    'meta_date' => Date::getDate($review['reviews_date'], "Y-m-d")
                );
            }
            $dataPage['reviews'] = $reviewsPage;
        } else {
            $dataPage['reviews'] = '';
        }
        
        // Паттерн для фармирования ссылки
        $pattern = array(
            '~/page-[0-9]+~',
            '~/[0-9]+~'
        );
        // Папаметр для передачи контроллеру
        $keyUrl = 'page-';
       
        
        // Всего записей ( Получаемых их базы данных)
        $total = $reviewsTotal;

        $dataPage['pagination_nav'] = (new Pagination($total, (int)$page, (int)$limit, $keyUrl, $pattern))->get();

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_reviews'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }
}
