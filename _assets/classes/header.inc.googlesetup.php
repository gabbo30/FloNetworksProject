<?php
//error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

if (isset($_GET['sess']) ){
    session_id($_GET['sess']);
}
session_start();
header("Cache-control: private");

    $database_name = "photogram";

    // secure class data
    $table_users   = "users";
    $idField       = 'user_id';
    $unField       = 'email';
    $psField       = 'password';

    require('phpCommon/BlockXSS.class.php');
    require('phpCommon/MySqlPdoHandler.class.php');
    //require('phpCommon/SecureV2.class.php');
    require('posts.class.php');
    require('profile.class.php');
    include './config.php';
    $MySqlHandler =  MySqlPdoHandler::getInstance(); 
    $MySqlHandler->connect($database_name);
    $MySqlHandler->Query("SET NAMES utf8");

    //$secure     = new Secure($MySqlHandler, $database_name, $table_users, $unField, $psField, $idField, 'remember_me' , '', 'pos_secure', 'login.php', true);
    $Posts      = new Posts($MySqlHandler, $name);
    $Profile    = new Profile($MySqlHandler, $name);
    print '<br><br><br>';
    print 'Nombre: '. $name;
    /*if($get_user = $secure->getCurrentUser()){

        if($get_user['active']==1){
    
        }else{
            header('Location: ./?logout=1');
            die();
        }
    }*/
    



?>