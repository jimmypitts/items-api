<?php

// Load App Class
require __DIR__ . '/../src/app.php';
session_start();
$app = new App($settings);
$app->run();
