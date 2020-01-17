<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.11.2018
 * Time: 3:35
 */
namespace CORE
{
    class Autoloader
    {
        const debug = false;
        public function __construct(){}

        public static function autoload($file)
        {
            #echo "$file <br> <br> ";
            $file = str_replace('\\', '/', $file);
            $path = $_SERVER['DOCUMENT_ROOT'] . '/class';
            $filepath = $_SERVER['DOCUMENT_ROOT'] . '/class/' . $file . '.php';

            #echo "$filepath <br> $path <br> $file";

            if (file_exists($filepath))
            {

                if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath));
                require_once($filepath);

            }
            else
            {
                $flag = true;
                if(Autoloader::debug) Autoloader::StPutFile(('начинаем рекурсивный поиск'));
                /** @var TYPE_NAME $flag */
                Autoloader::recursive_autoload($file, $path, $flag);
            }
        }

        public static function recursive_autoload($file, $path, $flag)
        {
            if (FALSE !== ($handle = opendir($path)) && $flag)
            {
                while (FAlSE !== ($dir = readdir($handle)) && $flag)
                {

                    if (strpos($dir, '.') === FALSE)
                    {
                        $path2 = $path .'/' . $dir;
                        $filepath = $path2 . '/' . $file . '.php';
                        if(Autoloader::debug) Autoloader::StPutFile(('ищем файл <b>' .$file .'</b> in ' .$filepath));
                        if (file_exists($filepath))
                        {
                            if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath ));
                            $flag = FALSE;
                            require_once($filepath);
                            break;
                        }
                        Autoloader::recursive_autoload($file, $path2, $flag);
                    }
                }
                closedir($handle);
            }
        }
        public static function __StPutFile($data)
        {
            return self::StPutFile($data);
        }
        private static function StPutFile($data)
        {
            $dir = $_SERVER['DOCUMENT_ROOT'] .'/Log/Log.html';
//            $data .= file_get_contents($dir);
            $file = fopen($dir, 'a');
            flock($file, LOCK_EX);
            fwrite($file, ('║' .$data .'=>' .date('d.m.Y H:i:s') .'<br/><br/>' .PHP_EOL));
            flock($file, LOCK_UN);
            fclose ($file);
        }

    }
    \spl_autoload_register('CORE\Autoloader::autoload');
}