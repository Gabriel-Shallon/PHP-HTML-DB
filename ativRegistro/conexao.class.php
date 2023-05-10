<?php
    require_once "registro.class.php";

    class conexao{
        private $host = 'localhost';
        private $user = 'root';
        private $dbName = 'registro';
        private $pass = '';
        private $port = 3306;
        private $pdo;

        public function __construct(){
            try{
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName};port={$this->port}",$this->user, $this->pass);
            }catch(PDOException $e){
                echo "Erro de acesso ao banco de dados ".$e->getMessage();
            }
        }


        public function insert($ocorrencia){
            $stmt = $this->pdo->prepare("INSERT INTO usuario (name, phone, email) VALUES (:name, :phone, :email);");
            $stmt->bindValue(":name", $ocorrencia->getName());
            $stmt->bindValue(":phone", $ocorrencia->getPhone());
            $stmt->bindValue(":email", $ocorrencia->getEmail());
            $stmt->execute();
        }

        public function selectALL(){
            $stmt = $this->pdo->query("SELECT * FROM usuario;");
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }


    }



?>