<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.12.2018
 * Time: 14:20
 */

namespace CORE;


class Tamplite
{
    private             $dat;

    const _url_tpl    =   "/TPL/";

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
        $this->_url_tpl;
    }
    public function __call($name, $arguments)
    {
        $s = implode(' ',$arguments);
        $this->dat=array_shift(unserialize($s));
    }
    static function __callStatic($name, $arguments)
    {
        unset($name);
        self::__traceHTMLtoSYSTEM($arguments[0]);
    }
    public function __traceHTMLtoSYSTEM($data)
    {
        // Разбор всего ХТМЛ кода
        // расчленение на составные системные блоки, 
        // выстроение иерархического дерева

        $data->_tpl=$_SERVER['DOCUMENT_ROOT'] . self::_url_tpl . $data->_tpl . $data->_ext;
        
        if (is_file($data->_tpl)){

            $rule=file_get_contents($data->_tpl);

            preg_match_all('/<([a-z]*)\s(system)=["|\'](\w*)["|\']>/is',$rule,$rezultat, PREG_PATTERN_ORDER, 0);

            $data->_tpl = array('shabl'=>$rule,'listFUNCTION'=>$rezultat[3]);
var_dump($data->_tpl);
            return $data;
        }else{
            echo "Нетуddd шаблона {$data->_tpl}";
        }

//        echo '<pre>';
       
//        echo '</pre>';

    }

    public function _extractTo($a,$b,$c)
    {
        
        
        if(is_array($a))
        {
            echo "<pre>";
            // var_dump($a);
            
            // print_r($rezultat[1]);
            // if (!is_array($rezultat)) {
            //     # code...
            //     $rezultat = array('Пусто' => "Пустой");
            // }

            // foreach ($a[0] as $k => $v)
            // {

            //     echo "В шаблоне ".htmlspecialchars(preg_replace('/\s'.$b.'=["|\'](\w*)["|\']/isx','',$k)).
            //     " результат ".htmlspecialchars($v);

            // }
//             while( preg_match( "#\<([a-z ])system=(.+?)\>(.+?)\</\\1\>#is", $rule ) )
//             {
//                 echo preg_replace( "#\<([a-z ])system=(.+?)\>(.+?)\</\\1\>#is", htmlspecialchars("<\\1>\\2</\\1>"), $rule );
// //                $rule = //????
//             }
//            preg_match_all("/(<([\w]+)system=(.*?)[^>]*>)(.*)(<\/\\2>)/", $rule, $matches);
//
//            for ($i=0; $i< count($matches[0]); $i++) {
//                echo "matched: " . htmlspecialchars($matches[0][$i]) . "\n";
//                echo "part 1: " . htmlspecialchars($matches[1][$i]) . "\n";
//                echo "part 2: " . htmlspecialchars($matches[3][$i]) . "\n";
//                echo "part 3: " . htmlspecialchars($matches[4][$i]) . "\n\n";
//            }

            echo "</pre>";
        }

    }
    // public function getdate($data){
    //         return $data->_tpl;
    //     }

}