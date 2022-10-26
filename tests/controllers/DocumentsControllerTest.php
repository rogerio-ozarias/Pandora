<?php
namespace Tests;

use App\controllers\DocumentsController;

use PHPUnit\Framework\TestCase;

class DocumentsControllerTest extends TestCase
{
    /**
     * @test      
     */
    public function shouldGeneratDocument()
    {        
        $filePath = __DIR__."/../../public/assets/docx/";
        $controller = new DocumentsController();
        $votante = [
            "001" => "Joao_Pedro",
            "002" => "Joao_Paulo"
        ];        
        $controller->generate($votante, $filePath);
        $this->assertFileExists($filePath."documentos/001_Joao_Pedro.docx");
    }

    /**
     * @test      
     */
    public function shouldListDocuments()
    {        
        $filePath = __DIR__."/../../public/assets/docx/documentos/";
        $controller = new DocumentsController();              
        $list = $controller->list($filePath);
        $this->assertIsArray($list);
    }

    /**
     * @test   
     */
    public function shouldRemoveDocument()
    {        
        $filePath = __DIR__."/../../public/assets/docx/documentos/";
        $controller = new DocumentsController();         
        $test = $controller->remove($filePath);        
        $this->assertTrue($test);
    }
}