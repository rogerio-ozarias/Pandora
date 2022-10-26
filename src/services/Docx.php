<?php
namespace App\services;

use ZipArchive;

class Docx
{
    private $template;	        
    
    public function __construct($template) {
        $this->template = $template;					
    }
    
    /**
     * @desc Da replace no documento docx
     * @param string $newFile
	 * @param array $arrayReplace // key-> $search  $value -> $replace 
     * @return boolean
     */            
    public function generateDocx($newFile, Array $arrayReplace)
	{		
		$zip = new ZipArchive;

		if (!copy($this->template, $newFile)) 
			return false;
    	
        if(count($arrayReplace) > 0){
        	
        	$arrayXml[] = 'word/document.xml';            
            if (!$zip->open($newFile) === true) 
                return false;			
    		 
            for ($i = 0; $i < $zip->numFiles; $i++) {                            	
            	if(strpos($zip->getNameIndex($i),'footer') !== false){            		
            		$arrayXml[] = $zip->getNameIndex($i);
            	}
   	        }
   	        
   	        foreach ($arrayXml as $dataFile){
   	        	$xmlString = $zip->getFromName($dataFile);				
   	        	foreach($arrayReplace as $key => $value){
   	        		$xmlString = str_replace($key, $value, $xmlString);
   	        	}
   	        	$zip->addFromString($dataFile, $xmlString);
   	        }
            $zip->close();            
            return true;
        }
        return false;        
    }   

	public static function documentList($path)
	{
		$readDir = dir($path);		
		while(($file = $readDir->read())){     
			if(is_file($path.$file)){
				$list[] = $file;
			}
		}
		return $list;
	}

	public static function documentRemove($path)
	{
		$readDir = dir($path);		
		while(($file = $readDir->read())){     
			if(is_file($path.$file)){				
				unlink($path.$file);
			}
		}
		return true;
	}
}