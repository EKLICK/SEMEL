$.validator.setDefaults({
    ignore: []
});

$(document).ready(function() {
    $("#atestado").change(function(){
        $("#atestado").delay(100);
        if($("#atestado").val != ''){
            $('#errorTxt9').hide();
        }
    });

    $('#formulario').validate({
        rules: {
            atestado: 'required',
        },
        errorElement : 'div',
        errorPlacement: function(error, element){
            var placement = $(element).data('error');
            if (placement){
                $(placement).append(error)
            }
            else{
                error.insertAfter(element);
            }
        },
    });
})