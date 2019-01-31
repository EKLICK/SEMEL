//MODAL DELETE
$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

//MODAL PESSOA E PROFESSOR
$(document).on('click', '.btn-modal_vincular', function(){
    $('#id_modal_vincular').val($(this).data('idusuario'));
    $('#id_turma_modal_vincular').val($(this).data('idturma'));
    document.getElementById('titulo_vincular').innerHTML = $(this).data('vincular');
    document.getElementById('texto_id_vincular').innerHTML = 'Você deseja '+ $(this).data('vincular').toLowerCase() + ' ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
    if($(this).data('vincular') == 'Desvincular'){
        document.getElementById('comentario_vincular').innerHTML = 'Comentario para Desvinculação (obrigatório):';
    }
    else{
        document.getElementById('comentario_vincular').innerHTML = 'Comentario para Vinculação (opcional):';
    }
    document.getElementById('enviar_vincular').innerHTML = $(this).data('vincular');
});

//ATIVAR E INATIVAR
$(document).on('click', '.btn-modal_ativar', function(){
    $('#id_modal_ativar').val($(this).data('idusuario'));
    $('#id_turma_modal_ativar').val($(this).data('idturma'));
    document.getElementById('texto_id_ativar').innerHTML = 'Você deseja ativar ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
});

$(document).on('click', '.btn-modal_inativar', function(){
    $('#id_modalr_inativar').val($(this).data('idusuario'));
    $('#id_turma_modal_inativar').val($(this).data('idturma'));
    document.getElementById('texto_id_inativar').innerHTML = 'Você deseja inativar ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
});

//MODAL TURMA
$(document).on('click', '#btn-modal_ativar_inativar_objeto', function(){
    $('#id_modal_ativar_inativar').val($(this).data('idobjeto'));
    document.getElementById('titulo_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
    document.getElementById('texto_ativar_inativar').innerHTML = 'Você deseja '+ $(this).data('ativar_inativar').toLowerCase() + ' ' + $(this).data('nomeobjeto').bold() + '?';
    if($(this).data('ativar_inativar') == 'Inativar'){
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Inativação (obrigatório):';
    }
    else{
        document.getElementById('comentario_ativar_inativar').innerHTML = 'Comentario para Ativação (opcional):';
    }
    document.getElementById('enviar_ativar_inativar').innerHTML = $(this).data('ativar_inativar');
});