<?php

class Database {
    private SQLite3 $db;

    public function __construct($dbPath) {
        $this->db = new SQLite3($dbPath);
    }

    public function query($query) {
        return $this->db->query($query);
    }

    public function queryWithParameters($query, $params) {
        $query = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $dataType = SQLITE3_TEXT;

            if (is_numeric($value)) {
                $dataType = SQLITE3_INTEGER;
            }

            $query->bindValue($key, $value, $dataType);
        }

        return $query->execute();
    }

    public function get($table, $condition = null) {
        $sql = "SELECT * FROM $table";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $this->query($sql);

        $data = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $result = $this->query($sql);

        if($result === false) {
            return false;
        }

        return $this->db->lastInsertRowID();
    }

    public function update($table, $data, $condition) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = '$value'";
        }

        $set = implode(", ", $set);

        $sql = "UPDATE $table SET $set WHERE $condition";

        return $this->query($sql);
    }

    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";

        return $this->query($sql);
    }

    public function __destruct() {
        $this->db->close();
    }
}