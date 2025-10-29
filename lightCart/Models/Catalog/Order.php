<?php
class Order
{
    private $db;

    public function __construct()
    {
        $this->db = Registry::get('db');
    }

    public function addOrder($data = array())
    {
        if ($data) {
            
            extract($data);
            
            $query = 'INSERT INTO orders ( '
            . 'order_cur_in, order_cur_out, order_sum, order_wallet, order_date, order_status, order_hash_id' 
            . ') VALUES ("'
            . $order_cur_in .'", "'
            . $order_cur_out .'", "' 
            . $order_sum . '", "' 
            . $order_wallet . '", "' 
            . Date::getDateTime($order_date, "Y-m-d H:i:s") . '", "'
            . $order_status.'", "' 
            . $order_hash_id . '")';

            $result = $this->db->query($query)->last_id;
            
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function getLastOrderId()
    {
        $query = 'SELECT MAX(order_id) as last_id FROM orders';

        $result = $this->db->query($query)->row;

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function updateStatusOrder($statusData)
    {
        $query = 'UPDATE orders SET order_status = :order_status WHERE order_hash_id = :order_id';

        $queryParam[] = array(
            'order_status' => array(
                'data' => $statusData['order_status'],
                'type' => PDO::PARAM_STR
            ),
            'order_id' => array(
                'data' => $statusData['order_id'],
                'type' => PDO::PARAM_STR
            )
        );

        $this->db->query($query, $queryParam);
    }

    public function getOrders()
    {
        $query = 'SELECT * FROM orders';

        $result = $this->db->query($query)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
}
