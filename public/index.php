<?php
require __DIR__ . '/../vendor/autoload.php';
use App\controllers\IndexController;
$controller = new IndexController();
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
            <h3>Lista de Votantes</h3>
        </div>                   

        <div clas="row">        
            <div class="alert alert-primary d-flex align-items-center" role="alert">                    
                <div>
                    Selecione um item da lista e clique no botão Gerar Documentos
                </div>
            </div>
        </div>

        <div clas="row">        
            <div class="col">
                <button id="generate" disabled type="button" class="btn btn-primary">
                    <i class="fa fa-file-word-o"></i>
                    Gerar Documentos
                </button>                
            </div>
        </div>
        
        <div clas="row">      
            <div class="table-responsive" style="margin-top:50px; max-height: 350px">
                <table class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th width="50">
                                <input class="form-check-input" type="checkbox" name="todos" value="1" />
                            </th>
                            <th>#ID</th>
                            <th>NOME</th>
                        </tr>
                    </thead>
                    <tbody>            
                        <?php
                        foreach($controller->index() as $values):?>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="votante[<?php echo $values["id"]?>]" value="<?php echo $values["nome"]?>" />
                                </td>
                                <td><?php echo $values["id"]?></td>
                                <td><?php echo $values["nome"]?></td>
                            </tr>
                        <?php
                        endforeach;?>            
                    </tbody>
                </table>
            </div>   
        </div>   
    </div>
   
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/index.js"></script>
</body>
</html>