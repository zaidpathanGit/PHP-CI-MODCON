<?php
error_reporting(0);

/**
 * Code to create a class to handle database configuration
 */
class databaseConfigure
{
    /**
     * Code to create a constructor to assign database related values to variables
     */
    function __construct($hostName, $databaseUser, $databasePassword, $databaseName)
    {   
        /**
         * Code to define global variables to store database configuration values
         */
        $GLOBALS['connection'] = false;
        $GLOBALS['hostName'] = $hostName;
        $GLOBALS['databaseUser'] = $databaseUser;
        $GLOBALS['databasePassword'] = $databasePassword;
        $GLOBALS['databaseName'] = $databaseName;

        /**
         * Code to perform connection to database and give response to the user about database connectivity.
         */
        $GLOBALS['connection'] = mysqli_connect($GLOBALS['hostName'], $GLOBALS['databaseUser'], $GLOBALS['databasePassword'], $GLOBALS['databaseName']);
        if($GLOBALS['connection'])
        {
            return true;
        }
        else
        {
            exit("Execution is stopped due to the database connection error.!");
        }
    }
    
    /**
     * Function to fetch and display all the tables from specified database
     */
    function getAllTables()
    {
        /**
         * Code to check if connection is active or not.
         */
        if($GLOBALS['connection'])
        {
            /**
             * Code to fetch all the tables from database
             */            
            $result = mysqli_query($GLOBALS['connection'],"SHOW TABLES FROM ".$GLOBALS['databaseName']);

            /**
             * Code to fetch all the tables add tables to the array
             */
            $tablesList = "TableListFrom ".$GLOBALS['databaseName'];
            while($table = mysqli_fetch_row($result))
            {
                /**
                 * Code to concatinate the table names one by one with comma as a delimeter
                 */
                $tablesList = $tablesList.",".$table[0];
            }

            /**
             * Code to convert string to array by using explore function
             */
            $tablesList = explode(',',$tablesList);
            return $tablesList;
        }
        else
        {
            exit("Execution is stopped due to the database connection error.!");
        }
    }

    /**
    * Function to fetch and display all the fields from specified database table
    */
    function getTableFields($tableName)
    {
        /**
         * Code to check if connection is active or not.
         */
        if($GLOBALS['connection'])
        {
            /**
             * Code to fetch all the fields from particular database table
             */            
            $result = mysqli_query($GLOBALS['connection'],"DESCRIBE ".$tableName);

            /**
             * Code to fetch all the tables add tables to the array
             */
            $fieldList = "FieldListFrom ".$tableName;
            while($field = mysqli_fetch_row($result))
            {
                /**fieldList
                 * Code to concatinate the table names one by one with comma as a delimeter
                 */
                $fieldList = $fieldList.",".$field[0];
            }

            /**
             * Code to convert string to array by using explore function
             */
            $fieldList = explode(',',$fieldList);
            return $fieldList;
        }
        else
        {
            exit("Execution is stopped due to the database connection error.!");
        }
    }
}
?>