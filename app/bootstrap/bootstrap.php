<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// include main configuration file 
require_once PROJECT_ROOT_PATH . "/bootstrap/config.php";
// include the base controller file 
require_once PROJECT_ROOT_PATH . "/Classes/Controllers/Api/Controller.php";
// include the use model file 
require_once PROJECT_ROOT_PATH . "/Classes/Models/UserModel.php";
?>