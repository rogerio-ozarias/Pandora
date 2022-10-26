$(document).ready(function(){
    var btnRemoveDoc = $("#excluir");

    var buttonDefault = $(btnRemoveDoc).html();
	var buttonLoading = "<i class=\"fa fa fa-spinner fa-spin fa-1x fa-fw\"></i> Excluindo...";
	var buttonSuccess = "<i class=\"fa fa-check\"></i> Redirecionando...";	
    var buttonError = "<i class=\"fa fa-thumbs-down\"></i> Erro de conexão!";		
    $(btnRemoveDoc).click(function(){
        $.ajax({
            url: "./remove-document.php",                         
            dataType: "json",
            beforeSend: function(){                
                $(btnRemoveDoc).html(buttonLoading);
            },
            success: function(txt){
                if(txt.success){
                    $(btnRemoveDoc).html(buttonSuccess);
                    location.href = "../index.php";
                }
            },
            error: function(a, b, c){
                $(btnRemoveDoc).html(buttonError);
                setTimeout(() => {
                    $(btnRemoveDoc).html(buttonDefault).prop("disabled", false);
                }, 3000);
            }
        });
    });
})