<?php
require_once 'templates.php';
require_once 'mysql.php';

class main{
    function __construct(){
        $mysql = new mysql();
        $this->mysql = $mysql;
        $templates = new templates($mysql);
        $this->templates = $templates;
    }
    function switchboard($state){
        $templates = $this->templates;
        switch($state){
            case "home":
                $templates->home();
                break;
        }
    }
}

?>
