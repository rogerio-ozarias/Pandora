<?php
require __DIR__ . '/../../vendor/autoload.php';
use App\controllers\DocumentsController;

$filePath = __DIR__."/../assets/docx/documentos/";
$controller = new DocumentsController();

$return = [
    "success" => $controller->remove($filePath)
];

die(json_encode($return));