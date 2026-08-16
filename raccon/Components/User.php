<?php

class User
{

    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkText($text)
    {
        if (strlen($text) >= 10) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone)
    {
        $mask = USER_PHONE_MASK;
        $pattern = '/^\\' . $mask . '\d{3}\d{2}\d{2}\d{2}$/';

        if (preg_match($pattern, $phone)) {
            return true;
        }
        return false;
    }

    public static function checkMail($mail)
    {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExist($mail)
    {
        $db = Registry::get('db');

        $query = 'SELECT COUNT(*) email  FROM user WHERE email = :mail';

        $queryParam[] = array(
            'mail' => array(
                'data' => $mail,
                'type' => PDO::PARAM_STR
            )
        );

        $result = $db->query($query, $queryParam)->row;

        if ($result['email'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function userRegister($userData = array())
    {
        if (!empty($userData['name']) && !empty($userData['phone']) && !empty($userData['email']) && !empty($userData['password'])) {

            $db = Registry::get('db');

            $query = 'INSERT INTO user(name, phone, email, password, role, session_id) '
                    .'VALUES '
                    .'(:name, :phone, :email, :password, :role, :session_id)';

            $queryParam[] = array(
                'name' => array(
                    'data' => $userData['name'],
                    'type' => PDO::PARAM_STR
                ),
                'phone' => array(
                    'data' => $userData['phone'],
                    'type' => PDO::PARAM_STR
                ),
                'email' => array(
                    'data' => $userData['email'],
                    'type' => PDO::PARAM_STR
                ),
                'password' => array(
                    'data' => password_hash(html_entity_decode($userData['password'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT),
                    'type' => PDO::PARAM_STR
                ),
                'role' => array(
                    'data' => (isset($userData['role']) ? $userData['role'] : 'user'),
                    'type' => PDO::PARAM_STR
                ),
                'session_id' => array(
                    'data' => '',
                    'type' => PDO::PARAM_STR
                )
            );

            $result = $db->query($query, $queryParam);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function userDataEdit($userData)
    {

        if ($userData['user_email'] && $userData['password'] && $userData['name']) {

            $db = Registry::get('db');

            $query = 'UPDATE user SET '
                . 'name = :user_name, password = :password, role = "admin"'
                . 'WHERE email = :user_email';

            $queryParam[] = array(
                'user_name' => array(
                    'data' => $userData['name'],
                    'type' => PDO::PARAM_STR
                ),
                'password' => array(
                    'data' => password_hash(html_entity_decode($userData['password'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT),
                    'type' => PDO::PARAM_STR
                ),
                'user_email' => array(
                    'data' => $userData['user_email'],
                    'type' => PDO::PARAM_STR
                )
            );

            $result = $db->query($query, $queryParam);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function checkUserData($userData)
    {

        if (!empty($userData['email']) && !empty($userData['password'])) {

            $db = Registry::get('db');

            $query = 'SELECT * FROM user WHERE email = :email';

            $queryParam[] = array(
                'email' => array(
                    'data' => $userData['email'],
                    'type' => PDO::PARAM_STR
                )
            );

            $result = $db->query($query, $queryParam)->row;

            if ($result) {
                if (password_verify(html_entity_decode($userData['password'], ENT_QUOTES, 'UTF-8'), $result['password'])) {
                    return array(
                        'user_id'           => $result['id'],
                        'user_name'         => $result['name'],
                        'user_phone'        => $result['phone'],
                        'user_email'        => $result['email'],
                        'user_role'         => $result['role']                      
                    );
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public static function checkLogget()
    {
        if (Session::check()) {
            return Session::check();
        } else {
            header("Location: /login");
        }
    }

    public static function autch($user)
    {
        if (Session::setUserData($user) != false) {
            return Session::setUserData($user);
        }
    }

    public static function logout($method = false)
    {
        Session::destroy();
        if ($method === false) {
            header("Location: /");
        } else {
            header("Refresh:3");
        }
    }
}
