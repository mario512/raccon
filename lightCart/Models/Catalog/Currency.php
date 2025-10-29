<?php
class Currency
{
    private $db;

    public function __construct()
    {
        $this->db = Registry::get('db');
    }

    public function getCategoryCurrency($use = 0)
    {
        $query = 'SELECT currency_cat_id, currency_cat_name, currency_cat_code, currency_cat_in_out, currency_cat_fine '
            . 'FROM currency_category '
            . 'WHERE currency_cat_in_out = :use';

        $queryParam = array(
            'use' => array(
                'data' => $use,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getCurrency($use = 0)
    {
        $query = 'SELECT currency_id, currency_name, currency_code, currency_category_code, currency_image, currency_wallet, currency_in_out, currency_rand_min_max '
            . 'FROM currency '
            . 'WHERE currency_in_out = :use';

        $queryParam = array(
            'use' => array(
                'data' => $use,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getCurrencyByCode($code)
    {
        $query = 'SELECT currency_id, currency_name, currency_code, currency_category_code, currency_image, currency_wallet, currency_in_out, currency_rand_min_max '
            . 'FROM currency '
            . 'WHERE currency_code = :code';

        $queryParam = array(
            'code' => array(
                'data' => $code,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->row;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getCurrencyById($id)
    {
        $query = 'SELECT currency_id, currency_name, currency_code, currency_category_code, currency_image, currency_wallet, currency_in_out, currency_rand_min_max '
            . 'FROM currency '
            . 'WHERE currency_id = :id';

        $queryParam = array(
            'id' => array(
                'data' => $id,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->row;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getCurrencyInOut()
    {
        $query = 'SELECT currency_in_out_id, currency_in_out_name '
            . 'FROM currency_in_out ';

        $result = $this->db->query($query)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getLastCurrencyId()
    {
        $query = 'SELECT MAX(currency_id) as last_id FROM currency';

        $result = $this->db->query($query)->row;

        if ($result) {
            return $result['last_id'];
        } else {
            return [];
        }
    }

    public function insertUpdateCurrencyData($data, $mode = '')
    {
        if ($mode == 'new') {
            $query = 'INSERT INTO currency ( '
                . 'currency_id, '
                . 'currency_name, '
                . 'currency_code, '
                . 'currency_category_code, '
                . 'currency_image, '
                . 'currency_wallet, '
                . 'currency_in_out, '
                . 'currency_rand_min_max'
                . ') VALUES ('
                . ':id, '
                . ':name, '
                . ':code, '
                . ':cat_code, '
                . ':image, '
                . ':wallet, '
                . ':in_out, '
                . ':random '
                . ')';
        } else if ($mode == 'edit') {
            $query = 'UPDATE currency SET '
                . 'currency_id = :id,'
                . 'currency_name = :name, '
                . 'currency_code = :code, '
                . 'currency_category_code = :cat_code, '
                . 'currency_image = :image, '
                . 'currency_wallet = :wallet, '
                . 'currency_in_out = :in_out, '
                . 'currency_rand_min_max = :random '
                . 'WHERE currency_id = :id';
        }
        $queryParam[] = array(
            'id' => array(
                'data' => $data['currency_id'],
                'type' => PDO::PARAM_INT
            ),
            'name' => array(
                'data' => $data['currency_name'],
                'type' => PDO::PARAM_STR_CHAR
            ),
            'code' => array(
                'data' => $data['currency_token'],
                'type' => PDO::PARAM_STR_CHAR
            ),
            'cat_code' => array(
                'data' => $data['currency_cat'],
                'type' => PDO::PARAM_STR_CHAR
            ),
            'image' => array(
                'data' => $data['currency_logo'],
                'type' => PDO::PARAM_STR_CHAR
            ),
            'wallet' => array(
                'data' => $data['currency_wallet'],
                'type' => PDO::PARAM_STR_CHAR
            ),
            'in_out' => array(
                'data' => $data['currency_in_out'],
                'type' => PDO::PARAM_INT
            ),
            'random' => array(
                'data' => $data['currency_random'],
                'type' => PDO::PARAM_STR_CHAR
            )
        );
       $result = $this->db->query($query, $queryParam);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delCurrency($currencyId)
    {
        $query = 'DELETE FROM currency '
        . 'WHERE currency.currency_id = :id';

        $queyParam[] = array(
            'id' => array(
                'data' => $currencyId,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queyParam);
    }
}
