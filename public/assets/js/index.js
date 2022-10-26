$(document).ready(function(){    
    var btnGenerateDoc = $("#generate");
    checkCheckbox = ($this) => {
        if($($this).length > 0){
            $(btnGenerateDoc).prop("disabled", false);
        }else{
            $(btnGenerateDoc).prop("disabled", true);
        }
    }

    $("[name^='votante[']").click(function(){
        var tbody = $(this).closest("tbody");
        if($(this).is(":checked")){
            checkCheckbox($(this))
        }else{
            checkCheckbox($(tbody).find("[type='checkbox']:checked"))
        }        
    });

    $("[name='todos']").click(function(){
        var table = $(this).closest("table");
        var tbody = $(table).find("tbody");
        if($(this).is(":checked")){
            $(tbody).find("[type='checkbox']").prop("checked", true);
        }else{
            $(tbody).find("[type='checkbox']").prop("checked", false);
        }
        checkCheckbox($(tbody).find("[type='checkbox']:checked"));
    });

    var buttonDefault = $(btnGenerateDoc).html();
	var buttonLoading = "<i class=\"fa fa fa-spinner fa-spin fa-1x fa-fw\"></i> Gerando...";
	var buttonSuccess = "<i class=\"fa fa-check\"></i> Redirecionando...";	
    var buttonError = "<i class=\"fa fa-thumbs-down\"></i> Erro de conexão!";			
    
    $(btnGenerateDoc).click(function(){
        $(btnGenerateDoc).prop("disabled", true);
        var form = $("<form></form>", {
            action: "/documents/index.php",            
            method: "post"
        }).hide();        
        var clone = $("[name^='votante[']:checked").clone();
        $(form).append(clone);        

        $.ajax({
            url: "./generate-document.php", 
            data: $(form).serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function(){                
                $(btnGenerateDoc).html(buttonLoading);
            },
            success: function(txt){
                if(txt.success){
                    $(btnGenerateDoc).html(buttonSuccess);
                    location.href = "/documents/index.php";
                }
            },
            error: function(a, b, c){
                $(btnGenerateDoc).html(buttonError);
                setTimeout(() => {
                    $(btnGenerateDoc).html(buttonDefault).prop("disabled", false);
                }, 3000);
            }
        });
    })

    checkCheckbox($("[name^='votante[']:checked"));
});