
/*
$(document).ready(function () {



    // foco no input dentro da janela modal
    $('#modalExercicio').on('shown.bs.modal', function() {
        $('#busca').focus();
    });


    $('.salvaExercicio').on("click", function (e) {
        e.preventDefault();
        addLInhaExer();
        var valor = $("input[id='check_exrc']:checked").val();

        var id     = valor.split("|")[0];
        var codigo = valor.split("|")[1];
        var nome   = valor.split("|")[2];


        $('#exercicio_id').val(id);
        $('#codg_exrc').val(codigo);
        $('#nome_exrc').val(nome);

        $('#modalExercicio').modal('hide');

    });


    //filtro dinamico na tela de seleção de exercicios
    $("#busca").on("keyup", function() {
        var value = $(this).val().toUpperCase();
        $("#tblExercicios tr").filter(function() {
            $(this).toggle($(this).text().toUpperCase().indexOf(value) > -1)
        });
    });


});

(function ($) {

    addLInhaExer = function () {

        var newRow = $('<tr>');
        var cols = "";

        cols += '<td><input type="hidden" name="exercicios[]" id="exercicio_id" class="form-control-sm" readonly="true"  ></td>';
        cols += '<td><input type="text"   name="codigo"       id="codg_exrc" class="form-control-sm"    style="width:100%; text-align: center;" readonly="true" style="width:100%"></td>';
        cols += '<td><input type="text"   name="nome"         id="nome_exrc" class="form-control-sm"    readonly="true" style="width:100%"></td>';
        cols += '<td><input type="number" name="numr_rept[]"  id="numr_rept" class="form-control-sm"    style="width:100%; text-align:center;" required ></td>';
        cols += '<td><input type="number" name="numr_sers[]"  id="numr_sers" class="form-control-sm"    style="width:100%; text-align: center;" required></td>';
        cols += '<td><input type="number" name="temp_intr[]"  id="temp_intr" class="form-control-sm"    style="width:100%; text-align: center;" required ></td>';
        cols += '<td align="center">';
        cols += '<button class="btn btn-danger btn-xs white-text" title="Remover" onclick="RemoveTableRow(this)" type="button"><i class="fa fa-trash" aria-hidden="true"></button>';
        cols += '</td>';

        newRow.append(cols);

        $('#tblExer').prepend(newRow);

        return false;
    };

    //remove a linha
    RemoveTableRow = function (item) {

        let tr = $(item).closest('tr');
        tr.fadeOut(400, function () {
            tr.remove();
            return false;
        });
        return false;

    };


})(jQuery);

*/
