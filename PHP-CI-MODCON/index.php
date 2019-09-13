<?php

require_once("databaseConfigure.php");
require_once("modelGenerator.php");
require_once("controllerGenerator.php");

$obj = new databaseConfigure("localhost","root","password","mydb");

/**
 * Code to get all tables list from the specified database into the parameter.
 */
$tableList = $obj->getAllTables();

echo "<hr>The following tables are available in your database.<hr>";
var_dump($tableList);

/**
 * Code to get fields list from the specified table into the parameter.
 */
$fieldList = $obj->getTableFields($tableList[1]);

/**
 * Make an object of controllerGenerator class to access its methods.
 */
$obj1 = new ControllerGenerator();

/**
 * Call the methods to generate single model or for all the tables available inside your database.
 */
//$obj1->generateSingleController($tableList[1], null); //pass null parameter for default location.
//$obj1->generateController($tableList, "C:\\wamp64\\www\\yourProject\\application\\controllers\\");

/**
 * Make an object of ModelGenerator class to access its methods.
 */
$obj2 = new ModelGenerator();

/**
 * Call the methods to generate single controller. or for all the tables available inside your database.
 */
//$obj2->generateSingleModel($tableList[1], null); //pass null parameter for default location.
//$obj2->generateModel($tableList, "C:\\wamp64\\www\\yourProject\\application\\models\\");

?>