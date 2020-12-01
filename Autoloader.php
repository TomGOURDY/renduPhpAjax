<?php

class Autoloader{
    public static function autoload($class){
        $class = str_replace("\\","/", $class);
        require $class.".php";
    }

    public static function register(){
        spl_autoload_register(array(__CLASS__,"autoload"));
    }

    // public static function register()
    // {
    //     spl_autoload_register(function ($class) {
    //         $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    //         if (file_exists($file)) {
    //             require $file;
    //             return true;
    //         }
    //         return false;
    //     });
    // }

    // public static function autoload($class){
    //     var_dump($class);
    //     if (strpos($class, __NAMESPACE__ . '\\') === 0){
    //         $class = str_replace(__NAMESPACE__ . '\\', '', $class);
    //         $class = str_replace('\\', '/', $class);
    //         require $class . '.php';
    //     }
    // }
}
