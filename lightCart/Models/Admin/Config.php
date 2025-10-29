<?php

class Config
{

    private $Db;

    public function __construct()
    {
        $this->Db = Registry::get('db');
    }

    public function getConfigAll()
    {

        $query = 'SELECT * FROM settints WHERE 1';

        $result = $this->Db->query($query)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getConfigByName($name = '')
    {
        $query = 'SELECT value FROM settints WHERE name = :name';

        $queryParam[] = array(
            'name' => array(
                'data' => $name,
                'type' => PDO::PARAM_STR
            )
        );

        $result = $this->Db->query($query, $queryParam)->row['value'];

        if ($result) {
            return $result;
        } else {
            return;
        }
    }
}
