<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.11.2018
 * Time: 10:25
 * Modul load information to @PAGE@ for categori
 */

namespace SECTION;

class PAGE
{
    public $_page;
    public $_ext;
    public $_con;

    public $_tpl;
    public $class=__CLASS__; // Name class for other funtion

    public $_str;
    
    private $__f;
    // protected $_toObj=[];

    public function __construct(){
        // echo "Srabotal class ".__CLASS__;
        $a = func_get_args();
        $this->__f = '$a[0]';
        call_user_func_array(array($this,$this->__f),$a);
    }
    public function __call($name,$arg){
        unset($name);

        /**
Plan:

system->module
system->argument for module

tracert module in Obj es parametrs
::_ext
::_tpl
::_page
::_con
        */
        // array_shift( $arg );
        $this->_page = $arg[0]->Arg[0];
        $this->_ext = '.html';
        $this->_tpl = 'DEFUALT.'.$arg[0]->Mod;
        $this->_con = array(
            '__conten'=>'Здесь у нас будет контент',
            '__hidden'=>true,
            '__menu'=>array(
                array('_url_'=>'01','_title_'=>'Титул','_alt_'=>'opisaniya alt\'a','_name_'=>'Имя странички меню01'),
                array('_url_'=>'01','_title_'=>'Титул','_alt_'=>'opisaniya alt\'a','_name_'=>'Имя странички меню01'),
                array('_url_'=>'01','_title_'=>'Титул','_alt_'=>'opisaniya alt\'a','_name_'=>'Имя странички меню01'),
                array('_url_'=>'01','_title_'=>'Титул','_alt_'=>'opisaniya alt\'a','_name_'=>'Имя странички меню01'),
                array('_url_'=>'01','_title_'=>'Титул','_alt_'=>'opisaniya alt\'a','_name_'=>'Имя странички меню01')
            )
        );

        self::_ToObj();


    }
//    public function __toString()
//    {
//        return $this->toString;
//    }
    public function _ToObj(){

        // var_dump($this);
        
        \CORE\Tamplite::_($this);

        foreach ($this->_tpl['listFUNCTION'] as $metod) {
            if (method_exists($this,$metod)) {
                call_user_func_array(array($this,$metod),array($metod));
            }else{
                
                $this->_tpl['shabl']=preg_replace("/<([a-z]*)( system=\"$metod\")>(.*?)<\/\\1>/is","<\\1>$metod</\\1>",$this->_tpl['shabl']);
                echo "Not $metod in {$c}";
            }
        }
var_dump($this->_tpl['shabl']);
    }
    public function head($a=null){

        $this->_tpl['shabl']=preg_replace("/<($a)\s(system=[a-z\"]*)>(.*?)<\/\\1>/is", "<\\1>\\3</\\1>", $this->_tpl['shabl']);
        $this->_tpl['shabl']=preg_replace("/<(title)>(.*?)<\/\\1>/is", "<\\1>".$this->_con['__conten']."</\\1>", $this->_tpl['shabl']);
        // while(preg_match("/<(meta)\stype=['|\"]([a-z\-]*)['|\"]/is", $this->_tpl['shabl'],$meta)){
        //     if (method_exists($this,$meta[1])) {
        //         call_user_func_array(array($this,$meta[1]),array($meta[2]));
        //     }else{
        //     // var_dump($meta);
        //     Echo "что то нашел {$meta{2}}";
        //     }
        // }
        
    }
    public function menu($a=null){
        $l=$a;
    }
    public function kw($a=null){

    }
}