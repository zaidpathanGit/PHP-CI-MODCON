<?php
error_reporting(0);

/**
 * Code to include databaseConfigure file to check database connection status
 */
require_once("databaseConfigure.php");

class ModelGenerator
{
    /**
     * Code to define constructor
     */
    function __construct()
    {
        
    }

    /**
     * Function to generate controller for all the tables from the tableList specified in parameter
     */
    function generateModel($tableList)
    {
        /**
         * Code to check if connection is active or not.
         */
        if($GLOBALS['connection'])
        {
            /**
             * Object of databaseConfigure class to access it's methods
             */
            $databaseConfigureObject = new databaseConfigure($GLOBALS['hostName'], $GLOBALS['databaseUser'], $GLOBALS['databasePassword'], $GLOBALS['databaseName']);

            /**
             * Code to fetch all the tables one by one from the table list specified into the parameter
             */
            for($i=1; $i<count($tableList); $i++)
            { 
                /**
                 * Calling databaseConfigure class method to get all fields of a particular table
                 * specified into the parameter and stroing result into variable.
                 */
                $fieldList = $databaseConfigureObject->getTableFields($tableList[$i]);

                /**
                 * Code to convert fieldList array to parameter format string
                 */
                $insertParameter = "";  $updateParameter = "";
                $insertArrayParameter = "";  $updateArrayParameter = "";
                
                for($j=1; $j < count($fieldList); $j++)
                {
                    /**
                     * Condition to check if we reach to last field of table or not
                     * if reached then else is executed so extra comma and space is 
                     * not added.
                     */
                    if($j != count($fieldList)-1)
                    {
                        $updateParameter = $updateParameter."$".$fieldList[$j].", ";

                        /**
                         * Condition to check if we reach at first field of table or not
                         * if reached then if is not executed so first primary key is skipped.
                         */
                        if($j != 1)
                        {
                            $insertParameter = $insertParameter."$".$fieldList[$j].", ";
                            
                            $insertArrayParameter = "'".$fieldList[$j]."'=>".$insertArrayParameter."$".$fieldList[$j].", ";
                        }
                    }
                    else
                    {
                        $insertParameter = $insertParameter."$".$fieldList[$j];
                        $updateParameter = $updateParameter."$".$fieldList[$j];
                        
                        $insertArrayParameter = $insertArrayParameter."'".$fieldList[$j]."'=>$".$fieldList[$j]."";
                        $updateArrayParameter = $insertArrayParameter;
                    }
                }
                /**
                 * Code to create file with file name as table to generate model name for file.
                 * ucfirst is used to capital the first character of the table name.
                 */
                $file = fopen("./ModelGenerated/".ucfirst($tableList[$i])."Model.php", "w");

                /**
                 * Code to copy the content from the ModelSample file file and write it into newly created file
                 */
                $myfile = fopen("ModelSample.txt", "r");
                
                /**
                 * Code to read one by one line from ModelSample file until the end of file
                 */
                while(!feof($myfile)) {
                    /**
                     * Code to replace the content of file using str_replace function.
                     * Code to write content to a file.
                     * If ModelName is found in line then replace with table name with model postfix and
                     * if MethodName is found in line then replace with table name without model postfix.
                     * if QueryName is found in line then replace with table name
                     */
                    fwrite($file, str_replace("*ModelName*", ucfirst($tableList[$i])."Model", 
                                  str_replace("*MethodName*", ucfirst($tableList[$i])."", 
                                  str_replace("*QueryName*", $tableList[$i]."",
                                  str_replace("*PrimaryKey*", $fieldList[1]."",
                                  str_replace("*InsertParameter*", $insertParameter."",
                                  str_replace("*UpdateParameter*", $updateParameter."",
                                  str_replace("*DeleteParameter*", "$".$fieldList[1]."",
                                  str_replace("*InsertArrayParameter*", $insertArrayParameter.")",
                                  str_replace("*UpdateArrayParameter*", $updateArrayParameter.")",

                                  fgets($myfile)))
                    ))))))));
                }

                /**
                 * Code to close recently opened file
                 */
                fclose($myfile);

                /**
                 * Code to close the file once the writting is done
                 */
                fclose($file);
                
            }
            
            /**
             * Code to display content from ControllerGenerated directory
             */
            echo "The followin files are created in ModelGenerated folder: (Click to download)<hr>";
            $files = scandir("./ModelGenerated");
            
            foreach($files as $f)
            {
                echo "<a href='./ModelGenerated/".$f."' _download> ".$f." </a> <br>";
            }
            
        }
        else
        {
            exit("Execution is stopped due to the database connection error.!");
        }
    }

    /**
     * Function to generate controller for a particular tabel from the table name specified in parameter
     */
    function generateSingleModel($tableName)
    {
        /**
         * Code to check if connection is active or not.
         */
        if($GLOBALS['connection'])
        {
            /**
             * Object of databaseConfigure class to access it's methods
             */
            $databaseConfigureObject = new databaseConfigure($GLOBALS['hostName'], $GLOBALS['databaseUser'], $GLOBALS['databasePassword'], $GLOBALS['databaseName']);
 
                /**
                 * Calling databaseConfigure class method to get all fields of a particular table
                 * specified into the parameter and stroing result into variable.
                 */
                $fieldList = $databaseConfigureObject->getTableFields($tableName);

                /**
                 * Code to convert fieldList array to parameter format string
                 */
                $insertParameter = "";  $updateParameter = "";
                $insertArrayParameter = "";  $updateArrayParameter = "";
                
                for($j=1; $j < count($fieldList); $j++)
                {
                    /**
                     * Condition to check if we reach to last field of table or not
                     * if reached then else is executed so extra comma and space is 
                     * not added.
                     */
                    if($j != count($fieldList)-1)
                    {
                        $updateParameter = $updateParameter."$".$fieldList[$j].", ";

                        /**
                         * Condition to check if we reach at first field of table or not
                         * if reached then if is not executed so first primary key is skipped.
                         */
                        if($j != 1)
                        {
                            $insertParameter = $insertParameter."$".$fieldList[$j].", ";
                            
                            $insertArrayParameter = "'".$fieldList[$j]."'=>".$insertArrayParameter."$".$fieldList[$j].", ";
                        }
                    }
                    else
                    {
                        $insertParameter = $insertParameter."$".$fieldList[$j];
                        $updateParameter = $updateParameter."$".$fieldList[$j];
                        
                        $insertArrayParameter = $insertArrayParameter."'".$fieldList[$j]."'=>$".$fieldList[$j]."";
                        $updateArrayParameter = $insertArrayParameter;
                    }
                }

                /**
                 * Code to create file with file name as table to generate model name for file.
                 * ucfirst is used to capital the first character of the table name.
                 */
                $file = fopen("./ModelGenerated/".ucfirst($tableName).".php", "w");

                /**
                 * Code to copy the content from the ModelSample file file and write it into newly created file
                 */
                $myfile = fopen("ModelSample.txt", "r");
                
                /**
                 * Code to read one by one line from ModelSample file until the end of file
                 */
                while(!feof($myfile)) {
                    /**
                     * Code to replace the content of file using str_replace function.
                     * Code to write content to a file.
                     * If ModelName is found in line then replace with table name with model postfix and
                     * if MethodName is found in line then replace with table name without model postfix.
                     * if QueryName is found in line then replace with table name
                     */
                    fwrite($file, str_replace("*ModelName*", ucfirst($tableName)."Model", 
                                  str_replace("*MethodName*", ucfirst($tableName)."", 
                                  str_replace("*QueryName*", $tableName."",
                                  str_replace("*PrimaryKey*", $fieldList[1]."",
                                  str_replace("*InsertParameter*", $insertParameter."",
                                  str_replace("*UpdateParameter*", $updateParameter."",
                                  str_replace("*DeleteParameter*", "$".$fieldList[1]."",
                                  str_replace("*InsertArrayParameter*", $insertArrayParameter.")",
                                  str_replace("*UpdateArrayParameter*", $updateArrayParameter.")",

                                  fgets($myfile)))
                    ))))))));
                }

                /**
                 * Code to close recently opened file
                 */
                fclose($myfile);

                

                /**
                 * Code to close the file once the writting is done
                 */
                fclose($file);
            
            /**
             * Code to display content from ControllerGenerated directory
             */
            echo "The followin files are created in ModelGenerated folder: (Click to download)<hr>";
            $files = scandir("./ModelGenerated");
            
            foreach($files as $f)
            {
                echo "<a href='./ModelGenerated/".$f."' _download> ".$f." </a> <br>";
            }            
        }
        else
        {
            exit("Execution is stopped due to the database connection error.!");
        }
    }
}

?>