<?php

/*
 * ! Do not remove following three lines.
 */
require_once("databaseConfigure.php");
require_once("modelGenerator.php");
require_once("controllerGenerator.php");

/*
 * Make an object of databaseConfigure class and pass parameters to 
 * initialize the database connection with database server.
 */
$obj = new databaseConfigure("ServerName","DbUserName","DbPassword","DatabaseName");

/**
 * Code to get all tables list from the specified database 
 * into the constructor parameter.
 */
$tableList = $obj->getAllTables();

/**
 * Code to get fields list from the specified table into the 
 * constructor parameter.
 */
$fieldList = $obj->getTableFields($tableList[1]); //Table name on $tableList[1] index.

/**
 * Make an object of controllerGenerator class to access its methods.
 */
$obj1 = new controllerGenerator();

/**
 * Call the methods to generate single model or to generate 
 * models for all the tables available inside your database.
 */
$obj1->generateSingleController($tableName); //Pass your database table name as parameter.
$obj1->generateController($tableList); //Pass $tableList as parameter.

/**
 * Make an object of ModelGenerator class to access its methods.
 */
$obj2 = new ModelGenerator();

/**
 * Call the methods to generate single controller or to generate controller 
 * for all the tables available inside your database.
 */

$obj2->generateSingleModel($tableName); //Pass your database table name as parameter.
$obj2->generateModel($tableList); //Pass $tableList as parameter.

?>
