<?php
require_once '../vendor/autoload.php';
require_once 'plugins.php';

Flight::map('notFound', array("HTTPErrors", "_404"));
/*Flight::map('error',    array("HTTPErrors", "_500"));*/
Flight::route("/", 'notFound');

Flight::route("GET /news/latest/@page/@country", 
                array("News", "latest"));

/*Flight::route("GET /news/@date/@type/@country", 
                array("news", "date"));

Flight::route("GET /news/@searchterm/@country", 
                array("news", "search"));

Flight::route("GET /news/@category/@page/@country", 
                array("news", "category"));*/

Flight::start();

?>