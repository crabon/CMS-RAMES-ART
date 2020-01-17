<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.11.2018
 * Time: 4:53
 */

namespace CORE;


class Route{
    public $Mod;
    public $Arg;

    const debug = 1;

    public function __construct(){
        $a = func_get_args();
        $f = '__'.func_num_args();
        call_user_func_array(array($this,$f),$a);
    }
    public function __call($name, $arg){
        unset($name);
        $rez=preg_match_all('#/([a-z0-9.]*)#is', $l=$arg[0],$arg);
        $rez=(strlen($l)==1)? $rez=0:$rez;
        $arg=$arg[1];

        if (isset($arg)){ /// simle url patern
            switch($rez){
                case 0:
                    $this->Mod ='page';
                    $this->Arg = array('index');
                    break;
                case 1:
                    $this->Mod ='page';
                    $this->Arg=$arg;
                    break;
                case $rez:
                    $this->Mod = array_shift($arg);
                    $this->Arg=/*array_shift(*/$arg/*)*/;

                    break;
            }
        }else{
            throw new Exception(sprintf('Отсутсвуют аргументы'));
        }
        if(\CORE\Autoloader::debug) \CORE\Autoloader::__StPutFile(("<br/>Вызов метода='{$this->Mod}' <br/>Аргумент=". implode(', ', $arg). "<br/>"));
    }
    public function __toArg(){
        if(\CORE\Autoloader::debug) \CORE\Autoloader::__StPutFile(('Получение $this->toArg = ' .$this->Arg));
        return $this->Arg;
    }
    public function __toMod(){
        if(is_null($this->Mod)) {
        return 'NULL';
        }
        if(\CORE\Autoloader::debug) \CORE\Autoloader::__StPutFile(('Получение $this->toString = ' .$this->Mod));
        return $this->Mod;
    }

}
/**
 * GLOBAL CLASSES FUNCTION
 */