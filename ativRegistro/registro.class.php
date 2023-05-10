<?php

    class registro{
        private $id;
        private $name;
        private $phone;
        private $email;
        private $pso;

        public function __construct($id = null, $name, $phone, $email){
            $this->email = $email;
            $this->phone = $phone;
            $this->name = $name;
        }

        public function getName(){
            return $this->name;
        }
        public function getPhone(){
            return $this->phone;
        }
        public function getEmail(){
            return $this->email;
        }

    }

?>