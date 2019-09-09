<?php

require_once("databaseConfigure.php");
require_once("modelGenerator.php");
require_once("controllerGenerator.php");

$obj = new databaseConfigure("localhost","root","","vnsgu");

$tableList = $obj->getAllTables();

$obj1 = new controllerGenerator();
//$obj1->generateSingleController($tableList[2]);
$obj1->generateController($tableList);

$obj2 = new ModelGenerator();
//$obj2->generateSingleModel($tableList[1]);
$obj2->generateModel($tableList);

?>