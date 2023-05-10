<?php
    class Conexao{
        private $host = 'localhost';
        private $user = 'root';
        private $dbName = 'php';
        private $pass = 'tads';
        private $port = '3306';
        private $pdo;

        public function __construct(){
            try{
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName};port={$this->port}",$this->user, $this->pass);
            }catch(PDOException $e){
                echo "Erro de acesso ao banco de dados ".$e->getMessage();
            }
        }

        public function insert($cliente){
            $stmt = $this->pdo->prepare("INSERT INTO cliente (name, phone, email) VALUES (:name, :phone, :email);");
            $stmt->bindValue(":name", $cliente->getName());
            $stmt->bindValue(":phone", $cliente->getPhone());
            $stmt->bindValue(":email", $cliente->getEmail());
            $stmt->execute();
        }

        public function update($cliente){
            $stmt = $this->pdo->prepare("UPDATE cliente SET name=:name, phone=:phone, email=:email WHERE id = :id;");
            $stmt->bindValue(":name", $cliente->getName());
            $stmt->bindValue(":phone", $cliente->getPhone());
            $stmt->bindValue(":email", $cliente->getEmail());
            $stmt->bindValue(":id", $cliente->getId());
            $stmt->execute();
        }

        
        public function delete($cliente){
            $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id;");
            $stmt->bindValue(":id", $cliente->getId());
            $stmt->execute();
        }

        public function selectAll(){
            $stmt = $this->pdo->query("SELECT * FROM cliente;");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function select($id){
            $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE id = ?;");
            $stmt->bindParam(1,$id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}
?>