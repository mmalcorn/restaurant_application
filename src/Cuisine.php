<?php

    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES('{$this->getName()}');");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $database_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine");

            $cuisines = array();

            if ($database_cuisines)
            {
                $database_data = $database_cuisines->fetchAll();
                for ($cuisine_index = 0; $cuisine_index < count($database_data); $cuisine_index++)
                {
                    $name = $database_data[$cuisine_index]['name'];
                    $id = $database_data[$cuisine_index]['id'];
                    $new_cuisine = new Cuisine($name, $id);
                    $cuisines[] = $new_cuisine;
                }
                return $cuisines;
            }
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisine;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            for ($cuisine_index = 0; $cuisine_index < count($cuisines); $cuisine_index++)
            {
                $current_id = $cuisines[$cuisine_index]->getId();
                if ($current_id === $search_id) {
                    return $cuisines[$cuisine_index];
                }
            }
            if (!$found_cuisine)
            {
                print("Could not find cuisine with id:" . $search_id . "\n");
            }
            return $found_cuisine;
        }

    }


 ?>
