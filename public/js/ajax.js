$(document).ready(function(){
    $('#botao').click(function(){
        var nome = $('#nome_doenca').val();
        var descricao = $('#descricao_doenca').val();
        $.ajax({
            type: "get",
            data: "&nome=" + nome + "&descricao=" + descricao,
            url: '/ajax/doenca',
        }).done(function (data){
            if(data == 1){
                M.toast({html: 'É necessario preencher todos os campos para cadastrar uma pessoa'})
            }
            else{
                $('#nome_doenca').val("");
                $('#descricao_doenca').val("");
                $('#lista_de_pessoas').append('<option value="'+ data.id +'">'+ data.nome +'</option>');
                $('select').formSelect();
                M.toast({html: 'Doenca cadastrada com sucesso!'})
            }
        })
    });
});