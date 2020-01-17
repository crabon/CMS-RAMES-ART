<?php

namespace CORE;

class NotLoad{
    public function __construct(){
			$a = func_get_args();
        	$f = '__'.func_num_args();
        	call_user_func_array(array($this,$f),$a);

	}

	public function __call($name,$arg){
			echo "ОШИБКА"; 
	}

}
