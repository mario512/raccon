<?php
class EditCurrencyController extends Admin
{
    private $components;
    private $language;
    private $image;

    public function __construct()
    {
        self::isAdmin();
        $this->components   = Registry::get('load');
        $this->language     = Registry::get('language');
        $this->image        = Registry::get('image');
    }

    public function actionEditImg()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES) {
            $resultImg = $this->image->resize($this->image->uploadImg($_FILES), 40, 40);
            echo json_encode(array(
                'status'    => 'success',
                'html'      => $resultImg
            ));
            return true;
        }
    }

    public function addCurrencyData(&$currencyModel, $mode)
    {

        $err = array();

        $dataCurrency = array();

        if (isset($_POST['inputName']) && !empty($_POST['inputName'])) {
            $dataCurrency['currency_name'] = $_POST['inputName'];
        } else {
            $err['input_name'] = 'err_inputName';
        }
        if (isset($_POST['inputNameToken']) && !empty($_POST['inputNameToken'])) {
            $dataCurrency['currency_token'] = $_POST['inputNameToken'];
        } else {
            $err['input_name_token'] = 'err_inputNameToken';
        }
        if (isset($_POST['inputCurrencyCat']) && !empty($_POST['inputCurrencyCat'])) {
            $dataCurrency['currency_cat'] = $_POST['inputCurrencyCat'];
        } else {
            $err['input_currency_cat'] = 'err_inputCurrencyCat';
        }
        if (isset($_POST['inputInOut'])) {
            $dataCurrency['currency_in_out'] = $_POST['inputInOut'];
        } else {
            $err['input_in_out'] = 'err_inputInOut';
        }
        if (isset($_POST['inputLogo']) && !empty($_POST['inputLogo'])) {
            $dataCurrency['currency_logo'] = '/bank/' . $_POST['inputLogo'];
        } else {
            $err['input_logo'] = 'err_inputLogo';
        }
        if (isset($_POST['inputRandom']) && !empty($_POST['inputRandom'])) {
            $dataCurrency['currency_random'] = $_POST['inputRandom'];
        } else {
            $err['input_random'] = 'err_inputRandom';
        }
        if (isset($_POST['inputWallet']) && !empty($_POST['inputWallet'])) {
            $dataCurrency['currency_wallet'] = $_POST['inputWallet'];
        } else {
            $err['input_wallet'] = 'err_inputWallet';
        }
        switch ($mode) {
            case 'new':
                if (isset(Session::get()->user_all_data['currency_id_new'])) {
                    $dataCurrency['currency_id'] = Session::get()->user_all_data['currency_id_new'];
                } else {
                    $err['currency_id'] = 'err_currency_id';
                }
                break;
            case 'edit':
                if (isset(Session::get()->user_all_data['currency_id_new'])) {
                    $dataCurrency['currency_id'] = Session::get()->user_all_data['currency_id_new'];
                } else {
                    $err['currency_id'] = 'err_currency_id';
                }
                break;
        }
        if (!$err) {
            $result = $currencyModel->insertUpdateCurrencyData($dataCurrency, $mode);
            if ($result) {
                switch ($mode) {
                    case 'new':
                        header("Location: /admin-currency/");
                        break;
                    case 'edit':
                        header("Refresh: 0");
                        break;
                }
            }
        } else {
            return $err;
        }
        return true;
    }

    public function actionEdit($mode = '', $currencyId = 1)
    {

        
        $language = $this->language->getLanguage('currency', true);

        $dataPage['href_return'] = Router::getUrlLink('/admin-currency/');
        $dataPage['href_img']    = $this->image->resize('arrow-left.png', 30, 30);
        $dataPage['text_label_currency_name'] = $language['text_label_currency_name'];
        $dataPage['text_help_currency_name'] = $language['text_help_currency_name'];
        $dataPage['text_label_token_name'] = $language['text_label_token_name'];
        $dataPage['text_help_token_name'] = $language['text_help_token_name'];
        $dataPage['text_label_currency_category'] = $language['text_label_currency_category'];
        $dataPage['text_option_select_category'] = $language['text_option_select_category'];
        $dataPage['text_help_currency_category'] = $language['text_help_currency_category'];
        $dataPage['text_label_exchange_direction'] = $language['text_label_exchange_direction'];
        $dataPage['text_option_select_direction'] = $language['text_option_select_direction'];
        $dataPage['text_help_exchange_direction'] = $language['text_help_exchange_direction'];
        $dataPage['text_label_currency_logo'] = $language['text_label_currency_logo'];
        $dataPage['text_help_currency_logo'] = $language['text_help_currency_logo'];
        $dataPage['text_label_random_range'] = $language['text_label_random_range'];
        $dataPage['text_help_random_range'] = $language['text_help_random_range'];
        $dataPage['text_label_wallet'] = $language['text_label_wallet'];
        $dataPage['text_help_wallet'] = $language['text_help_wallet'];
        $dataPage['text_button_save'] = $language['text_button_save'];
        $dataPage['text_button_delete'] = $language['text_button_delete'];
        $dataPage['text_confirm_delete'] = $language['text_confirm_delete'];
        
        $dataPage['url_image_edit'] = Router::getUrlLink('/admin-currency-edit-img/');
        
        $currencyModel = $this->components->load('models_catalog_currency');

        if (isset($_POST['mode']) && $_POST['mode'] == 'delete') {
            $currencyModel->delCurrency($currencyId);
            echo json_encode(array('url' => Router::getUrlLink('/admin-currency/')));
            exit;
        }

        if ($mode == strval('edit')) {

            $dataPage['currency_id']     = $currencyId;
            $dataPage['text_title_edit'] = $language['text_title_edit'];

           
            if ($currencyId != 0) {
                
                $resultCurrrency = $currencyModel->getCurrencyById((int)$currencyId);

                $dataPage['currency_id']            = $resultCurrrency['currency_id'];
                $dataPage['currency_name']          = $resultCurrrency['currency_name'];
                $dataPage['currency_code']          = $resultCurrrency['currency_code'];
                $dataPage['currency_category_code'] = $resultCurrrency['currency_category_code'];
                $dataPage['currency_image_name']    = basename($resultCurrrency['currency_image'], PHP_EOL);
                $dataPage['currency_image']         = $this->image->resize($resultCurrrency['currency_image'], 40, 40);
                $dataPage['currency_wallet']        = $resultCurrrency['currency_wallet'];
                $dataPage['currency_rand_min_max']  = $resultCurrrency['currency_rand_min_max'];
                $dataPage['href_form']              = Router::getUrlLink('/admin-currency-edit/mode-edit/id-' . $currencyId);
                
                Session::setData('currency_id_new', $dataPage['currency_id']);
                
                $resultCurrrencyCategory = array_merge($currencyModel->getCategoryCurrency(0), $currencyModel->getCategoryCurrency(1));

                if ($resultCurrrencyCategory) {
                    foreach ($resultCurrrencyCategory as $category) {
                        $categoryData[] = array(
                            'currency_cat_id'           => $category['currency_cat_id'],
                            'currency_cat_name'         => $category['currency_cat_name'],
                            'currency_cat_code'         => $category['currency_cat_code'],
                            'currency_cat_by_currency'  => ($category['currency_cat_code'] == $resultCurrrency['currency_category_code']) ? 'selected value="'
                                . $category['currency_cat_code'] . '"' : 'value="'
                                . $category['currency_cat_code'] . '"'
                        );
                    }
                    $dataPage['currency_category'] = $categoryData;
                } else {
                    $dataPage['currency_category'] = false;
                }

                $resultCurrencyInOut = $currencyModel->getCurrencyInOut();

                if ($resultCurrencyInOut) {
                    foreach ($resultCurrencyInOut as $inOut) {
                        $inOutData[] = array(
                            'currency_in_out_id' => $inOut['currency_in_out_id'],
                            'currency_in_out_name' => $inOut['currency_in_out_name'],
                            'currency_in_out_active' => ($inOut['currency_in_out_id'] == $resultCurrrency['currency_in_out']) ? 'selected value="'
                                . $inOut['currency_in_out_id'] . '"' : 'value="'
                                . $inOut['currency_in_out_id'] . '"'
                        );
                    }
                    $dataPage['currency_in_out'] = $inOutData;
                } else {
                    $dataPage['currency_in_out'] = false;
                }
                if ($_POST) {
                    $this->addCurrencyData($currencyModel, strval($mode));
                }
            } else {
                $resultCurrrency = false;
            }
        } else if ($mode == strval('new')) {
            
            $dataPage['text_title_edit']        = $language['text_title_new'];
            $dataPage['currency_id']            = ((int)$currencyModel->getLastCurrencyId() + 1);
            $dataPage['currency_name']          = '';
            $dataPage['currency_code']          = '';
            $dataPage['currency_category_code'] = '';
            $dataPage['currency_image_name']    = '';
            $dataPage['currency_image']         = $this->image->resize('bank/no-image-icon.png', 40, 40);
            $dataPage['currency_wallet']        = '';
            $dataPage['currency_rand_min_max']  = '';
            $dataPage['href_form']              = Router::getUrlLink('/admin-currency-edit/mode-new/');

            Session::setData('currency_id_new', $dataPage['currency_id']);

            $resultCurrrencyCategory = array_merge($currencyModel->getCategoryCurrency(0), $currencyModel->getCategoryCurrency(1));

            if ($resultCurrrencyCategory) {
                foreach ($resultCurrrencyCategory as $category) {
                    $categoryData[] = array(
                        'currency_cat_id'           => $category['currency_cat_id'],
                        'currency_cat_name'         => $category['currency_cat_name'],
                        'currency_cat_code'         => $category['currency_cat_code'],
                        'currency_cat_by_currency'  => 'value="'. $category['currency_cat_code'] . '"',
                    );
                }
                $dataPage['currency_category'] = $categoryData;
            } else {
                $dataPage['currency_category'] = false;
            }

            $resultCurrencyInOut = $currencyModel->getCurrencyInOut();

            if ($resultCurrencyInOut) {
                foreach ($resultCurrencyInOut as $inOut) {
                    $inOutData[] = array(
                        'currency_in_out_id' => $inOut['currency_in_out_id'],
                        'currency_in_out_name' => $inOut['currency_in_out_name'],
                        'currency_in_out_active' => 'value="' . $inOut['currency_in_out_id'] . '"'
                    );
                }
                $dataPage['currency_in_out'] = $inOutData;
            } else {
                $dataPage['currency_in_out'] = false;
            }
            if ($_POST) {
                $this->addCurrencyData($currencyModel, strval($mode));
            }
        } 


        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_editCurrency', 'admin'));

        $this->components->load('controllers_admin_footerController')->getFooter();

        return true;
    }
}
