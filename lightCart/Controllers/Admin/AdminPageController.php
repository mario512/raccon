<?php

class AdminPageController extends Admin
{

    private $components;
    private $language;
    private $image;
    
    public function __construct()
    {
        self::isAdmin();
        $this->components   = Registry::get('load');
        $this->language     = Registry::get('language');
        $this->image        = Registry::get('image');    
    }
    
    public function actionGetOrders()
    {
        $language = $this->language->getLanguage('currency',true);
        
        $dataPage['text_title_orders']      = $language['text_title_orders'];
        $dataPage['text_title_table']       = $language['text_title_table'];
        $dataPage['text_title_orders_list'] = $language['text_title_orders_list'];
        $dataPage['text_table_name']        = $language['text_table_name'];
        $dataPage['text_table_code']        = $language['text_table_code'];
        $dataPage['text_table_in_out']      = $language['text_table_in_out'];
        $dataPage['text_title_show']        = $language['text_title_show'];
        $dataPage['text_title_of']          = $language['text_title_of'];
        $dataPage['text_table_wallet']      = $language['text_table_wallet'];
        $dataPage['text_table_summ']        = $language['text_table_summ'];
        $dataPage['text_table_status']      = $language['text_table_status'];
        $dataPage['text_table_date']        = $language['text_table_date'];
        
        $dataPage['text_title_of']          = $language['text_title_of'];
        
        $orderModel = $this->components->load('models_catalog_order');

        $resultOrders = $orderModel->getOrders();
        
        if ($resultOrders) {
            foreach ($resultOrders as $order) {
                $orderData[] = array(
                    'order_id'      => $order['order_id'],
                    'order_cur_in'  => $order['order_cur_in'],
                    'order_sum'     => $order['order_sum'],
                    'order_wallet'  => $order['order_wallet'],
                    'order_status'  => $order['order_status'],
                    'order_hash_id' => $order['order_hash_id'],
                    'order_cur_out' => $order['order_cur_out'],
                    'order_date'    => $order['order_date']
                );
            }
            $dataPage['orders'] = $orderData;
        } else {
            $dataPage['orders'] = false;
        }
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_order', 'admin'));
        
        $this->components->load('controllers_admin_footerController')->getFooter();
        
        return true;
    }

    public function actionCategory()
    {
        $language = $this->language->getLanguage('currency',true);
        
        $dataPage['text_title_page']        = $language['text_title_page'];
        $dataPage['text_title_table']       = $language['text_title_table'];
        $dataPage['text_table_name']        = $language['text_table_name'];
        $dataPage['text_table_code']        = $language['text_table_code'];
        $dataPage['text_table_in_out']      = $language['text_table_in_out'];
        $dataPage['text_title_show']        = $language['text_title_show'];
        $dataPage['text_title_of']          = $language['text_title_of'];
        
        $dataPage['href_return'] = Router::getUrlLink('/admin-currency/');
        $dataPage['href_img']    = $this->image->resize('arrow-left.png', 30, 30);

        $modelCategory = $this->components->load('models_catalog_currency'); 
        
        $resultCaregory = array_merge($modelCategory->getCategoryCurrency(0), $modelCategory->getCategoryCurrency(1));
        
        if ($resultCaregory) {
            foreach ($resultCaregory as $category) {
                $dataCategory[] = array(
                    'currency_cat_id'       => $category['currency_cat_id'],
                    'currency_cat_name'     => $category['currency_cat_name'],
                    'currency_cat_code'     => $category['currency_cat_code'],
                    'currency_cat_in_out'   => $category['currency_cat_in_out'],
                    'currency_cat_fine'     => $category['currency_cat_fine']
                );
            }
            $dataPage['currency_category'] = $dataCategory;
        } else {
            $dataPage['currency_category'] = false;
        }
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_currencyCategory', 'admin'));
        
        $this->components->load('controllers_admin_footerController')->getFooter();

        return true;
    }

    public function actionCurrency()
    {
       
        $language = $this->language->getLanguage('currency',true);

        $dataPage['text_title_page']        = $language['text_title_page'];
        $dataPage['text_title_coin']        = $language['text_title_coin'];
        $dataPage['text_table_name']        = $language['text_table_name'];
        $dataPage['text_table_wallet']      = $language['text_table_wallet'];
        $dataPage['text_table_code']        = $language['text_table_code'];
        $dataPage['tetx_table_category']    = $language['tetx_table_category'];
        $dataPage['text_table_in_out']      = $language['text_table_in_out'];
        $dataPage['text_title_show']        = $language['text_title_show'];
        $dataPage['text_title_of']          = $language['text_title_of'];
        $dataPage['href_new']               = Router::getUrlLink('/admin-currency-edit/mode-new/');
        $dataPage['href_new_icon']          = $this->image->resize('add-new.png', 40, 40);

        $modelCurrency = $this->components->load('models_catalog_currency');

        $resultCurrency  = array_merge($modelCurrency->getCurrency(0), $modelCurrency->getCurrency(1));
        
        if ($resultCurrency) {
            foreach ($resultCurrency as $currency) {
                $dataCurrency[] = array(
                    'currency_id'               => $currency['currency_id'],
                    'currency_name'             => $currency['currency_name'],
                    'currency_code'             => $currency['currency_code'],
                    'currency_category_code'    => $currency['currency_category_code'],
                    'currency_image'            => $this->image->resize($currency['currency_image'], 30 , 30),
                    'currency_wallet'           => $currency['currency_wallet'],
                    'currency_in_out'           => $currency['currency_in_out'],
                    'currency_rand_min_max'     => $currency['currency_rand_min_max'],
                    'currency_edit_img'         => $this->image->resize('edit.png',30, 30),
                    'currency_href_edit'        => Router::getUrlLink('/admin-currency-edit/mode-edit/id-' . $currency['currency_id']),
                ); 
            }
            $dataPage['currency'] = $dataCurrency;
        } else {
            $dataPage['currency'] = false;
        }
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_currency', 'admin'));
        
        $this->components->load('controllers_admin_footerController')->getFooter();
        return true;

    }
    
    public function ActionIndex()
    {
        
        
        $this->components->load('controllers_admin_headerController')->getHeader();

        include_once(Template::get('site_index', 'admin'));
        
        $this->components->load('controllers_admin_footerController')->getFooter();

        return true;
    }
    
    public function actionExit()
    {
        User::logout();
        return true;
    }
}
