var FrmAlumnos = function () {

    var formValidation = function () {

        var form1 = $('#frmalumnos');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input

            rules: {
                hijos: {
                    minlength: 2,
                    required: true
                },
               documento: {
                   required: true,
                   minlength: 7,
                   maxlength: 12,
                   digits:true
                },
               nombreacu: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
               },
               clave: {
                   required: true,
                   minlength: 3,
                   maxlength: 50
              }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },

            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                $('#msgsave').show();
                error1.hide();

                if (!$(form).validate().form()) {
                    return false;
                }

                var data = 'act=insert&'+$(form).serialize();

                $.post('modules/alumnos/proses.php', data)
                    .done(function (result) {
                        if (result.success) {
                            $('#msgsave').hide();
                            toastr.success('Registro creado exitosamente','Kids Church');
                            $(form)[0].reset();
                        }else {
                            toastr.error(result.message,'Kids Church');
                        }
                    }).fail(function (request) {
                        $('#msgsave').hide();
                        toastr.error('Error','Kids Church');
                    });
            }
        });


    }

    var formBuscar = function () {

        var form1 = $('#frmconsultar');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input

            rules: {

               documentosalida: {
                   required: true,
                   minlength: 7,
                   maxlength: 12,
                   digits:true
                },
                clavesalida: {
                   required: true,
                   minlength: 3,
                   maxlength: 50
              }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },

            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                $('#msgsavebuscar').show();
                  $('#result').hide();
                error1.hide();

                if (!$(form).validate().form()) {
                    return false;
                }

                var data = 'act=buscar&'+$(form).serialize();

                $.post('modules/alumnos/proses.php', data)
                    .done(function (result) {
                        if (result.success) {
                            $('#msgsavebuscar').hide();
                          if (result.message!='') {
                              $('#idconfirmar').val(result.message.id);
                              $('#alumna').html(result.message.hijos);
                              $('#result').show();

                          }else {
                              toastr.error('No existe ningun alumno(a)s con los datos ingresados','Kids Church');
                          }

                        }else {
                            toastr.error(result.message,'Kids Church');
                        }
                    }).fail(function (request) {
                        $('#msgsavebuscar').hide();
                        toastr.error('Error','Kids Church');
                    });
            }
        });


    }

    return {
        init: function () {
            formValidation();
            formBuscar();
        }
    };

}();

var FrmSalida = function () {

var frmConfirmar = function() {
  $('#linkconfirmar').click(function(){


      //'id': $('#idconfirmar').val()
      var datos = 'act=salida&id='+$('#idconfirmar').val();


      $.ajax({
            url:   'modules/alumnos/salida.php',
            data:  datos,
            type:  'post',
            beforeSend: function () {
              $('#msgsavebuscar').show();
            },
            success:  function (result) {

                $('#msgsavebuscar').hide();

                  if (result.success) {
                      toastr.success('Su salida se registro exitosamente','Kids Church');
                      $('#idconfirmar').val('');
                      $('#alumna').html('');
                      $('#result').hide();
                      $('#frmconsultar')[0].reset();
                  }else {
                    toastr.error('Error al dar salida ','Kids Church');
                  }
            },error:function(error ){
              $('#msgsavebuscar').hide();
              toastr.error('Error','Kids Church');
            }
          });
  });
}

return {
    init: function () {
        frmConfirmar();
    }
};

}();

jQuery(document).ready(function() {
    FrmAlumnos.init();
    FrmSalida.init();
});
