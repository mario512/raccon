<?php

class Language
{
    private $languageCode;

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
            $languagePatch = ROOT . '/Views/Admin/Language/' . $this->languageCode . '/' . ucfirst($fileName) . '.php';
        } else {
            $languagePatch = ROOT . '/Views/Catalog/' . THEME . '/Language/' . $this->languageCode . '/' . ucfirst($fileName) . '.php';
        }
        if (is_file($languagePatch)) {
            return include $languagePatch;
        }
    }

    public function getLanguagePlugins($fileName)
    {

        $languagePatch = ROOT . '/Plugins/Language/' . ucfirst($fileName) . '_' . ucfirst($this->languageCode) . '.php';
        if (is_file($languagePatch)) {
            return include_once $languagePatch;
        }
    }
    
    public function getLanguageSystem()
    {
        $languagePatch = ROOT . '/Config/Language_' . LANGUAGE_CODE . '.php';
        if (is_file($languagePatch)) {
            return include_once $languagePatch;
        }
    }
}
