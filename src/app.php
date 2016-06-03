<?php

// Autoload
require __DIR__ . '/../vendor/autoload.php';

use Slim\Slim;

class App extends \Slim\App {
    function __construct() 
    {
        // Autoload app classes using heirarchy from class name
        spl_autoload_register(function ($classname) {
            $pieces = array_map(function($piece) {
                return strtolower($piece);
            }, explode('_', $classname));

            require_once __DIR__ . "/" . implode('/', $pieces) . ".php";
        });

        // Instantiate the app
        $settings = require __DIR__ . '/settings.php';

        parent::__construct($settings);

        // Set up dependencies
        require __DIR__ . '/dependencies.php';

        // Register routes
        require __DIR__ . '/routes.php';

        // Register database
        require_once __DIR__ . '/../lib/mysql.php';

        // Default timezone
        date_default_timezone_set('America/Toronto');
    }
}
