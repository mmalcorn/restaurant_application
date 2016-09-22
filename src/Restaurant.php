<?php

    class Restaurant
    {
        private $name;
        private $description;
        private $id;
        private $cuisine_id;

        function __construct($name, $description, $cuisine_id=null, $id=null)
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
            return (int) $this->id;
        }

        function getCuisineId()
        {
            return (int) $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurant (name, description, cuisine_id) VALUES ('{$this->getName()}', '{$this->getDescription()}', {$this->getCuisineId()});");

            print "\nRestaurant Name: \n ";
            var_dump($this->getName());
            print("\n");

            print "\nRestaurant Description: \n ";
            var_dump($this->getDescription());
            print("\n");

            print "\nCuisine ID: \n ";
            var_dump($this->getCuisineId());
            print("\n");

            $this->id = $GLOBALS['DB']->lastInsertId();

            // print "\nRestaurant Saved: \n ";
            // var_dump($this);
            // print("\n");
            //
            // print "\nLast Insert: \n ";
            // var_dump($GLOBALS['DB']->lastInsertId());
            // print("\n");
        }

        static function getAll()
        {
            $restaurants = array();
            $database_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
            // print "Database Restaurant get All \n";
            // var_dump($database_restaurants);
            // print "\n";
            if ($database_restaurants)
            {
                $database_data = $database_restaurants->fetchAll();
                // print "Database FetchAll \n";
                // var_dump($database_data);
                // print "\n";

                for ($restaurant_index = 0; $restaurant_index < count($database_data); $restaurant_index++)
                {
                    print "Yo we in the database_db \n";
                    $name = $database_data[$restaurant_index]['name'];
                    $description = $database_data[$restaurant_index]['description'];
                    $cuisine_id = $database_data[$restaurant_index]['cuisine_id'];
                    // print "Cuisine ID \n";
                    // var_dump($cuisine_id);
                    // print "\n";
                    $id = $database_data[$restaurant_index]['id'];
                    $current_restaurant = new Restaurant($name, $description, $cuisine_id, $id);
                    $restaurants[] = $current_restaurant;
                }
            }
                return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurant;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            for ($restaurant_index = 0; $restaurant_index < count($restaurants); $restaurant_index++)
            {
                $current_id = $restaurants[$restaurant_index]->getId();
                if($current_id == $search_id){
                    return $restaurants[$restaurant_index];
                }
            }
            if (!$found_restaurant)
            {
                print("Could not find cuisine with id:" . $search_id . "\n");
            }
            return $found_restaurant;
        }

    }

 ?>
