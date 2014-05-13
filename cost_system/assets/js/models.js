$(document).ready(function() {

    calcTotalPrice();
    calcTotalModels();

    $.ajaxSetup({type: "post"});

    /*
     *  This function is used to make work the autocomplete feature.
     *  For more doc find "jquery ui autocomplete"
     */
    $(document).on("keydown", "input[id='material']", function() {
        $(this).autocomplete({
            source: "/materials/get_materials",
            minLength: 2,
            select: function( event, ui ) {
                $(this).val(ui.item.description);
                $(this).next().val(ui.item.id);
                $(this).closest('li').find('#price').val(ui.item.price);
                event.preventDefault();
            },
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {      
            return $( "<li>" ).append( "<a>" + item.description + "  " + item.brand + "  R$" + item.price + "  " + item.measure + "</a>" ).appendTo( ul );
        };
    });


    /*
     * This function is used to add more group of fields in models form
     */

    $(document).on("focusout", "input[id='material']", function(e) {
        if($(this).val() != '') {
            calcTotalPrice();
            var closeRow = $(this).closest('li');
            closeRow.after('<li class="group-data"><div class="row material-group"><div class="col-md-4"><div class="form-group"><input type="text" name="material[]" class="form-control autocomplete" id="material"><input type="text" name="material_id[]" class="hidden" id="material_id"></div></div><div class="col-md-2"><div class="form-group"><input type="text" name="quantity[]" class="form-control" id="quantity"></div></div><div class="col-md-2"><div class="input-group"><span class="input-group-addon">R$</span><input type="text" name="price[]" id="price" class="form-control" id="descricao" placeholder="" disabled></div></div><div class="col-md-2"><div class="input-group"><span class="input-group-addon">R$</span><input type="text" name="total_price[]" class="form-control" id="total_price" placeholder="" disabled></div></div><div class="col-md-1"><button type="button"  id="remove-button" class="btn btn-default btn-md"><i class="glyphicon glyphicon-trash"></i></button></div></div></li>');        
        }
    });

    $( "#items-sortable" ).sortable();

    $(document).on('keyup', '#quantity', function(e) {
        calcTotalPrice();
        calcTotalModels();
    });

    /*
     *  This function is used to calculate total price basec on material price and quantity
     *  
     */
    function calcTotalPrice() {        
        $("input[id='quantity']").each(function() {
            var quant = 0;
            var total_price = 0;
            quant = $(this).val();
            quant = quant.replace(',', '.');
            price = $(this).closest('li').find('#price').val();
            price = price.replace(',', '.');
            if(quant != '') {
                total_price = (parseFloat(quant) * parseFloat(price)).toFixed(2);
                total_price = total_price.replace('.', ',');
                //total_price = (parseFloat(quant) * parseFloat(price)).toFixed(2);
            }
            $(this).closest('li').find('#total_price').val(total_price);
        });
    }

    function calcTotalModels() {
        var total = 0;
        $("input[id='total_price']").each(function() {
            var quant = 0;
            var quant = $(this).val();
            quant = quant.replace(',', '.');
            if(quant != '') {
                total = (parseFloat(total) + parseFloat(quant)).toFixed(2);
            }
        });
        total = total.replace('.', ',');
        $('#total_m').empty();
        $('#total_m').append('<h4>R$'+total+'</h4>');
    }

    $(document).on('click', '#delete_image', function(e) {
        var action = $(this).attr('href');
        
        $.ajax({
            type: 'post',
            url: action,
            data: {},
            success: function(data, status) {
                if(data == 'success') {
                    $('#image_model').empty().append('<img src="data:image/png;base64,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" class="img-responsive img-thumbnail" alt="Responsive image"><hr><div class="form-group"><input type="file" name="image_model" class="form-control"></div>');
                    alert('Imagem apagada com sucesso.');
                } else {
                    alert('Não foi possivel deletar a imagem. Tente novamente.');
                }

            }
        });

        return false;
    });


});