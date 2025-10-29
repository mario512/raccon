<?php

class CurrencyPrice
{
    public static function addPriceToDb($jsonData)
    {
        $db = Registry::get('db');
        $query = 'REPLACE INTO currency_price_crypto (id, currency_price_json) '
        . 'VALUES (1,' . json_encode($jsonData) . ')';
        $db->query($query);
    }

    public static function getPriceToDb()
    {
        $db = Registry::get('db');
        $query = 'SELECT currency_price_json FROM currency_price_crypto WHERE 1';
        $result = $db->query($query)->row;
        if ($result) {
            $dataArr = (array)json_decode($result['currency_price_json'], true);
            return $dataArr;
        } else {
            return [];
        }
    }

    public static function checkTimePrice($priceName)
    {
        if (isset(Session::get()->user_all_data[$priceName])) {
            if ((strtotime(Date::getDateTime()) - strtotime(Session::get()->user_all_data[$priceName]['data_price'])) > 1800) {
                Session::unsetData($priceName);
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function getFiatPrice($code = '')
    {
        if (isset(Session::get()->price_fiat) && self::checkTimePrice('price_fiat')) {
            $result = Session::get()->price_fiat;
        } else {
            $getData    =  Parser::getPageCURl('https://www.cbr-xml-daily.ru/daily_json.js');
            
            $value      = json_decode($getData, true)['Valute'];
            
            $dataSession = array(
                'data_price'    => Date::getDateTime(),
                'price'         => $value
            );
            Session::setData('price_fiat', $dataSession);
            $result = $dataSession;
        }
        if (empty($code)) {
            return $result;
        } else {
            return (isset($result['price'][$code]['Value'])) ? $result['price'][$code]['Value'] : false;
        }
    }

    public static function getCryptoPrice($code = '')
    {
        if (isset(Session::get()->price_crypto) && self::checkTimePrice('price_crypto')) {
            $result = Session::get()->price_crypto;
        } else {
            $getData = Parser::getPageCURl('https://api.binance.com/api/v3/ticker/price');
            if ($getData) {
                $value   = json_decode($getData, true);
                self::addPriceToDb($getData);
                $resultArr = array_column($value, 'price', 'symbol');
            } else {
                $resultArr = array_column(self::getPriceToDb(), 'price', 'symbol');
            }
            $dataSession = array(
                'data_price'    => Date::getDateTime(),
                'price'         => $resultArr
            );
            Session::setData('price_crypto', $dataSession);
                
            $result = $dataSession;
        }

        if (empty($code)) {
            return $result;
        } else {
            return (isset($result['price'][$code])) ? $result['price'][$code] : false;
        }
    }
}
