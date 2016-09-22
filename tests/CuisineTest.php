<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    $server = 'mysql:host=localhost:8889;dbname=cuisine_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $name = 'Italian';
            $test_cuisine = new Cuisine($name);
            $expected_output = $test_cuisine;

            //Act
            $test_cuisine->save();

            //Assert
            $cuisines_in_db = Cuisine::getAll();
            $result = $cuisines_in_db[0];
            $this->assertEquals($expected_output, $result);
        }

        function testGetAll()
        {
            //Arrange
            $name = 'Italian';
            $name2 = 'Chinese';
            $name3 = 'American';
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();
            $test_cuisine3 = new Cuisine($name3);
            $test_cuisine3->save();

            $expected_output = [$test_cuisine, $test_cuisine2, $test_cuisine3];

            //Act
            $result = Cuisine::getAll();

            //assertEquals
            $this->assertEquals($expected_output, $result);
            // $this->tearDown();
        }

        function testDeleteAll()
        {
            //Arrange
            $name = 'Italian';
            $name2 = 'Chinese';
            $name3 = 'American';
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();
            $test_cuisine3 = new Cuisine($name3);
            $test_cuisine3->save();
            $expected_output = [];

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Asserts
            $this->assertEquals($expected_output, $result);
            // $this->tearDown();
        }

    }


 ?>
