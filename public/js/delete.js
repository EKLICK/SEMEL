$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

$(document).on('click', '#btn-modal_vincular', function(){
    document.getElementById('texto_id_vincular').innerHTML = 'Você deseja vincular '+ $(this).data('nomepessoa').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    $('#id_pessoa_modal_vincular').val($(this).data('idpessoa'));
    $('#id_turma_modal_vincular').val($(this).data('idturma'));
});

$(document).on('click', '.btn-modal_ativar_inativar', function(){
    $('#id_pessoa_modal_ativar_inativar').val($(this).data('idpessoa'));
    $('#id_turma_modal_ativar_inativar').val($(this).data('idturma'));
    document.getElementById('titulo_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
    document.getElementById('texto_id_ativar_inativar').innerHTML = 'Você deseja '+ $(this).data('ativar_inativar').toLowerCase() + ' ' + $(this).data('nomepessoa').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    if($(this).data('ativar_inativar') == 'Inativar'){
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Inativação (obrigatório):';
    }
    else{
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Ativação (opcional):';
    }
    document.getElementById('enviar_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
    $('#id_pessoa_modal').val($(this).data('idpessoa'));
    $('#id_turma_modal').val($(this).data('idturma'));
});