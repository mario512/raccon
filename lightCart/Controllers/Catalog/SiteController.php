<?php
class SiteController
{

    private $components;

    private $image;

    public function __construct()
    {
        $this->components    = Registry::get('load');
        $this->image         = Registry::get('image');
    }


    public function getReserves(&$currencyIn)
    {
        if ($currencyIn) {
            foreach ($currencyIn as $reserve) {
                $result[] = array(
                    'currency_name'     => $reserve['currency_name'],
                    'currency_image'    => $reserve['currency_image'],
                    'currency_reserv'   => Rand::getRand($reserve['currency_rand_min_max']), 
                    'currency_code'     => $reserve['currency_code']
                );
            }
            return $result;
        } else {
            return [];
        }
    }

    public function getLastChange($currencyIn, $currencyOut)
    {

        $randCurrencyIn     = Rand::getRangeArr(9, 0, count($currencyIn) - 1);
        $randCurrencyOut    = Rand::getRangeArr(9, 0, count($currencyOut) - 1);

        $result = array();

        foreach ($randCurrencyIn as $keyIn => $valIn) {

            if ($currencyOut[$randCurrencyOut[$keyIn]]['currency_category_code'] == 'RUB') {
               
                $summRandRub    = rand(780, 780000);
                $summUsd        = (float)$summRandRub / (float)CurrencyPrice::getCryptoPrice('USDTRUB');

                if ($currencyIn[$valIn]['currency_code'] == 'USDT' || $currencyIn[$valIn]['currency_code'] == 'USDC') {
                    $priceCrypto = 1;
                } else {
                    $priceCrypto = CurrencyPrice::getCryptoPrice($currencyIn[$valIn]['currency_code'] . 'USDT');
                }
                $totalOut     = (float)$summUsd / (float)$priceCrypto;

                $totalIn = $summRandRub;
            } else if ($currencyOut[$randCurrencyOut[$keyIn]]['currency_category_code'] == 'EUR') {
                $summRandEur = rand(750, 14000);

                if ($currencyIn[$valIn]['currency_code'] == 'USDT' || $currencyIn[$valIn]['currency_code'] == 'USDC') {
                    $priceCrypto = 1;
                } else {
                    if (CurrencyPrice::getCryptoPrice($currencyIn[$valIn]['currency_code'] . 'EUR')) {
                        $priceCrypto = CurrencyPrice::getCryptoPrice($currencyIn[$valIn]['currency_code'] . 'EUR');
                    } else {
                        $priceCrypto = CurrencyPrice::getCryptoPrice($currencyIn[$valIn]['currency_code'] . 'USDT');
                    }
                }
                $totalOut = (float)$summRandEur / (float)$priceCrypto;

                $totalIn = $summRandEur;
            } else {
                $summRand = rand(750, 14000);

                if ($currencyIn[$valIn]['currency_code'] == 'USDT' || $currencyIn[$valIn]['currency_code'] == 'USDC') {
                    $priceCurrency = 1;
                } else {
                    $priceCurrency = CurrencyPrice::getCryptoPrice($currencyIn[$valIn]['currency_code'] . 'USDT');
                }
                $totalOut = (float)$summRand / (float)$priceCurrency;

                $totalIn = $summRand;
            }

            $result[] = array(
                'date_change'   => Date::getDate(),
                'code_in'       => $currencyIn[$valIn]['currency_code'],
                'image_in'      => $currencyIn[$valIn]['currency_image'],
                'code_cat_out'  => $currencyOut[$randCurrencyOut[$keyIn]]['currency_category_code'],
                'image_out'     => $currencyOut[$randCurrencyOut[$keyIn]]['currency_image'],
                'total_out'     => round($totalOut, 2, PHP_ROUND_HALF_EVEN),
                'total_in'      => round($totalIn, 2, PHP_ROUND_HALF_EVEN)
            );
        }
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function actionIndex()
    {
        
        $language = Registry::get('language')->getLanguage('index');

        $dataPage = array();

        $dataPage['text_title_page_index']          = $language['text_title_page_index'];
        $dataPage['text_title_form_left']           = $language['text_title_form_left'];
        $dataPage['text_fine']                      = $language['text_fine'];
        $dataPage['text_currency_out']              = $language['text_currency_out'];
        $dataPage['text_select_system']             = $language['text_select_system'];
        $dataPage['text_summ_in']                   = $language['text_summ_in'];
        $dataPage['text_summ_fine']                 = $language['text_summ_fine'];
        $dataPage['text_currency_in']               = $language['text_currency_in'];
        $dataPage['text_teb_currency_all']          = $language['text_teb_currency_all'];
        $dataPage['text_calc']                      = $language['text_calc'];
        $dataPage['text_title_аttention']           = $language['text_title_аttention'];
        $dataPage['text_attention']                 = $language['text_attention'];
        $dataPage['text_info_summ_price']           = $language['text_info_summ_price'];
        $dataPage['text_summ_fine_service']         = $language['text_summ_fine_service'];
        $dataPage['text_reserve_currency']          = $language['text_reserve_currency'];
        $dataPage['text_button_get_all']            = $language['text_button_get_all'];
        $dataPage['text_button_hide']               = $language['text_button_hide'];
        $dataPage['text_title_news']                = $language['text_title_news'];
        $dataPage['text_href_news']                 = $language['text_href_news'];
        $dataPage['text_label_reviews']             = $language['text_label_reviews'];
        $dataPage['text_label_href_all_reviews']    = $language['text_label_href_all_reviews'];
        $dataPage['text_change_last_change']        = $language['text_change_last_change'];

        $dataPage['href_reviews'] = Router::getUrlLink('/reviews/');
        
        $currency = $this->components->load('controllers_catalog_currencyController');

        $dataPage['category_currency_out'] = ($currency->getCategoryCurrency(0)) ? $currency->getCategoryCurrency(0) : false;
        
        $dataPage['category_currency_in']  = ($currency->getCategoryCurrency(1)) ? $currency->getCategoryCurrency(1) : false;

        
        $resultCurrencyIn = $currency->getCurrency('0');
        
        $dataPage['currency_in'] = ($resultCurrencyIn) ? $resultCurrencyIn : false;
        
        $resultCurrencyOut = $currency->getCurrency('1');

        $dataPage['currency_out'] = ($resultCurrencyOut) ? $resultCurrencyOut : false;
       
        $dataPage['reserve'] = ($this->getReserves($resultCurrencyIn)) ? $this->getReserves($resultCurrencyIn) : false;
        
        $reviewsResult = $this->components->load('models_catalog_reviews')->getLastReviews(3);

        if ($reviewsResult) {
            foreach ($reviewsResult as $reviews) {
                $reviewsData[] = array(
                    'reviews_id'        => $reviews['reviews_id'],
                    'reviews_author'    => $reviews['reviews_author'],
                    'reviews_text'      => mb_substr(htmlspecialchars_decode($reviews['reviews_text'], ENT_QUOTES),0,100) . '...',
                    'reviews_date'      => Date::getDate($reviews['reviews_date'], "d.m.Y")
                );
            }
            $dataPage['reviews'] = $reviewsData;
        } else {
            $dataPage['reviews'] = '';
        }

        $resultNews = $this->components->load('models_catalog_News')->getLastNews(3);

        if ($resultNews) {
            foreach ($resultNews as $news) {
                $newsData[] = array(
                    'news_id'       => $news['news_id'],
                    'news_title'    => $news['news_title'],
                    'news_text'     => mb_substr(htmlspecialchars_decode($news['news_text'], ENT_QUOTES),0,75) . '...',
                    'news_date'     => Date::getDate($news['news_date'],"d.m.Y"),
                    'news_href'     => Router::getUrlLink('/news-' . $news['news_id'])
                );
            }
            $dataPage['news'] = $newsData;
        } else {
            $dataPage['news'] = '';
        }
        
        $dataPage['form_exchange'] = $this->components->load('controllers_catalog_formExchangeController');
        
        $dataPage['last_data_change'] = ($this->getLastChange($resultCurrencyIn, $resultCurrencyOut)) ? $this->getLastChange($resultCurrencyIn, $resultCurrencyOut) : '';

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_index'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }

    public function actionTos()
    {

        $formRegister = $this->components->load('controllers_catalog_formRegisterController');

        $dataPage['form_register'] = $formRegister;

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_tos'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }

    public function actionNotice()
    {
        $formRegister = $this->components->load('controllers_catalog_formRegisterController');

        $dataPage['form_register'] = $formRegister;

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_notice'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }

    public function actionFeedback()
    {
        $language  = Registry::get('language')->getLanguage('feedback');

        $dataPage['text_feedback_h1']               = $language['text_feedback_h1'];
        $dataPage['text_feedback_form']             = $language['text_feedback_form'];
        $dataPage['text_feedback_name']             = $language['text_feedback_name'];
        $dataPage['text_feedback_email']            = $language['text_feedback_email'];
        $dataPage['text_feedback_id_transaction']   = $language['text_feedback_id_transaction'];
        $dataPage['text_feedback_message']          = $language['text_feedback_message'];
        $dataPage['text_feedback_button']           = $language['text_feedback_button'];
        $dataPage['text_feedback_notice']           = $language['text_feedback_notice'];

        $dataPage['href_form_feedback'] = Router::getUrlLink('/feedbackAddAjax/');

        $formRegister = $this->components->load('controllers_catalog_formRegisterController');

        $dataPage['form_register'] = $formRegister;

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_feedback'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }

    public function actionAddFeedback()
    {

        $language = Registry::get('language')->getLanguage('feedback');

        $errors     = array();
        $userData   = array();

        if (isset($_POST['name'])) {
            $userData['name'] = $_POST['name'];
            if (!User::checkName($_POST['name'])) {
                $errors['error_name'] = $language['error_name'];
            }
        }
        if (isset($_POST['email'])) {
            $userData['email'] = $_POST['email'];
            if (!User::checkMail($userData['email'])) {
                $errors['error_email'] = $language['error_email'];
            }
        }
        if (isset($_POST['exchange_id'])) {
            $userData['hash_id'] = $_POST['exchange_id'];
            if (!User::checkName($userData['hash_id'])) {
                $errors['error_hash_id'] = $language['error_hash_id'];
            }
        }
        if (isset($_POST['text'])) {
            $userData['text'] = $_POST['text'];
            if (!User::checkText($userData['text'])) {
                $errors['error_text'] = $language['error_text'];
            }
        }

        if ($errors) {
            $response['status']         = 'error';
            $response['status_text']    = implode(' / ', $errors);
        } else {
            $response['status']         = 'success';
            $response['status_text']    = $language['success_status_text'];
            $response['clear']          = 'clear';
        }
        // свинина идет пить из макеевского родничка
        echo json_encode($response);
        return true;
    }
}
