<?php
    
    class user
    {
        private $name;
        private $address;
        private $phone_no;
        private $reg_no;
        private $email; 
        private $password;

        public function __get($property)
        {
            if(property_exists($this, $property))
            {
                return $this->$property;
            }
        }

        public function __set($property, $value)
        {
            if(property_exists($this, $property))
            {
                $this->$property = $value;
            }
            return $this;
        }

    }
    
?>