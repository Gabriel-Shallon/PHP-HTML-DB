<?php
class Conexao {
    private $host = 'localhost'; // Endereço do servidor MySQL
    private $db_name = 'ifmtnovo'; // Nome do banco de dados
    private $username = 'root'; // Usuário do banco de dados
    private $password = 'tads'; // Senha do banco de dados
    private $conn; // Objeto de conexão PDO

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function insert($table, $data) {
        $fields = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        echo $fields . $values;

        $stmt = $this->conn->prepare("INSERT INTO $table ($fields) VALUES ($values)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function delete($table, $field, $value) {
        $stmt = $this->conn->prepare("DELETE FROM $table WHERE $field = :value");
        $stmt->bindParam(':value', $value);
        return $stmt->execute();
    }

    public function update($table, $data, $field, $value) {
        $fields = '';

        foreach ($data as $key => $val) {
            $fields .= "$key = :$key, ";
        }

        $fields = rtrim($fields, ', ');

        $stmt = $this->conn->prepare("UPDATE $table SET $fields WHERE $field = :value");

        foreach ($data as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }

        $stmt->bindParam(':value', $value);

        return $stmt->execute();
    }

    public function select($table, $field, $value) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $field = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAll($table) {
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>