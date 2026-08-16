<?php

class Language
{
    private $languageCode;
    private $languageValue;

    public function __construct($languageCode)
    {
        $this->languageCode = $languageCode;
    }

    public function getLanguageId()
    {

        $db     = Registry::get('db');
        $query  = 'SELECT * FROM language WHERE code = "' . $this->languageCode . '"';
        $result = $db->query($query)->row;

        if ($result) {
            return $result['language_id'];
        } else {
            return [];
        }
    }

    public function getLanguage($fileName, $isAdmin = false)
    {
        if ($isAdmin) {
            $languagePatch = ROOT . '/Views/Admin/locale/' . $this->languageCode . '/' . ucfirst($fileName) . '.php';
        } else {
            $languagePatch = ROOT . '/Views/Catalog/' . THEME . '/locale/' . $this->languageCode . '/' . ucfirst($fileName) . '.php';
        }

        if (is_file($languagePatch)) {
            $langData = include $languagePatch;
            if (is_array($langData)) {
                $this->languageValue = array_merge($this->languageValue ?? [], $langData);
            }
        } else {
            $this->languageValue = [];
        }

        return $this;
    }


    public function getLanguagePlugins($fileName)
    {

        $languagePatch = ROOT . '/Plugins/locale/' . ucfirst($fileName) . '_' . ucfirst($this->languageCode) . '.php';
        if (is_file($languagePatch)) {
            return include_once $languagePatch;
        }
    }

    public function getLanguageSystem()
    {
        $languagePatch = ROOT . '/Config/locale_' . LANGUAGE_CODE . '.php';
        if (is_file($languagePatch)) {
            return include_once $languagePatch;
        }
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->languageValue)) {
            return $this->languageValue[$key];
        } else {
            return $key;
        }
    }
}
