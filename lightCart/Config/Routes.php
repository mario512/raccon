<?php

return array(
    //'parse-reviews'         => 'parser/parseReviews',
    // admin route
    'admin-user-edit'                                   => 'editUserData/edit',
    'admin-currency-edit-img'                           => 'editCurrency/editImg',
    'admin-currency-edit/mode-([a-z]+)/id-([0-9]+)'     => 'editCurrency/edit/$1/$2',
    'admin-currency-edit/mode-([a-z]+)'                 => 'editCurrency/edit/$1',
    'admin-orders-list'                                 => 'adminPage/getOrders',
    'admin-currency'                                    => 'adminPage/currency',
    'admin-category'                                    => 'adminPage/category',
    'admin-control-panel'                               => 'adminPage/index',
    'admin-exit'                                        => 'adminPage/exit',
    'admin-login'                                       => 'login/checkUser',
    // catalog route
    'exchange/confirm-([a-z]+)'  => 'exchange/statusOrder/$1',
    'exchange/add-order'         => 'exchange/addOrder',
    'exchange/go-check'          => 'exchange/goCheckExchange',
    'exchange/go-exchange'       => 'exchange/goExchange',
    'currency/price-([a-zA-Z]+)' => 'currency/getCurrencyOut/$1',
    'currency/check'             => 'currency/checkForm',          
    'currency/board'             => 'currency/getВoard',
    'news/page-([0-9]+)'         => 'news/news/$1',
    'news-([0-9]+)'              => 'news/newsById/$1',
    'news'                       => 'news/news',
    'captcha'                    => 'captcha/captcha',
    'reviewsAddAjax'             => 'reviews/addReviews',
    'reviews/page-([0-9]+)'      => 'reviews/reviews/$1',
    'reviews'                    => 'reviews/reviews',
    'tarifs'                     => 'tarifs/tarifs',
    'tos'                        => 'site/tos',
    'notice'                     => 'site/notice',
    'feedbackAddAjax'            => 'site/addFeedback',
    'feedback'                   => 'site/feedback',
    '404'                        => '',
    'index.([a-z]+)'             => 'site/index',
    ''                           => 'site/index'
);
