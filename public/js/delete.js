$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

$(document).on('click', '#btn-modal', function(){
    $('#id_pessoa_modal').val($(this).data('idpessoa'));
    $('#id_turma_modal').val($(this).data('idturma'));
    $('#nome_pessoa_modal').val($(this).data('nomepessoa'));
    $('#nome_turma_modal').val($(this).data('nometurma'));
});