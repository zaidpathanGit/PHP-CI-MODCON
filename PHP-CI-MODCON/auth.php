<?php
    /**
     * Code to define auth class for security functionalities
     */

     class auth
     {
        /**
        * Method to restrict api from unauthorized access.
        */
            
        public function authAPI()
        {
            /**
             * Code to redirect user if get request is found because this method only supports post method
             */

            if($_SERVER['REQUEST_METHOD'] == "GET")
            {
                header('HTTP/1.1 401 Unauthorized');
                exit("[{'response':'Unauthorized access'}]");
            }
            
            /**
             * Code to redirect user if post request is found but post contains no values
             */

            if(count($_POST) == 0)
            {
                header('HTTP/1.1 401 Unauthorized');
                exit("[{'response':'Unauthorized access'}]");
            }
        }
     }
?>