//MODAL DELETE
$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

//MODAL PESSOA
$(document).on('click', '#btn-modal_vincular', function(){
    document.getElementById('texto_id_vincular').innerHTML = 'Você deseja vincular '+ $(this).data('nomepessoa').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    $('#id_pessoa_modal_vincular').val($(this).data('idpessoa'));
    $('#id_turma_modal_vincular').val($(this).data('idturma'));
});

$(document).on('click', '.btn-modal_ativar_inativar_pessoa', function(){
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
});

//MODAL PROFESSOR
$(document).on('click', '.btn-modal_vincular', function(){
    $('#id_professor_modal_vincular').val($(this).data('idprofessor'));
    $('#id_turma_modal_vincular').val($(this).data('idturma'));
    document.getElementById('titulo_vincular').innerHTML = $(this).data('vincular');
    document.getElementById('texto_id_vincular').innerHTML = 'Você deseja '+ $(this).data('vincular').toLowerCase() + ' ' + $(this).data('nomeprofessor').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    console.log($(this).data('vincular'));
    if($(this).data('vincular') == 'Desvincular'){
        document.getElementById('comentario_vincular').innerHTML = 'Comentario para Desvinculação (obrigatório):';
    }
    else{
        document.getElementById('comentario_vincular').innerHTML = 'Comentario para Vinculação (opcional):';
    }
    document.getElementById('enviar_vincular').innerHTML = $(this).data('vincular');
});

$(document).on('click', '.btn-modal_ativar_inativar_pessoa', function(){
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
});

//MODAL NUCLEO
$(document).on('click', '#btn-modal_ativar_inativar_nucleo', function(){
    $('#id_nucleo_modal_ativar_inativar').val($(this).data('idnucleo'));
    document.getElementById('titulo_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
    document.getElementById('texto_ativar_inativar').innerHTML = 'Você deseja '+ $(this).data('ativar_inativar').toLowerCase() + ' ' + $(this).data('nomenucleo').bold() + '?';
    if($(this).data('ativar_inativar') == 'Inativar'){
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Inativação (obrigatório):';
    }
    else{
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Ativação (opcional):';
    }
    document.getElementById('enviar_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
});

//MODAL TURMA
$(document).on('click', '#btn-modal_ativar_inativar_turma', function(){
    $('#id_turma_modal_ativar_inativar').val($(this).data('idturma'));
    document.getElementById('titulo_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
    document.getElementById('texto_ativar_inativar').innerHTML = 'Você deseja '+ $(this).data('ativar_inativar').toLowerCase() + ' ' + $(this).data('nometurma').bold() + '?';
    if($(this).data('ativar_inativar') == 'Inativar'){
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Inativação (obrigatório):';
    }
    else{
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Ativação (opcional):';
    }
    document.getElementById('enviar_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
});