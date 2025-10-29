<?php

abstract class Admin
{
    public static function isAdmin()
    {
        if (isset(Session::get()->user_role) && Session::get()->user_role == 'admin') {
            return true;
        } else {
            Registry::get('load')->load('controllers_admin_loginController')->actionLogin();
            die;
        }
    }
}
