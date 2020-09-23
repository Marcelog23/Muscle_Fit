
    $(document).ready(function () {
        $('.foco').focus();

        $('.select2').select2({
            // language: "pt-BR",
            allowClear: true,
            closeOnSelect:true
        });

        $('.cep').mask('00000-000');
        $('.fone').mask('(00)0.0000-0000');
        $('.fixo').mask('(00)0000-0000');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.ident').mask('00000000-00');
        $('.cnpj').mask('99.999.999/9999-99');
        $('.money').mask('000.000.000.000.000.00', {reverse: true});
        //$('.money').mask("#.##0,00");


        //modal de exibição de mensagens
        $('#flash-overlay-modal').modal().fadeOut(350);



        // validação de campo cpf/cnpj
        $.validator.addMethod("cpfcnpj", brdocs.cpfcnpjValidator, "Informe um Número Válido.");
        $('#form').validate({
            rules:{
                cpf_aluno: "cpfcnpj",
                cnpj_acade: "cpfcnpj",
                cpf_pers:  "cpfcnpj",
            }
        });


        //mascara para telefones
        let maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };
        $('.phone').mask(maskBehavior, options);



    });





