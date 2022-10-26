<?php
namespace Tests;

use App\services\Docx;

use PHPUnit\Framework\TestCase;

class DocxTest extends TestCase
{
    /**
     * @test      
     */
    public function shouldGenerateDocument()
    {        
        $filePath = __DIR__."/../../public/assets/docx/";
        $docx = new Docx($filePath."template.docx");   
        $arrayReplace = [
            "%nome%" => "Aparecido"
        ];
        $newFileName = $filePath."documentos/teste_generate.docx";   
        $docx->generateDocx($newFileName, $arrayReplace);        
        
        $this->assertFileExists($newFileName);
    }

    /**
     * @test      
     */
    public function shouldRemoveDocument()
    {        
        $filePath = __DIR__."/../../public/assets/docx/documentos/";
        $test = Docx::documentRemove($filePath);
        $this->assertTrue($test);
    }    
}