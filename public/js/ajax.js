$(document).ready(function(){
    $('#botao').click(function(){
        var nome = $('#nome_doenca').val();
        var descricao = $('#descricao_doenca').val();
        var token = document.getElementsByName('_token');
        console.log(token);

        $.ajax({
            type: "post",
            data: "&nome=" + nome + "&descricao=" + descricao + "$_token=" + token,
            url: "/pessoas/ajax/doenca",
            success: function(data) {
                console.log(data);
            }
        });
    });
});