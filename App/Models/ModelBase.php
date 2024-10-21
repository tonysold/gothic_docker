<?php

namespace App\Models\ModelsBase;

abstract class ModelsBase
{
    protected $db;
    protected $table;
    private $dataResult;

    public function __construct($select = false)
    {
        global $dbObject;

        $this->db = $db;

        $fullModelName = get_class($this);
        $shortModelName = substr($fullModelName, 4);
        $tableName = strtolower($shortModelName);
        $this->table = $tableName;

        $sql = $this->getSelect($select);
        if ($sql) $this->getResult("SELECT * FROM $this->table" . $sql);
    }

    // получить имя таблицы
    public function getTableName()
    {
        return $this->table;
    }

    // получить все записи
    function getAllRows()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    // получить одну запись
    function getOneRow()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    private function getSelect($select)
    {
        if (is_array($select)) {
            $allQuery = array_keys($select);
            array_walk($allQuery, function (&$val) {
                $val = strtoupper($val);
            });

            $querySql = "";
            if (in_array("WHERE", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "WHERE") {
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if (in_array("ORDER", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "ORDER") {
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    private function getResult($sql)
    {
        try {
            $db = $this->db;
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $rows;
    }
}
