<?php


class Database
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_name = 'hangman2';
    private $db_pass = '';
    private $conn = null;
    private $data = [];
    public function __construct()
    {
        $this->connect();
    }
    public function connect()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }
    public function disconnect()
    {
    }
    public function select($query)
    {
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->data[] = $row;
            }
        }
        return $this;
    }
    public function get()
    {
        return $this->data;
    }
    public function first()
    {
        return $this->data[0];
    }
    public function update($table, $data, $conditions)
    {
        $fields = $this->implodeDBValues($data);
        $conditions = $this->implodeDBConditions($conditions, ' AND ');
        $query = "UPDATE $table SET $fields WHERE $conditions";
        $result = mysqli_query($this->conn, $query);
        return true;
    }
    public function delete($table, $conditions)
    {
        $conditions = $this->implodeDBConditions($conditions, ' AND ');
        $query = "DELETE FROM $table WHERE $conditions";
        $result = mysqli_query($this->conn, $query);
        return true;
    }
    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $columns = '(' . implode(', ', $keys) . ')';
        $values = implode(", ", array_map(array($this, 'escape'), $data));
        $query = "INSERT INTO $table $columns VALUES ($values)";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return $this->select('SELECT * FROM ' . $table . ' WHERE id = ' . mysqli_insert_id($this->conn))->first();
        }
    }

    private function escape($string)
    {
        return is_numeric($string) ? $string : "'" . mysqli_real_escape_string($this->conn, $string) . "'";
    }

    private function implodeDBConditions($data, $glue = ', ')
    {
        $fields_query = [];
        foreach ($data as $row) {
            $value = $this->escape($row[2]);
            $operator = $row[1];
            $column = $row[0];
            $fields_query[] = $column . ' ' . $operator . ' ' . $value;
        }
        $fields = implode($glue, $fields_query);
        return $fields;
    }

    private function implodeDBValues($data, $glue = ', ')
    {
        $fields_query = [];
        foreach ($data as $column => $value) {
            $value = $this->escape($value);
            $fields_query[] = $column . ' = ' . $value;
        }
        $fields = implode($glue, $fields_query);
        return $fields;
    }

    public function max($table, $column, $conditions)
    {
        $conditions = $this->implodeDBConditions($conditions, ' AND ');
        $query = "SELECT MAX($column) FROM $table WHERE $conditions";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row[0];
        }
        return 0;
    }

}