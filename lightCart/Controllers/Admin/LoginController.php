<?php
class LoginController
{
    private $language;

    public function __construct()
    {
       $this->language = Registry::get('language')->getLanguage('login', true);
    }

    public function actionLogin()
    {
        
        if (Session::check()) {
            header("Location: /admin-currency/");
        } else {
    
            $dataPage   = array();
            $userData   = array();
            $errors     = array();
    
            $dataPage['href_assets']    = Router::getUrlLink(Router::getUrlAsets(true));
            $dataPage['href_canonical'] = Router::getUrlLink('/admin-currency/');
            $dataPage['href_action']    = Router::getUrlLink('/admin-currency/');
    
            $dataPage['text_title_login']   = $this->language['text_title_login'];
            $dataPage['text_title_massage'] = $this->language['text_title_massage'];
            $dataPage['text_label_email']   = $this->language['text_label_email'];
            $dataPage['text_label_pass']    = $this->language['text_label_pass'];
            $dataPage['text_button']        = $this->language['text_button'];
    
            if (isset($_POST['floatingInput']) && !empty($_POST['floatingInput'])) {
                $userData['email'] = $_POST['floatingInput'];
                if (!User::checkMail($userData['email'])) {
                    $errors[] = $this->language['error_email'];
                }
            }
    
            if (isset($_POST['floatingPassword']) && !empty($_POST['floatingPassword'])) {
                $userData['password'] = $_POST['floatingPassword'];
                if (!User::checkPassword($userData['password'])) {
                    $errors[] = $this->language['error_password'];
                }
            }
    
            if (!$errors && $userData) {
                $user = User::checkUserData($userData);
                if ($user == false) {
                    $errors[] = $this->language['error_user_data'];
                    $dataPage['errors'] = $errors;
                } else {
                    $dataPage['sucsses'] = $this->language['sucsses_login'];
                    if (User::autch($user)) {
                       header("Location: /admin-currency/");
                    }
                }
            } else {
                $dataPage['errors'] = $errors;
                unset($_POST['floatingInput']);
                unset($_POST['floatingPassword']);
                
                Session::destroy();
            }
            include_once(Template::get('site_login', 'admin'));
        }
        return true;
    }

   
}
