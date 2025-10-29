<?php

class CurrencyController
{
    private $image;
    private $currencyModels;

    public function __construct()
    {
        $this->image            = Registry::get('image');
        $this->currencyModels   = Registry::get('load')->load('models_catalog_currency');
    }

    public function getMinMaxSumm()
    {
        $explode = explode('-', MIN_MAX_SUMM);
        return array(
            'min' => $explode[0],
            'max' => $explode[1]
        );
    }

    public function getCategoryCurrency($inOut = 0)
    {
        $result = $this->currencyModels->getCategoryCurrency($inOut);
        if ($result) {
            foreach ($result as $categoryCurrency) {
                $category[] = array(
                    'currency_cat_id'   => $categoryCurrency['currency_cat_id'],
                    'currency_cat_code' => $categoryCurrency['currency_cat_code'],

                );
            }
            return $category;
        } else {
            return [];
        }
    }

    public function getCurrency($inOut = 0)
    {
        $result = $this->currencyModels->getCurrency($inOut);
        if ($result) {
            foreach ($result as $currency) {
                $dataCurrency[] = array(
                    'currency_id'               => $currency['currency_id'],
                    'currency_name'             => $currency['currency_name'],
                    'currency_code'             => $currency['currency_code'],
                    'currency_category_code'    => $currency['currency_category_code'],
                    'currency_image'            => $this->image->resize($currency['currency_image'], 28, 28),
                    'currency_rand_min_max'     => $currency['currency_rand_min_max'],
                    'currency_min_summ'         => $this->getMinMaxSumm()['min'],
                    'currensy_max_summ'         => $this->getMinMaxSumm()['max']
                );
            }
            return $dataCurrency;
        } else {
            return [];
        }
    }


    public function actionGetВoard()
    {
        echo json_encode(array(
            'status' => 'success',
            'html' => 'asdasdas'
        ));

        return true;
    }

    public function actionGetCurrencyOut($codeCurrency = '')
    {
        $result = $this->getCurrency(1);

        $html = '';

        foreach ($result as $currency) {

            switch ($currency['currency_category_code']) {
                case 'USD':
                    $price = ($codeCurrency == 'USDT') ? number_format(CurrencyPrice::getCryptoPrice('BUSD' . 'USDT'), 2, ',', ' ') : number_format(CurrencyPrice::getCryptoPrice($codeCurrency . 'USDT'), 2, ',', ' ');
                    break;
                case 'EUR':
                    if (CurrencyPrice::getCryptoPrice($codeCurrency . 'EUR')) {
                        $price = number_format(CurrencyPrice::getCryptoPrice($codeCurrency . 'EUR'), 2, ',', ' ');
                    } else {
                        continue 2;
                    }
                    break;
                case 'RUB':
                    if (CurrencyPrice::getCryptoPrice($codeCurrency . 'RUB')) {
                        $price = number_format(CurrencyPrice::getCryptoPrice($codeCurrency . 'RUB'), 2, ',', ' ');
                    } else {
                        $price = number_format((CurrencyPrice::getCryptoPrice($codeCurrency . 'USDT') * CurrencyPrice::getCryptoPrice('USDTRUB')), 2, ',', ' ');
                    }
                    break;
                default:
                    $price = CurrencyPrice::getCryptoPrice($codeCurrency . 'USDT');
            }

            $html .= '<a href="asdas" class="js_exchange_link js_item_right js_item_right_' . $currency['currency_category_code'] . '" data-direction-id="' . $currency['currency_id'] . '" data-currency-code="' . $currency['currency_category_code'] . '" data-currency="' . $currency['currency_code'] . '">';
            $html .=    '<div class="xtt_one_line_right flex vcenter">';
            $html .=        '<div class="flex left vcenter">';
            $html .=            '<div class="xtt_one_line_ico">';
            $html .=                '<div class="currency_logo"><span style="background-image: url(' . $currency['currency_image'] . ');"></span></div>';
            $html .=            '</div>';
            $html .=            '<div class="xtt_one_line_name_right">';
            $html .=                '<div class="xtt_one_line_name">';
            $html .=                    $currency['currency_name'];
            $html .=                '</div>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=        '<div class="xtt_one_line_reserv_right">';
            $html .=            '<div class="xtt_one_line_reserv">';
            $html .=                '<span class="js_check_reserve" data-reserve="" data-rate="' . $price . '">' . $price . '</span>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .= '</a>';
        }

        echo json_encode(array(
            'status' => 'success',
            'html' => $html
        ));

        return true;
    }

    public function actionCheckForm()
    {
        if ($_POST) {
            $err        = array();
            $response   = array();

            if ($_POST['sum']) {
                $summ = $_POST['sum'];
            } else {
                $summ = false;
            }
            if ($_POST['cur_out_id']) {
                $currencyIdOut = $_POST['cur_out_id'];
            } else {
                $currencyIdOut = false;
            }
            if ($_POST['dej']) {
                $inputId = $_POST['dej'];
            } else {
                $inputId = false;
            }
            if ($_POST['cur_in']) {
                $currencyCodeIn = $_POST['cur_in'];
            } else {
                $currencyCodeIn = false;
                $err['cur_in'] = 'not cur in';
            }
            if ($_POST['cur_out']) {
                $currencyCodeOut = $_POST['cur_out'];
            } else {
                $currencyCodeOut = false;
                $err[($inputId == 1) ? 'sum2' : 'sum1'] = '<span class=\"js_amount\" data-id=\"sum1\">Выберите валюту получения</span>';
            }

            if ($summ && $currencyCodeIn && $currencyCodeOut && $inputId) {
                
                switch ($currencyCodeOut) {
                    case 'USD':
                        $price = ($currencyCodeIn == 'USDT') ? CurrencyPrice::getCryptoPrice('BUSD' . 'USDT') : CurrencyPrice::getCryptoPrice($currencyCodeIn . 'USDT');
                        $fee   = FEE_EXCHANGE;
                        if ($inputId == 1) {
                            $minIn  = round(($this->getMinMaxSumm()['min'] / $price), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] / $price), 4, 2);
                        } else {
                            $minIn  = round(($this->getMinMaxSumm()['min'] * $price), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] * $price), 4, 2);
                        }
                        break;
                    case 'RUB':
                        $getPriceRub = CurrencyPrice::getCryptoPrice($currencyCodeIn . 'RUB');
                        if ($getPriceRub) {
                            $price = $getPriceRub;
                        } else {
                            $price = (CurrencyPrice::getCryptoPrice($currencyCodeIn . 'USDT') * CurrencyPrice::getCryptoPrice('USDTRUB'));
                        }
                        $fee = FEE_EXCHANGE * CurrencyPrice::getCryptoPrice('USDTRUB');
                        $currPrice = ($currencyCodeIn == 'USDT') ? CurrencyPrice::getCryptoPrice('BUSD' . 'USDT') : CurrencyPrice::getCryptoPrice($currencyCodeIn . 'USDT');
                        if ($inputId == 1) {
                            $minIn  = round(($this->getMinMaxSumm()['min'] / $currPrice), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] / $currPrice), 4, 2);
                        } else {
                            $minIn  = round(($this->getMinMaxSumm()['min'] * $price), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] * $price), 4, 2);
                        }
                        break;
                    case 'EUR':
                        $getPriceEur = CurrencyPrice::getCryptoPrice($currencyCodeIn . 'EUR');
                        if ($getPriceEur) {
                            $price = $getPriceEur;
                        }
                        $fee   = FEE_EXCHANGE;
                        if ($inputId == 1) {
                            $minIn  = round(($this->getMinMaxSumm()['min'] / $price), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] / $price), 4, 2);
                        } else {
                            $minIn  = round(($this->getMinMaxSumm()['min'] * $price), 4, 2);
                            $maxIn  = round(($this->getMinMaxSumm()['max'] * $price), 4, 2);
                        }
                        break;
                    
                }
                
                if ($inputId == 1) {
                    $total2 = floatval($summ) * floatval($price);
                    $total1 = $summ;
                    $totalC = $total2 - $fee;
                    if ($total1 < $minIn ) {
                        $err['sum1'] = '<span class=\"js_amount\" data-id=\"sum1\">Минимальная сумма: ' . $minIn . '</span>';
                    } 
                    if ($total1 > $maxIn) {
                        $err['sum1'] = '<span class=\"js_amount\" data-id=\"sum1\">Максимальная сумма: ' . $maxIn . '</span>';
                    }
                } else {
                    $total1 = $summ / $price;
                    $total2 = $summ;
                    $totalC = $total1 - $fee;
                    if ($total2 < $minIn ) {
                        $err['sum2'] = '<span class=\"js_amount\" data-id=\"sum1\">Минимальная сумма: ' . $minIn . '</span>';
                    } 
                    if ($total2 > $maxIn) {
                        $err['sum2'] = '<span class=\"js_amount\" data-id=\"sum1\">Максимальная сумма: ' . $maxIn . '</span>';
                    }
                }

                $status         = 'succsess';
                $statusCode     = 0;
                $statusText     = 'Без ошибок';
                $html           = '';
                $cursHtml       = 1 . ' ' . $currencyCodeIn . ' = ' . number_format(($price) ? $price : 0, 2, ',', ' ') . ' ' . $currencyCodeOut;
                $sum1           = round($total1,4,2);
                $sum2           = round($total2,2,2);
                $sum2c          = round($totalC,2,2);
                $vivCom2        = 1;
                $comisText2     = 'Комиссия с операции: ' . round($fee, 2, 2) . ' ' . $currencyCodeOut;

                if (!$err) {
                    $orderData = array(
                        'cur_code_in'   => $currencyCodeIn,
                        'cur_id_out'    => $currencyIdOut,
                        'summ_in'       => $summ,
                        'summ_out'      => $totalC,
                        'date'          => Date::getDateTime(),
                        'hash'          => hash('sha256', Session::get()->session_id)
                    );
                    Session::setData('exchange_data', $orderData);
                } else {
                    Session::setData('exchange_data', false);
                }

            } else {
                switch ($inputId) {
                    case 1:
                        $total1 = $summ;
                        $total2 = 0;
                        break;
                    case 2:
                        $total1 = 0;
                        $total2 = $summ;
                        break;
                }
                $status         = '';
                $statusCode     = 1;
                $statusText     = 'Ошибка';
                $html           = '';
                $comisText2     = '';
                $cursHtml       = '';
                $sum1           = round($total1,4,2);
                $sum2           = round($total2,2,2);
                $sum2c          = 0;
                $vivCom2        = 0;
            }

        }
        
        $response = array(
            'status'        => $status,
            'html'          => $html,
            'sum1'          => $sum1,
            'sum2'          => $sum2,
            'sum2c'         => $sum2c,
            'comis_text2'   => $comisText2,
            'status_text'   => $statusText,
            'status_code'   => $statusCode,
            'error_fields'  => $err,
            'viv_com2'      => $vivCom2,
            'response'      => '',
            'curs_html'     => $cursHtml,
        );

        echo json_encode($response);

        return true;
    }
}
