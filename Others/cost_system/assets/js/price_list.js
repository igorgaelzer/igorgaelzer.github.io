$(document).ready(function() {

	$(document).on('change', '#brand-list', function(e) {
        filtraModelos();
        /*$.ajax({
            type: 'post',
            url: '/price_list/list_models',
            data: {brand:$(this).val()},
            success: function(data, status) {
                $('#lista-modelos tbody').empty().append(data);
            }
        });*/
        e.preventDefault();
    });

    $(document).on('change', '#client-list', function(e) {
        filtraModelos();
		//alert($(this).val());

        e.preventDefault();
    });

    $(document).on("change", "input[id='check_all']", function() {
    	if(this.checked) {
            $("input[name='models_list[]']").each(function() {
                this.checked = true;
            });
        } else {
            $("input[name='models_list[]']").each(function() {
                this.checked = false;
            });         
        }    	
    });

    function filtraModelos()
    {
        var brand_val  = $('#brand-list').val();
        var client_val = $('#client-list').val();

        $.ajax({
            type: 'post',
            url: '/price_list/list_models',
            data: {brand:brand_val, client:client_val},
            success: function(data, status) {
                $('#lista-modelos tbody').empty().append(data);
            }
        });
    }

    function checkAll() {
    	var checkboxes = document.getElementsByTagName('models_list[]'), val = null;    
    	for (var i = 0; i < checkboxes.length; i++) {
        	if (checkboxes[i].type == 'checkbox') {
            	if (val === null) val = checkboxes[i].checked;
            	checkboxes[i].checked = val;
         	}
     	}
 	}


});