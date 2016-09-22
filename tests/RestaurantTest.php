<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    $server = 'mysql:host=localhost:8889;dbname=cuisine_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $name = 'Chao House of Xu';
            $description = 'Chinese food with a twist';
            $id = 1;
            $cuisine_id = null;
            $expected_output = $id;
            $test_restaurant = new Restaurant($name, $description, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function testSave()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $name = 'Spaghetti Warehouse of Mista Geranimo';
            $description = 'This warehouse of lovely Italian pasta is all you can ever dream of and more.';
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $description, $cuisine_id);
            $test_restaurant->save();
            $expected_output = $test_restaurant;
            print "\nCuisine ID: \n ";
            var_dump($cuisine_id);
            print("\n");

            //Create a new cuisine instance

            //Act
            // print "test restaurant \n";
            // var_dump($test_restaurant);
            // print "\n";

            //Assert
            $restaurants_in_db = Restaurant::getAll();
            // print "Restaurant \n";
            // var_dump($restaurants_in_db);
            // print "\n";
            $result = $restaurants_in_db[0];
            $this->assertEquals($expected_output, $result);
        }


    }


 ?>
