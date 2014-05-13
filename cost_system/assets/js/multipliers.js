$(document).ready(function() {

	calcMultiplier();

	
    $(document).on("focusout", "input[id='cost_name']", function() {
        if($(this).val() != '') {
            calcMultiplier();
            var closeRow = $(this).closest('.group-data');
            closeRow.after('<div class="row group-data"><div class="col-md-6"><div class="form-group"><input type="text" name="cost_name[]" id="cost_name" class="form-control"></div></div><div class="col-md-3"><div class="input-group"><input type="text" name="value[]" id="cost_value" class="form-control"><span class="input-group-addon">%</span></div></div><div class="col-md-1"><button type="button" id="remove-button" class="btn btn-default btn-md"><i class="glyphicon glyphicon-trash"></i></button></div></div>');
        }
    });

    $(document).on('keyup', '#cost_value', function(e) {
        calcMultiplier();
    });

    $(document).on('click', '#remove-button', function(event) {
        var quant = $(".group-data").length;
        if(quant > 1) {
    	    $(this).closest('.group-data').remove();
        } else {
        	return false;
        }
        calcMultiplier();
        event.preventDefault();
    });

    /*
     * This function is used to calculate the multiplier every time there is an iteration with field value
     */
    function calcMultiplier() {

    	var valor = 0;
    	var current = 0;
    	var multiplicador = 0;

    	$("input[id='cost_value']").each(function() {
    		current = $(this).val();
            current = current.replace(',', '.');
    		if(current != '') {
	    		valor = (parseFloat(valor) + parseFloat(current)).toFixed(2);
    		}
    	});

    	multiplicador = (100 / (100 - valor)).toFixed(2);

        multiplicador = multiplicador.replace('.', ',');

    	$('.multiplier').html(multiplicador);
    }
});