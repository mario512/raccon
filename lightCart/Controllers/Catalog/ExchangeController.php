<?php
class ExchangeController
{
    private $components;
    private $language;
    private $image;

    public function __construct()
    {
        $this->components = Registry::get('load');
        $this->language   = Registry::get('language');
        $this->image      = Registry::get('image');
    }

    public function actionGoCheckExchange()
    {

        if ($_POST) {

            $err = array();

            if ($_POST['cf6'] && User::checkMail($_POST['cf6'])) {
                $userEmail = $_POST['cf6'];
            } else {
                $err['cf6'] = '<span class=\"js_amount\" data-id=\"sum1\">Неправильный Email</span>';
            }

            if ($_POST['account1'] && User::checkText($_POST['account1'])) {
                $userWallet = $_POST['account1'];
            } else {
                $err['account1'] = '<span class=\"js_amount\" data-id=\"sum1\">Укажите адрес кошелька</span>';
            }

            if ($_POST['account2'] && User::checkText($_POST['account2'])) {
                $userCard = $_POST['account2'];
            } else {
                $err['account2'] = '<span class=\"js_amount\" data-id=\"sum1\">Укажите карту получателя</span>';
            }

            if (Session::get()->exchange_data && !$err) {

                Session::setData('exchange_data_wallet', array(
                    'wallet'    => $userWallet,
                    'user_card' => $userCard,
                    'user_mail' => $userEmail
                ));

                $status     = 'succsess';
                $statusCode = 0;
                $statusText = 'Идет обработка...';
                $href       = Router::getUrlLink('/exchange/go-exchange');
            } else {

                $status = 'error';
                $href   = '';
                if (!Session::get()->exchange_data) {
                    $statusText = 'Проверьте суммы платежa';
                    $statusCode = 2;
                    Session::unsetData('exchange_data');
                } else {
                    $statusText = 'Неверно указаны данные';
                    $statusCode = 1;
                    Session::unsetData('exchange_data_wallet');
                }
            }
            echo json_encode(array(
                'status'        => $status,
                'status_text'   => $statusText,
                'status_code'   => $statusCode,
                'error_fields'  => $err,
                'url'           => $href
            ));
        }

        return true;
    }

    public function actionGoExchange()
    {
        if (isset(Session::get()->exchange_data_wallet) && isset(Session::get()->exchange_data)) {

            $language = $this->language->getLanguage('exchange');

            $dataPage['text_title']                 = $language['text_title'];
            $dataPage['text_notice']                = $language['text_notice'];
            $dataPage['text_label_currency_in']     = $language['text_label_currency_in'];
            $dataPage['text_label_summ']            = $language['text_label_summ'];
            $dataPage['text_label_currency_out']    = $language['text_label_currency_out'];
            $dataPage['text_label_account']         = $language['text_label_account'];
            $dataPage['text_title_personal_data']   = $language['text_title_personal_data'];
            $dataPage['text_label_email']           = $language['text_label_email'];
            $dataPage['text_label_tos']             = $language['text_label_tos'];
            $dataPage['text_label_button']          = $language['text_label_button'];

            $dataPage['href_go_order'] = Router::getUrlLink('/exchange/add-order/');

            $currencyCodeIn   = Session::get()->exchange_data['cur_code_in'];
            $currencyIdOut    = Session::get()->exchange_data['cur_id_out'];

            $orderSummIn  = Session::get()->exchange_data['summ_in'];
            $orderSummOut = Session::get()->exchange_data['summ_out'];

            $dataPage['hash'] = Session::get()->exchange_data['hash'];

            $dataPage['user_card']   = Session::get()->exchange_data_wallet['user_card'];
            $dataPage['user_mail']   = Session::get()->exchange_data_wallet['user_mail'];

            $modelCurrency = $this->components->load('models_catalog_currency');

            $currencyIn     = $modelCurrency->getCurrencyByCode($currencyCodeIn);
            $currencyOut    = $modelCurrency->getCurrencyById($currencyIdOut);

            $dataPage['text_h1_page'] = preg_replace(
                array('/#cin/', '/#cout/'),
                array($currencyIn['currency_name'], $currencyOut['currency_name']),
                $language['text_h1_page']
            );

            if ($currencyIn) {
                $dataCurrencyIn = array(
                    'currency_name'     => $currencyIn['currency_name'],
                    'currency_image'    => $this->image->resize($currencyIn['currency_image'], 50, 50)
                );
                $dataPage['currency_in'] = $dataCurrencyIn;
            } else {
                $dataPage['currency_in'] = false;
            }

            if ($currencyOut) {
                $dataCurrencyOut = array(
                    'currency_name'     => $currencyOut['currency_name'],
                    'currency_image'    => $this->image->resize($currencyOut['currency_image'], 50, 50)
                );
                $dataPage['currency_out'] = $dataCurrencyOut;
            } else {
                $dataPage['currency_out'] = false;
            }

            $dataPage['summ_in']    = round($orderSummIn, 2, 2);
            $dataPage['summ_out']   = round($orderSummOut, 2, 2);

            $this->components->load('controllers_catalog_headerFrontController')->headerAction();

            require_once(Template::get('site_exchange'));

            $this->components->load('controllers_catalog_footerFrontController')->footerAction();
        } else {
            Errors::err404();
        }
        return true;
    }

    public function actionAddOrder()
    {
        $language = $this->language->getLanguage('exchange');
        if ($_POST) {
            if (empty($_POST['auto_check'])) {
                echo json_encode(array(
                    'status'      => 'success',
                    'status_code' => '0',
                    'url'         => Router::getUrlLink('/exchange/add-order/')
                ));
            } else {
                if (isset($_POST['auto_check']) && $_POST['auto_check'] == '0') {

                    $status     = 'success';
                    $autoCheck  = 1;

                    $textWarning = $language['text_info_update'];
                    $textButton  = $language['text_button_auto_update_off'];

                    $htmlBlockIns = '<div class="block_check_payment_ins">' .
                                        '<div class="block_check_payment_abs"></div>' .
                                        '<div class="block_check_payment_ins"></div>' .
                                    '</div>';

                    $htmlBlockCheckPaymentHash = '<div class="check_payment_hash" data-time="30" data-hash="' . Session::get()->exchange_data['hash'] . '"></div>';
                } else {

                    $status     = 'success';
                    $autoCheck  = 0;

                    $textWarning = $language['taxt_info_no_update'];
                    $textButton  = $language['text_button_auto_update_on'];

                    $htmlBlockIns               = false;
                    $htmlBlockCheckPaymentHash  = false;
                }
                echo json_encode(array(
                    'status'            => $status,
                    'auto_check'        => $autoCheck,
                    'html_block_ins'    => $htmlBlockIns,
                    'html_block_hash'   => $htmlBlockCheckPaymentHash,
                    'text_info'         => $textWarning,
                    'text_button'       => $textButton
                ));
            }

            
        } else {
            if (isset(Session::get()->exchange_data_wallet) && isset(Session::get()->exchange_data)) {
                
                $dataPage['text_label_num_order']       = $language['text_label_num_order'];
                $dataPage['text_title_indication']      = $language['text_title_indication'];
                $dataPage['text_indication']            = $language['text_indication'];
                $dataPage['text_label_summ_in']         = $language['text_label_summ_in'];
                $dataPage['text_label_summ_out']        = $language['text_label_summ_out'];
                $dataPage['text_warning']               = $language['text_warning'];
                $dataPage['text_label_date']            = $language['text_label_date'];
                $dataPage['text_label_status']          = $language['text_label_status'];
                $dataPage['text_status']                = $language['text_status'];
                $dataPage['text_button_cancel']         = $language['text_button_cancel'];
                $dataPage['text_button_confirm']        = $language['text_button_confirm'];
                $dataPage['text_info_update']           = $language['text_info_update'];
                $dataPage['text_button_auto_update']    = $language['text_button_auto_update_off'];
                $dataPage['text_title']                 = $language['text_title'];
                $dataPage['text_notice']                = $language['text_notice'];

                $dataPage['href_order_succsess']  = Router::getUrlLink('/exchange/confirm-success');
                $dataPage['href_order_cancel']    = Router::getUrlLink('/exchange/confirm-cancel');

                $modelCurrency = $this->components->load('models_catalog_currency');

                $resultCurrency = $modelCurrency->getCurrencyByCode(Session::get()->exchange_data['cur_code_in']);

                $dataPage['wallet'] = $resultCurrency['currency_wallet'];

                $dataPage['hash'] = Session::get()->exchange_data['hash'];

                $currencyCodeIn   = Session::get()->exchange_data['cur_code_in'];
                $currencyIdOut    = Session::get()->exchange_data['cur_id_out'];

                $orderSummIn  = Session::get()->exchange_data['summ_in'];
                $orderSummOut = Session::get()->exchange_data['summ_out'];

                $dataPage['summ_in']    = round($orderSummIn, 2, 2);
                $dataPage['summ_out']   = round($orderSummOut, 2, 2);

                $currencyIn     = $modelCurrency->getCurrencyByCode($currencyCodeIn);
                $currencyOut    = $modelCurrency->getCurrencyById($currencyIdOut);

                $dataPage['currency_in']    = $currencyIn['currency_name'];
                $dataPage['currency_out']   = $currencyOut['currency_name'];

                $dataPage['order_data'] = Date::getDateTime(Date::getDateTime(), "m.d.Y, H:i:s");

                if (Session::get()->order_id) {
                    $dataPage['order_id'] = Session::get()->order_id;
                } else {
                    $orderId = uniqid();
                    $dataPage['order_id'] = $orderId;
                    
                    $orderData = array(
                        'order_cur_in'      => $currencyIn['currency_name'],
                        'order_cur_out'     => $currencyOut['currency_name'],
                        'order_sum'         => $orderSummIn,
                        'order_wallet'      => $resultCurrency['currency_wallet'],
                        'order_date'        => $dataPage['order_data'],
                        'order_status'      => 'undefined',
                        'order_hash_id'     => $dataPage['order_id']
                    );
                   

                    $result = $this->components->load('models_catalog_order')->addOrder($orderData);
                    Session::setData('order_id',      $orderId);
                    Session::setData('order_last_id', $result);
                }
                $this->components->load('controllers_catalog_headerFrontController')->headerAction();

                require_once(Template::get('site_order'));

                $this->components->load('controllers_catalog_footerFrontController')->footerAction();
            } else {
                Errors::err404();
            }
        }

        return true;
    }

    public function actionStatusOrder($data = '')
    {

        if (isset(Session::get()->exchange_data_wallet) && isset(Session::get()->exchange_data)) {
            
            $language = $this->language->getLanguage('exchange');
            
            $dataPage['text_label_num_order']       = $language['text_label_num_order'];
            $dataPage['text_label_currency_in']     = $language['text_label_currency_in'];
            $dataPage['text_label_currency_out']    = $language['text_label_currency_out'];
            $dataPage['text_label_user_card']       = $language['text_label_user_card'];
            $dataPage['text_label_account']         = $language['text_label_account'];
            $dataPage['text_label_date']            = $language['text_label_date'];
            $dataPage['text_label_status']          = $language['text_label_status'];
            $dataPage['text_button_home']           = $language['text_button_home'];

            $dataPage['href_home_page'] = Router::getUrlLink('/');
            
            $orderSummIn  = Session::get()->exchange_data['summ_in'];
            $orderSummOut = Session::get()->exchange_data['summ_out'];
            
            $dataPage['order_id'] = Session::get()->order_id;
            
            $dataPage['summ_in']    = round($orderSummIn, 2, 2);
            $dataPage['summ_out']   = round($orderSummOut, 2, 2);

            $modelCurrency = $this->components->load('models_catalog_currency');

            $currencyCodeIn   = Session::get()->exchange_data['cur_code_in'];
            $currencyIdOut    = Session::get()->exchange_data['cur_id_out'];

            $currencyIn     = $modelCurrency->getCurrencyByCode($currencyCodeIn);
            $currencyOut    = $modelCurrency->getCurrencyById($currencyIdOut);

            $dataPage['currency_in']    = $currencyIn['currency_name'];
            $dataPage['currency_out']   = $currencyOut['currency_name'];

            $dataPage['wallet']     = Session::get()->exchange_data_wallet['wallet'];
            $dataPage['user_card']  = Session::get()->exchange_data_wallet['user_card'];
            
            $time = Date::getTime(Session::get()->exchange_data['date'],"H:i:s");
            $date = Date::getDate(Session::get()->exchange_data['date'],"d.m.Y");
            
            $dataPage['date_time_order'] = $date . ', ' . $time;
        
            if ($data == 'success') {
                $dataPage['text_title_cancel']  = $language['text_title_success'];
                $dataPage['text_title_message'] = $language['text_title_message_success'];
                $dataPage['text_order_status']  = $language['text_order_status_success'];
                $this->components->load('models_catalog_order')->updateStatusOrder(array(
                    'order_id'      => Session::get()->order_id,
                    'order_status'  => $data
                ));
            } else if ($data == 'cancel') {
                $dataPage['text_title_cancel']  = $language['text_title_cancel'];
                $dataPage['text_title_message'] = $language['text_title_message_cancel'];
                $dataPage['text_order_status']  = $language['text_order_status_cancel'];
                $this->components->load('models_catalog_order')->updateStatusOrder(array(
                    'order_id'      => Session::get()->order_id,
                    'order_status'  => $data
                ));
            } else {
                Errors::err404();
            }
            $this->components->load('controllers_catalog_headerFrontController')->headerAction();

            require_once(Template::get('site_confirm'));

            $this->components->load('controllers_catalog_footerFrontController')->footerAction();
            
            Session::destroy();
        } else {
            Errors::err404();
        }
        return true;
    }
}

