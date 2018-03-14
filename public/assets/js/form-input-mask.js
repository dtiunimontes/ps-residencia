var FormInputMask = function () {

    var handleInputMasks = function () {



        $("#telefone").inputmask("mask", {
            "mask": "(99) [9]9999-9999",
			 clearMaskOnLostFocus: true,
			 autoUnmask: true,
			 removeMaskOnSubmit: true,

        }); //specifying fn & options

      $("#data_nasc").inputmask('99/99/9999', {
      //numericInput: true,
			clearMaskOnLostFocus: true,
			autoUnmask: true,
			rightAlign: false
      });

      $("#cpf").inputmask('999.999.999-99', {
            //numericInput: true,
			clearMaskOnLostFocus: true,
			autoUnmask: true,
			rightAlign: false,
			removeMaskOnSubmit: true,
        });

      $("#cep").inputmask('99999-999', {
            //numericInput: true,
			clearMaskOnLostFocus: true,
			autoUnmask: true,
			rightAlign: false,
			removeMaskOnSubmit: true,
        });



		$("#cep").inputmask({removeMaskOnSubmit: true});
		$("#telefone").inputmask({removeMaskOnSubmit: true});
		$("#cpf").inputmask({removeMaskOnSubmit: true});


    }

    return {
        //main function to initiate the module
        init: function () {
            handleInputMasks();
        }
    };

}();

jQuery(document).ready(function() {
	FormInputMask.init(); // init metronic core componets
});
