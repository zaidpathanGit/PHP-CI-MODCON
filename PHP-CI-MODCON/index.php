<?php

require_once("databaseConfigure.php");
require_once("modelGenerator.php");
require_once("controllerGenerator.php");

$obj = new databaseConfigure("localhost","root","","vnsgu");

/**
 * Code to get all tables list from the specified database into the parameter.
 */
$tableList = $obj->getAllTables();

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
//$obj1->generateSingleController($tableList[1]);
//$obj1->generateController($tableList);

/**
 * Make an object of ModelGenerator class to access its methods.
 */
$obj2 = new ModelGenerator();

/**
 * Call the methods to generate single controller. or for all the tables available inside your database.
 */
//$obj2->generateSingleModel($tableList[1]);
//$obj2->generateModel($tableList);

?>