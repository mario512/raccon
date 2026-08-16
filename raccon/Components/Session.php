<?php

class Session
{

    public static function start()
    {
        session_start();
    }

    public static function setData($key, $value)
    {
        if (isset(self::get()->session_id) || !empty($key) || !empty($value)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function setUserData($userData)
    {
        if ($userData) {
            $_SESSION['session_id'] = session_id();
            foreach ($userData as $keyName => $valueName) {
                $_SESSION[$keyName] = $valueName;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function get()
    {
        if ($_SESSION) {
            $sessionData = new stdClass();
            $sessionData->user_id               = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
            $sessionData->user_name             = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : false;
            $sessionData->user_phone            = isset($_SESSION['user_phone']) ? $_SESSION['user_phone'] : false;
            $sessionData->user_email            = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : false;
            $sessionData->user_role             = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
            $sessionData->user_logo             = isset($_SESSION['user_logo']) ? $_SESSION['user_logo'] : false;
            $sessionData->session_id            = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : false;
            $sessionData->price_fiat            = isset($_SESSION['price_fiat']) ? $_SESSION['price_fiat'] : false;
            $sessionData->exchange_data         = isset($_SESSION['exchange_data']) ? $_SESSION['exchange_data'] : false;
            $sessionData->order_id              = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : false;
            $sessionData->order_last_id         = isset($_SESSION['order_last_id']) ? $_SESSION['order_last_id'] : false;
            $sessionData->exchange_data_wallet  = isset($_SESSION['exchange_data_wallet']) ? $_SESSION['exchange_data_wallet'] : false;
            $sessionData->price_crypto          = isset($_SESSION['price_crypto']) ? $_SESSION['price_crypto'] : false;
            $sessionData->user_all_data         = isset($_SESSION) ? $_SESSION : false;
            return $sessionData;
        }
    }

    public static function unsetData($keySession, $value = '')
    {
        if (is_array($keySession)) {
            foreach ($_SESSION[$keySession] as $value) {
                unset($_SESSION[$value]);
            }
        } else if(!empty($value)) {
            unset($_SESSION[$keySession][$value]);
        } else {
            unset($_SESSION[$keySession]);
        }
    }

    public static function check()
    {
        if (isset($_SESSION['session_id']) && isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function destroy()
    {
        unset($_SESSION['session_id']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_phone']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_role']);
        unset($_SESSION['session_id']);
        unset($_SESSION['price_fiat']);
        unset($_SESSION['exchange_data']);
        unset($_SESSION['order_id']);
        unset($_SESSION['order_last_id']);
        unset($_SESSION['exchange_data_wallet']);
        unset($_SESSION['price_crypto']);
        unset($_SESSION['user_all_data']);
        session_destroy();
    }
}
