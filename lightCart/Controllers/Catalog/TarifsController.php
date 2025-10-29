<?php
class TarifsController
{
    private $components;
    private $image;
    private $currencyModel;

    public function __construct()
    {
        $this->components       = Registry::get('load');
        $this->image            = Registry::get('image');
        $this->currencyModel    = $this->components->load('models_catalog_currency');
    }

    public function getAllPrice()
    {
        $resultCerrencyIn = $this->currencyModel->getCurrency(0);
        $resultCerrencyOut = $this->currencyModel->getCurrency(1);

        if ($resultCerrencyIn && $resultCerrencyOut) {
            foreach ($resultCerrencyIn as $inKey => $currencyIn) {

                $priceIn = ($currencyIn['currency_code'] == 'USDT') ? CurrencyPrice::getCryptoPrice('BUSDUSDT') : CurrencyPrice::getCryptoPrice($currencyIn['currency_code'] . 'USDT');

                foreach ($resultCerrencyOut as $outKey => $currencyOut) {

                    switch ($currencyOut['currency_category_code']) {
                        case 'USD':
                            $priceOut = 1;
                            break;
                        case 'RUB':
                            $priceOut = CurrencyPrice::getCryptoPrice('USDTRUB');
                            break;
                        case 'EUR':
                            $priceOut = CurrencyPrice::getCryptoPrice('EURUSDT');
                            break;
                    }

                    $dataCurrencyOut[$outKey] = array(
                        'name_out'      => $currencyOut['currency_name'],
                        'code_out'      => $currencyOut['currency_category_code'],
                        'image_out'     => $this->image->resize($currencyOut['currency_image'], 28, 28),
                        'price'         => round($priceIn * $priceOut, 2, 2),
                    );
                }
                $dataCurrencyIn[$currencyIn['currency_code']] = array(
                    'name_in'       => $currencyIn['currency_name'],
                    'code_in'       => $currencyIn['currency_code'],
                    'image_in'      => $this->image->resize($currencyIn['currency_image'], 28, 28),
                    'multiplicity'  => 1,
                    'price_in'      => $priceIn,
                    'data_in'       => $dataCurrencyOut
                );
            }

            return $dataCurrencyIn;
        } else {
            return false;
        }
    }

    public function actionTarifs()
    {
        $formRegister = $this->components->load('controllers_catalog_formRegisterController');

        $language   = Registry::get('language')->getLanguage('index');
        $language  += Registry::get('language')->getLanguage('reviews');

        $dataPage['text_tarifs_title']      = $language['text_tarifs_title'];
        $dataPage['text_title_form_left']   = $language['text_title_form_left'];
        $dataPage['text_summ_in']           = $language['text_summ_in'];
        $dataPage['text_h1_reviews']        = $language['text_h1_reviews'];
        $dataPage['text_teb_currency_all']  = $language['text_teb_currency_all'];

        $resultCurrencyCategory = $this->currencyModel->getCategoryCurrency();

        if ($resultCurrencyCategory) {
            foreach ($resultCurrencyCategory as $category) {
                $categoryData[] = array(
                    'currency_cat_id' => $category['currency_cat_id'],
                    'currency_cat_code' => $category['currency_cat_code'],
                    'currency_cat_name' => $category['currency_cat_name'],
                );
            }
            $dataPage['currency_category'] = $categoryData;
        } else {
            $dataPage['currency_category'] = false;
        }

        $resultReviews = $this->components->load('models_catalog_reviews')->getLastReviews(10);

        if ($resultReviews) {
            foreach ($resultReviews as $reviews) {
                $reviewsData[] = array(
                    'reviews_author' => $reviews['reviews_author'],
                    'reviews_text'   => mb_substr(htmlspecialchars_decode($reviews['reviews_text'], ENT_QUOTES), 0, 100) . '...',
                    'reviews_date'   => Date::getDate($reviews['reviews_date'], "d.m.Y")
                );
            }
            $dataPage['reviews'] = $reviewsData;
        } else {
            $dataPage['reviews'] = false;
        }

        $dataPage['form_register'] = $formRegister;

        $dataPage['currency_list'] = $this->getAllPrice();
        
        $dataPage['url_assets'] = Router::getUrlLink(Router::getUrlAsets());

        $this->components->load('controllers_catalog_headerFrontController')->headerAction();

        require_once(Template::get('site_tarifs'));

        $this->components->load('controllers_catalog_footerFrontController')->footerAction();

        return true;
    }
}
