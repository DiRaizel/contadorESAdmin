/*-------------------------------Adicionales----------------------------------*/

//
function eliminar(valor){
    //
    $.ajax({
        url: 'controllers/delete.php',
        type: 'post',
        data: {
            "idRel": valor,
            "accion": "eliminar"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data === 1) {
            //
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}