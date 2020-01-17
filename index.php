<?php
$mem_start = memory_get_usage();
// var_dump(new Exception);

/**
 * User: root
 * Date: 28.11.2018
 * Time: 3:15
 * logik
 * #1 URL => Route
 * #2 DB => Json
 * #3 MODULE => PAGE...
 * #4 Tamplit => TPL
 * ECHO
 */
#$_SERVER['REQUEST_URI'];
define('debug',0);

require_once 'class/CORE/Autoloader.php';

use CORE\
{
    Autoloader as Autoloader, Route as Route, Tamplite as TPL, NotLoad as NotLoad
};

$route = new Route($_SERVER['REQUEST_URI']);

$core = (class_exists("SECTION\\".strtoupper($route->__toMod())))?"SECTION\\".strtoupper($route->__toMod()):"CORE\NotLoad";

$obj    =   new $core($route);
// var_dump($obj);
$_n =   file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/Log/Log.html");#'/Log/Log.html'

$mem_start = (memory_get_usage() - $mem_start)/1024;

echo  $mem_start."Kb";





function pr($var) {
    static $int=0;
    echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
    print_r($var);
    echo '</pre>';
    $int++;
}

function vrd($var) {
    static $int=0;
    echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
    var_dump($var);
    echo '</pre>';
    $int++;
}