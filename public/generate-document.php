<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use App\controllers\DocumentsController;

$filePath = __DIR__."/assets/docx/";
$controller = new DocumentsController();

if(count($_POST["votante"]))
    $controller->generate($_POST["votante"], $filePath);

$return = [
    "success" => true
];

die(json_encode($return));