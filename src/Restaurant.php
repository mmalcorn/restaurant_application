<?php

    class Restaurant
    {
        private $name;
        private $description;
        private $id;

        function __construct($name, $description, $id=null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
        }

    }

 ?>
