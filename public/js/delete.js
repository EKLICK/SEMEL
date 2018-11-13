$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});