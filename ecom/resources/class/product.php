<?php

    class product 
    {
        private $name;
        private $category_id;
        private $price;
        private $brand_id;
        private $image; 
        private $size;
        private $description;


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