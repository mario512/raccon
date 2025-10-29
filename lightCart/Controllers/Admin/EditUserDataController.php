<?php
class EditUserDataController extends Admin
{
    public $components;
    public $image;
    
    public function __construct()
    {
        self::isAdmin();
        $this->components   = Registry::get('load');
        $this->image        = Registry::get('image');
    }

    public function edit($data) 
    {
        $userData    = array();
        $err         = array();
        
        if (isset($_POST['inputName']) && !empty($_POST['inputName'])) {
            $userData['name'] = $_POST['inputName'];
        } else {
            $err['inputName'] = 'er_inputName';
        }
        if (isset($_POST['inputLogin']) && !empty($_POST['inputLogin'])) {
            $userData['user_email'] = $_POST['inputLogin'];
        } else {
            $err['inputPass'] = 'err_inputLogin';
        }
        if (isset($_POST['inputPass']) && !empty($_POST['inputPass'])) {
            $userData['password'] = $_POST['inputPass'];
        } else {
            $err['inputPass'] = 'err_inputPass';
        }
        
        if (!$err) {
            if (User::userDataEdit($userData)) {
                User::logout();
                header("Location: " . Router::getUrlLink('/admin-control-panel/'));
            }
        }

    }

    public function actionEdit()
    {
       
        if ($_POST) {
            $this->edit($_POST);
            return true;
        }
        
        $dataPage['href_return']  = Router::getUrlLink('/admin-currency/');;
        $dataPage['text_title_edit'] = '';
        $dataPage['href_img']        = $this->image->resize('arrow-left.png', 30, 30);
        $dataPage['url_image_edit'] = Router::getUrlLink('/admin-currency/');
        
        if (Session::get()->user_email) {
            $dataPage['user_name']  = Session::get()->user_name;
            $dataPage['user_login'] = Session::get()->user_email;
            $dataPage['user_pass']  = '';
        } else {
            $dataPage['user_name']  = '';
            $dataPage['user_login'] = '';
            $dataPage['user_pass']  = '';
        }
        $dataPage['href_form'] = '';
        
       
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_editUserData', 'admin'));

        $this->components->load('controllers_admin_footerController')->getFooter();


        return true;
    }
}