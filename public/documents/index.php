<?php
require __DIR__ . '/../../vendor/autoload.php';
use App\controllers\DocumentsController;

$filePath = __DIR__."/../assets/docx/";
$controller = new DocumentsController();
if(count($_POST["votante"]))
    $controller->generate($_POST["votante"], $filePath);

$list = $controller->list($filePath."documentos/", $_GET["page"]);
extract($list["pag"]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link  rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta charset="utf-8"/>
<title>Lista de Votantes</title>
</head>
<body>
    <div class="container">

        <div clas="row" style="margin-top: 50px">        
            <h3>Lista de Documentos Gerados</h3>
        </div>   
        
        <div clas="row">        
            <div class="col">
                <a href="../" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i>
                    Voltar
                </a>

                <button id="excluir" type="button" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Excluir Documentos
                </button>
            </div>
        </div>
        
        <div clas="row">      
            <div class="table-responsive">
                <table class="table table-striped table-hover" >
                    <thead>
                        <tr>                            
                            <th>NOME</th>
                            <th>ARQUIVO</th>
                        </tr>
                    </thead>
                    <tbody>            
                        <?php
                        foreach($list["data"] as $nome):?>
                            <tr>                                
                                <td><?php echo $nome?></td>
                                <td>
                                    <a href="../assets/docx/documentos/<?php echo $nome?>">
                                        <i class="fa fa-download"></i>
                                        Baixar
                                    </a>                                    
                                </td>
                            </tr>
                        <?php
                        endforeach;?>            
                    </tbody>
                </table>
            </div>   
        </div>  
        
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if($page > 1):?>
                        <li class="page-item">  
                            <a class="page-link" href="<?php echo "?page=".($page - 1) ?>" >Anterior</a>
                        </li>
                    <?php else:?>
                        <li class="page-item disabled">  
                            <a class="page-link" href="#" >Anterior</a>
                        </li>
                    <?php endif;?>
                    <?php for($x=1; $x<= $totalPage; $x++):?>
                        <?php if($page == $x):?>
                            <li class="page-item active">
                                <a href="#" class="page-link" href="#">
                                    <?php echo $x?>
                                </a>
                            </li>
                        <?php else:?>
                            <li class="page-item">
                                <a href="?page=<?php echo $x?>" class="page-link" href="#">
                                    <?php echo $x?>
                                </a>
                            </li>
                        <?php endif;?>                        
                    <?php endfor;?>

                    
                    <?php if($page < $totalPage):?>
                        <li class="page-item">  
                            <a class="page-link" href="<?php echo "?page=". ($page + 1)?>">Próxima</a>
                        </li>
                    <?php else:?>
                        <li class="page-item disabled">  
                            <a class="page-link" href="#" >Próxima</a>
                        </li>
                    <?php endif;?>                   
                </ul>
            </nav>
        </div>
    </div>     
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/documents.js"></script>
</body>
</html>