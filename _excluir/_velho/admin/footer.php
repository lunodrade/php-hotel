	<script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable( {
            	"dom": 'T<"clear">lfrtip',
		        "tableTools": {
		            "sSwfPath": "../swf/copy_csv_xls_pdf.swf"
		        },
		        "oLanguage": {
				    "sEmptyTable": "Nenhum registro encontrado",
				    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
				    "sInfoPostFix": "",
				    "sInfoThousands": ".",
				    "sLengthMenu": "_MENU_ resultados por página",
				    "sLoadingRecords": "Carregando...",
				    "sProcessing": "Processando...",
				    "sZeroRecords": "Nenhum registro encontrado",
				    "sSearch": "Pesquisar",
				    "oPaginate": {
				        "sNext": "Próximo",
				        "sPrevious": "Anterior",
				        "sFirst": "Primeiro",
				        "sLast": "Último"
				    },
				    "oAria": {
				        "sSortAscending": ": Ordenar colunas de forma ascendente",
				        "sSortDescending": ": Ordenar colunas de forma descendente"
				    }
				}
		    } );
        } );
    </script>
    
	<script type="text/javascript">
		$(".close").click(function(){$(".alert").show().hide("slow");});
	</script>

	<div style="padding: 30px 0 10px 0; bottom: 10px;  width: 100%; text-align: center;">© 2014, Rizer. Todos os direitos reservados</div>
	
</body>
</html>