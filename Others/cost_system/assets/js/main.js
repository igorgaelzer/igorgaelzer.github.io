$(document).ready(function() {
	$('#dataTable').dataTable({		
		"oLanguage": {
				"sProcessing":   "Processando...",
				"sLengthMenu":   "Mostrar _MENU_ registros",
				"sZeroRecords":  "Não foram encontrados resultados",
				"sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
				"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",				
				"oPaginate": {
						"sFirst":    "Primeiro",
						"sPrevious": "Anterior",
						"sNext":     "Seguinte",
						"sLast":     "Último"
				}
		},
		"bInfo": false,
		"bLengthChange": false,
		"iDisplayLength": 50,
		"sDom": "<'#top-table' 'row'<'col-md-5'T><'col-md-5 pull-right'f>r>t<'#pagination-table' 'row'<'span6'i><'span6'p>>",
		"oTableTools": {
			"sSwfPath": "/assets/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
				"csv",
				"xls",
				{
                        "sExtends": "pdf",		
						//"sPdfMessage": "Your custom message would go here."           
                    },
                "print",			
			]
		}

	});

	$('#lista-modelos').dataTable({
		"sScrollY": "300px",
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
		"aoColumnDefs" : [ {
					'bSortable' : false,
					'aTargets' : [ 0 ]
			} ],
		
	});

	

	/*
	 * This function is used to remove a group of fields
	 */
	$(document).on('click', '#remove-button', function(event) {
		var quant = $(".group-data").length;
		if(quant > 1) {
			$(this).closest('.group-data').remove();
		} else {
			return false;
		}
		event.preventDefault();
	});

	/*
	 * This function is used to remove a group of fields
	 */
	$(document).on('click', '#delete-button', function(event) {
		if(confirm("Você deseja apagar esse registro?")) {
			return true;
		}
		return false;
	});

});