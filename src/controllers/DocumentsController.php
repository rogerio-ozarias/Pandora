<?php
namespace App\controllers;

use App\services\Docx;

class DocumentsController
{
    public function generate(Array $votante, $filePath)
    {
        $docx = new Docx($filePath."template.docx");             
        foreach($votante as $id => $nome){
            $arrayReplace = [
                "%nome%" => $nome
            ];
            $newFileName = $filePath."documentos/{$id}_{$nome}.docx";   
            if(!file_exists($newFileName)){                            
                $docx->generateDocx($newFileName, $arrayReplace);
            }
        }
    }

    public function list($file, $page=1, $perPage = 10)
    {        
        $list = Docx::documentList($file);
        $page = ($page) ?: 1;
        $paginator = [
            "perPage" => $perPage,
            "page" => $page,
            "totalPage" => ceil(count($list)/$perPage)
        ];
        $offSet = ($page - 1) * $perPage;        
        return [
            "pag" => $paginator,
            "data" => array_slice($list, $offSet , $perPage, false)
        ];
    }

    public function remove($file)
    {
        return Docx::documentRemove($file);     
    }
}