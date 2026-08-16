<?php

class Db
{

    private $db;

    public function __construct()
    {

        try {
            $this->db = new PDO(
                "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                USER,
                PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            if ($e->getCode() === 2002 || $e->getCode() === 1044 || $e->getCode() === 1045) {
                error_log("DB Connection failed: " . $e->getMessage());
                exit('<h2>Not Data Base Connection</h2>');
            }
        }
    }

    public function query($query = '', $queryParam = array())
    {
        if ($query) {
            $resultQuery = $this->db->prepare($query);
            if ($queryParam) {

                foreach ($queryParam as $param => $dataParam) {
                    $resultQuery->bindValue(":$param", $dataParam['data'], $dataParam['type']);
                }
                $resultQuery->execute();
            } else {
                $resultQuery->execute();
            }

            $last_id = $this->db->lastInsertId();
            $isSelect = stripos($query, 'SELECT') === 0;

            if ($isSelect) {
                $data = $resultQuery->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = [];
            }

            $result             = new stdClass();
            $result->row        = $data[0] ?? [];
            $result->rows       = $data;
            $result->num_rows   = count($data);
            $result->last_id    = $last_id;

            return $result;
        }
    }

    public function executeMany(string $query, array $batchParams): bool
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($query);

            foreach ($batchParams as $params) {
                foreach ($params as $param => $dataParam) {
                    $stmt->bindValue(":$param", $dataParam['data'], $dataParam['type']);
                }
                $stmt->execute();
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function __destruct()
    {
        $this->db = NULL;
    }
}
