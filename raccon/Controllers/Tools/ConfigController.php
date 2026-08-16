<?php

class ConfigController
{


    private $config;

    public function __construct()
    {
        $this->config = Registry::get('load')->load('models_admin_config')->getConfigAll();
    }

    public function getSettingsAll()
    {
        $settings = array();
        if (count($this->config) > 0) {
            foreach ($this->config as $key => $value) {
                $settings[$value['name']] = $value['value'];
            }
        }
        return $settings;
    }
}
