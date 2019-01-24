$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

$(document).on('click', '#btn-modal', function(){
    document.getElementById('texto_id').innerHTML = 'Você deseja vincular '+ $(this).data('nomepessoa').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    $('#id_pessoa_modal').val($(this).data('idpessoa'));
    $('#id_turma_modal').val($(this).data('idturma'));
});