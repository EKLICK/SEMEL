$.validator.setDefaults({
    ignore: []
});

$(document).ready(function() {
    $('input[type=radio][name=inativo]').change(function() {
        $('#errorTxt6').hide();
        $('#radiovalidation').val('1');
    });

    $('#formulario').validate({
        rules: {
            nome: {
                required: true,
                minlength: 5,
                maxlength: 100
            },
            bairro: "required",
            rua: {
                required: true,
                minlength: 5,
                maxlength: 100
            },
            cep: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            numero_endereco: {
                required: true,
                maxlength: 5
            },
            complemento: {
                maxlength: 10
            },
            telefone: {
                required: true, 
                minlength: 16,
                maxlength: 16
            },
            descricao: {
                maxlength: 100
            },
            radiovalidation: "required"
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