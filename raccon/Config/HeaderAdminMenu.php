<?php
return array(
    'currencys' => array(
        'name' => 'text_menu_currency',
        'href' => 'dashboardsCollapse',
        'parrent' => '0',
        'active' => true,
    ),
    'currency' => array(
        'name' => 'text_menu_currency',
        'href' => '/admin-currency/',
        'parrent' => 'currencys',
        'active' => true,
    ),
    'currency_category' => array(
        'name' => 'text_menu_category',
        'href' => '/admin-category/',
        'parrent' => 'currencys',
        'active' => true,
    ),
    'orders' => array(
        'name' => 'text_menu_orders',
        'href' => '/admin-orders-list/',
        'parrent' => '0',
        'active' => true,
    ),
    'settings' => array(
        'name' => 'text_menu_settings',
        'href' => '/admin-user-edit/',
        'parrent' => '0',
        'active' => true,
    )
);
