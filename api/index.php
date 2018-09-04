<?php
require '../_app/Config.inc.php';
require '../vendor/autoload.php';

$config = [
        'settings' =>[
                'displayErrorDetails' => true
        ]
];

require_once "../routes/get.php";
require_once "../routes/post.php";
require_once "../routes/put.php";
require_once "../routes/delete.php";

$app->run();