<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Visualização de Lista: <?php echo $price_list->name; ?></h1>                            
    </div>    
</div>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="price_list_table">
		<thead>
            <tr>
                <th>Referência</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
		</thead>

    	<tbody>

        <?php foreach($price_list_items as $k => $p) : ?>

			<tr>
				<td><?php echo $p->reference; ?></td>
				<td><?php echo $p->description; ?></td>
				<td>R$<?php echo number_format($p->multiplier_price, 2, ',', '.'); ?></td>                
			</tr>	

        <?php endforeach; ?>    

		</tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#price_list_table').dataTable({      
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,     
        "sDom": "<'#top-table' 'row'<'col-md-5'T><'col-md-5 pull-right'f>r>t<'#pagination-table' 'row'<'span6'i><'span6'p>>",
        "oTableTools": {
            "sSwfPath": "/assets/swf/copy_csv_xls_pdf.swf",
            "aButtons": [               
                "print",
                "csv",
                "xls",
                {
                        "sExtends": "pdf",      
                        "sPdfMessage": "<?php echo $pdf_message;?>"           
                    },              
            ]
        },
        "iDisplayLength": 100,
    });
});
</script>