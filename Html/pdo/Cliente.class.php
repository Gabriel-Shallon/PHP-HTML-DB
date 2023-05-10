<?php
    class Cliente{
        private $id;
        private $name;
        private $email;
        private $phone;

        public function __construct($name,$email,$phone,$id=null){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
        }
        public function getName()
        {
                return $this->name;
        }
        public function getEmail()
        {
                return $this->email;
        }
        public function getPhone()
        {
                return $this->phone;
        }
        public function getId()
        {
                return $this->id;
        }
    }
?>