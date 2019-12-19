# PHP-CI-MODCON

## What's New ??

* Now supports GUI interface to easily perform your task.
* Automatically generates foreign key constraints and designs patterns for join statements.
* More stable than before and fixed minor bugs.

## Introduction

* The PHP is widely used for web development and it also supports some popular frameworks which helps developers to boost the development speed. People who works with [PHP Codeignitor](codeigniter.com/) already knows that the CI framework requires to generate controllers and models manually. So it's a time consuming process to create controllers and models again and again while in development phase.

* Whoohoo!! The `PHP-CI-MODCON` will help you to boost your development speed as it will help you to generate controllers and models in just few seconds with all the CRUD operation methods readymate inside it which is directly available to use with all the neccessory parameter inside it. All you need to do is copy the models and controllers generated by `PHP-CI-MODCON` into your CodeIgnitor project and pass the parameter by calling the methods to perform CRUD operation and many more. Easy right !!  :smiley:


## Pre-Requirements

* Should know basics programming of PHP and OOP.
* `PHP CodeIgnitor` framework setup in your system. Or you can download 
 it from here [Download CodeIgnitor](https://codeigniter.com/download).
* Basics of working with `Controllers` and `Models` in `PHP CodeIgnitor`.
* SQL database (Database tables should contain first field as primary key to use this library).

```
E.g of primary key
employee(empid, empname, deptid) //Right
student(studentid, studentname, deptid) //Right

employee(empname, empid, deptid) //Wrong
student(studentname, studentid, deptid) //Wrong
```

* SQL database (Database tables should contain foreign key name into the following format).

```
E.g of foreign key (Note : foreign key column should be fk_foreignKeyTableName_foreignKeyTablePrimaryKey)

department(departmentid, departmentname)
employee(empid, empname, fk_department_departmentid) //Right

state(sid, sname)
city(cid, cname, fk_state_sid) //Right

department(departmentid, departmentname)
employee(empid, empname, fk_department_deptid) //Wrong

state(sid, sname)
city(cid, cname, fk_sid) //Wrong

```

## Configuration table

* The configuration table represents the avaiable methods inside the library as well as how to use those methods.

| ClassName | MethodName | Parameters | Response |
|-----------|------------|-----------|----------|
| databaseConfigure | constructor() | constructor('hostname','username','password','dbname') | True/False |
| databaseConfigure | getAllDatabases() | No parameters | Collection |
| databaseConfigure | getAllTables() | No parameters | Collection |
| databaseConfigure | getTableFields() | getTableFields('tableName') | Collection |
| ModelGenerator | generateSingleModel() | generateSingleModel('tableName') | File |
| ModelGenerator | generateModel() | generateModel(Collection)  `Collection from getAllTables()` | File |
| ModelGenerator | directoryContent() | No parameters | List of files and directory |
| ControllerGenerator | generateSingleController() | generateSingleController('tableName') | File |
| ControllerGenerator | generateController() | generateController(Collection) `Collection from getAllTables()` | File |
| ControllerGenerator | directoryContent() | No parameters | List of files and directory |



## How to use ??

Step 1. Download the repository (Prefer branch 2.0 for latest update) and unzip or extract the downloaded file and place it inside the `wamp` or `xamp` / `www` folder.

Step 2. Open `index.php` file inside `PHP-CI-MODCON` folder and have a look onto the configuration table for more steps according to your requirement.

Step 3. Run the `localhost` server and run the `PHP-CI-MODCON` project.

Step 4. By default `index.php` will be executed and it will display GUI interface from which you can generate controllers and models according to your selection.

Step 5. Once the execution is completed it will display the directory status about whatever the changes are occured and will display the newly created files onto your browser.

Step 6. Open your CodeIgnitor project and navigate to the `application` folder.

Step 7. Copy the files from `ControllerGenerated` folder and paste it into the `application\controller` folder. Now copy the corresponding models of the controllers from `ModelGenerated` folder and paste it into `application\models` folder.

> Note: It may possible that you have only generated models or only controllers 
so in that case you can skip some instructions from step 7.

Step 8. Now it's time for testing.!! So for test the CRUD functionality 
of the controllers  have a look onto the following table.

| Request URL | Parameters | Form Method | Form Parameter Name | Response | Type |
|-------------|------------|-------------|---------------------|----------|------|
|localhost://projectName/controllerName/ | No parameters | GET/POST | - | Table records in json | JSON |
|localhost://projectName/controllerName/create | Table fields via html form | POST | fieldName=value | True and total affected rows in json | JSON |
|localhost://projectName/controllerName/update | Table fields via html form | POST | fieldName=value | True and total affected rows in json | JSON |
|localhost://projectName/controllerName/delete | Table primary key field via html form | POST | fieldName=value | True/False and affected rows in json | JSON |
|localhost://projectName/controllerName/limit  | Start and end value via html form | POST | start=value&end=value | Table records in json | JSON |
|localhost://projectName/controllerName/select  | Comma(,) seperated field names via html form | POST | fields=field1,field2 | Table records in json | JSON |
|localhost://projectName/controllerName/selectLimit  | Comma(,) seperated field names with Start and end value via html form  | POST | fields=field1,field2&start=value&end=value | Table records in json | JSON |
|localhost://projectName/controllerName/max | Field name via html form | POST | field=fieldname | Table records in json | JSON |
|localhost://projectName/controllerName/min | Field name via html form | POST | field=fieldname | Table records in json | JSON |
|localhost://projectName/controllerName/avg | Field name via html form | POST | field=fieldname | Table records in json | JSON |
|localhost://projectName/controllerName/sum | Field name via html form | POST | field=fieldname | Table records in json | JSON |
|localhost://projectName/controllerName/search | Field name and value in the following format via form | POST | condition?field1=value, field2=value | Table records in json | JSON |
|localhost://projectName/controllerName/searchLike | Field name and value in the following format via form | POST | condition?field1=value,field2=value | Table records in json | JSON |
|localhost://projectName/controllerName/searchNLike  | Field name and value in the following format via form: condition?field1=value, field2=value | POST | condition?field1=value,field2=value | Table records in json | JSON |
|localhost://projectName/controllerName/groupBy | Field name via html form | POST | fields=field1,field2 | Table records in json | JSON |
|localhost://projectName/controllerName/orderBy | Field name via html form | POST | fields=field1,field2 | Table records in json | JSON |
|localhost://projectName/controllerName/distinct | No parameters | GET/POST | - | Table records in json | JSON |


>Note : Form parameter should be same as table fields names inside your database table. 

```HTML
<!--E.g : If table format is like this =>  product(productid, productname, qty, rate) 
then form input element name attribute should also like productid, productname, qty, rate
same as table fields name.-->

<!-- Code to display data -->
<?php
    $ProductData = json_decode($Product,true);

    for ($i=0; $i < count($ProductData[0]['response']); $i++) { 
        echo($ProductData[0]['response'][$i]['productid']." ".$ProductData[0]['response'][$i]['productname']." ".
             $ProductData[0]['response'][$i]['qty']." ".$ProductData[0]['response'][$i]['rate']." "."<br>");
    }
?>

<!-- Form for insert operation -->
<form method="post" action="Product/Insert">
    <input type="text" name="productname">
    <input type="text" name="qty">
    <input type="text" name="rate">
    <input type="submit" value="insert">
</form>

<!-- Form for update operation -->
<form method="post" action="Product/Update">
    <input type="text" name="productid">
    <input type="text" name="productname">
    <input type="text" name="qty">
    <input type="text" name="rate">
    <input type="submit" value="Update">
</form>

<!-- Form for delete operation -->
<form method="post" action="Product/Delete">
    <input type="text" name="productid">
    <input type="submit" value="Delete">
</form>

<!-- Form for pagination or limit operation -->
<form method="post" action="Product/limit">
    <input type="text" name="start">
    <input type="text" name="end">
    <input type="submit" value="Limit">
</form>

<!-- Form for selected column display operation -->
<form method="post" action="Product/select">
    <input type="checkbox" name="fields[]" value="productid">
    <input type="checkbox" name="fields[]" value="productname">
    <input type="checkbox" name="fields[]" value="qty">
    <input type="checkbox" name="fields[]" value="rate">
    <button type="submit" name="btnsubmit">Select</button>
</form>

<!-- Form for selected column display with limit operation -->
<form method="post" action="Product/selectLimit">
    <input type="checkbox" name="fields[]" value="productid">
    <input type="checkbox" name="fields[]" value="productname">
    <input type="checkbox" name="fields[]" value="qty">
    <input type="checkbox" name="fields[]" value="rate">
    <input type="text" name="start">
    <input type="text" name="end">
    <button type="submit" name="btnsubmit">SelectLimit</button>
</form>

<!-- Form for search operation -->
<form method="POST" action="Product/search">
    <input type="text" name="condition">
    <button type="submit">Search</button>
</form>

<!-- Form for search like operation -->
<form method="POST" action="Product/searchLike">
    <input type="text" name="condition">
    <button type="submit">SearchLike</button>
</form>

<!-- Form for search not like operation -->
<form method="POST" action="Product/searchNLike">
    <input type="text" name="condition">
    <button type="submit">SearchNLike</button>
</form>

<!-- Form for groupby operation -->
<form method="POST" action="Product/groupBy">
    <input type="text" name="field">
    <button type="submit">GroupBy</button>
</form>

<!-- Form for orderby operation -->
<form method="POST" action="Product/orderBy">
    <input type="text" name="field">
    <input type="text" name="order">
    <button type="submit">OrderBy</button>
</form>

```

Step 9. Finish.


### Conclusion

Thats all from my side still if you find anything which makes my repository works more better then feel free to tell me. you can also contact on `zaidpathan339@gmail.com` Thank you :smiley:
