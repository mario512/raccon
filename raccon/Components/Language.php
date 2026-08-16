<?php

class Language implements ArrayAccess
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
            $languagePatch = $this->resolveLanguagePath([
                ROOT . '/Views/Admin/locale/' . $this->languageCode . '/' . ucfirst($fileName) . '.php',
                ROOT . '/Views/Admin/Language/' . $this->languageCode . '/' . ucfirst($fileName) . '.php',
            ]);
        } else {
            $languagePatch = $this->resolveLanguagePath([
                ROOT . '/Views/Catalog/' . THEME . '/locale/' . $this->languageCode . '/' . ucfirst($fileName) . '.php',
            ]);
        }

        if ($languagePatch && is_file($languagePatch)) {
            $langData = include $languagePatch;
            if (is_array($langData)) {
                $this->languageValue = array_merge($this->languageValue ?? [], $langData);
            }
        } else {
            $this->languageValue = [];
        }

        return $this;
    }

    private function resolveLanguagePath(array $paths): ?string
    {
        foreach ($paths as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
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
        if (is_array($this->languageValue) && array_key_exists($key, $this->languageValue)) {
            return $this->languageValue[$key];
        } else {
            return $key;
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return is_array($this->languageValue) && array_key_exists($offset, $this->languageValue);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_array($this->languageValue)) {
            $this->languageValue = [];
        }

        if ($offset === null) {
            $this->languageValue[] = $value;
        } else {
            $this->languageValue[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        if (is_array($this->languageValue)) {
            unset($this->languageValue[$offset]);
        }
    }
}
