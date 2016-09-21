<?php

    class Restaurant
    {
        private $name;
        private $description;
        private $id;
        private $cuisine_id;

        function __construct($name, $description, $id=null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (description, cuisine_id) VALUES ('{$this->getDescription()};')");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $restaurants = array();
            $database_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");

            if ($database_restaurants)
            {
                $database_data = $database_restaurants->fetchAll();

                for ($restaurant_index = 0; $restaurant_index < count($database_data); $restaurant_index++)
                {
                    $description = $database_data[$restaurant_index]['description'];
                    $cuisine_id = $database_data[$restaurant_index]['cuisine_id'];
                }
            }
        }



    }

 ?>
