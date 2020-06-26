<?php
    namespace App\Http\DTM;

    Class MyConnection{

        public static function createConnectionS1(){
            $server = "localhost:3306";
            $username = "sapcorusers1";
            $password = "sapcor123";
            $dbname = "sapcors1";

            try{


            $con = new \PDO("mysql:host=$server;dbname=$dbname", $username, $password);
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $con;

            }catch(PDOException $e){
                echo "Connection Failed: ".$e->getMessage();
            }

        }

        public static function createConnectionS2(){
            $server = "localhost:3306";
            $username = "sapcorusers2";
            $password = "sapcor123";
            $dbname = "sapcors2";

            try{


            $con = new \PDO("mysql:host=$server;dbname=$dbname", $username, $password);
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $con;

            }catch(PDOException $e){
                echo "Connection Failed: ".$e->getMessage();
            }

        }

        public static function createConnectionS3(){
            $server = "localhost:3306";
            $username = "sapcorusers3";
            $password = "sapcor123";
            $dbname = "sapcors3";

            try{


            $con = new \PDO("mysql:host=$server;dbname=$dbname", $username, $password);
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $con;

            }catch(PDOException $e){
                echo "Connection Failed: ".$e->getMessage();
            }

        }
    }