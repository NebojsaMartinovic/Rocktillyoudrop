<?php

require_once 'core/init.php';

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

spl_autoload_register(function($class){
    if(file_exists('libraries/'.$class.'.php')){
        require_once 'libraries/'.$class.'.php';
    }
});
