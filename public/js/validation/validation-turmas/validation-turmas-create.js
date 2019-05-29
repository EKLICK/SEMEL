$.validator.setDefaults({
    ignore: []
});

jQuery.validator.addMethod("timeValidationInicial", function(value, element){
    regex = new RegExp('^[0-2][0-9]:[0-5][0-9]$');
    return regex.test(document.getElementById('icon_horario_inicial').value);
}, "Tempo definido inválido")

jQuery.validator.addMethod("timeValidationFinal", function(value, element){
    regex = new RegExp('^[0-2][0-9]:[0-5][0-9]$');
    return regex.test(document.getElementById('icon_horario_final').value);
}, "Tempo definido inválido")

$(document).ready(function() {
    $('input[type=radio][name=inativo]').change(function() {
        $('#errorTxt7').hide();
        $('#radiovalidation').val('1');
    });

    $('#formulario').validate({
        rules: {
            nome: {
                required: true,
                minlength: 5,
                maxlength: 100
            },
            limite: {
                required: true,
                number: true
            },
            horario_inicial: {
                required: true,
                timeValidationInicial: true
            },
            horario_final: {
                required: true,
                timeValidationFinal: true
            },
            'data_semanal[]': 'required',
            nucleo_id: 'required',
            radiovalidation: 'required'
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