// Previsualizar Foto
function colocarFoto($this,$img_thumbnail) {
    $imagenPrevisualizacion = document.querySelector($img_thumbnail);
    var userFile = document.getElementById($this);
    userFile.src = URL.createObjectURL(event.target.files[0]);
    $imagenPrevisualizacion.src = userFile.src; 
    console.log(this.name);
}
// Al presionar X, limpiar Foto
function limpiarFoto ($this,$img_thumbnail) {
    $($img_thumbnail).attr("src", "");
    document.getElementById($this).value='';
}

$(document).ready(function() {    
    $('#reporte').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "", //Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        // paging: false,
        order: [],
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
            {
                extend:    'excelHtml5',
                text:      'Excel ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                footer: true
            },
            {
                extend:    'pdfHtml5',
                text:      'PDF',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                footer: true
            },
            {
                extend:    'copyHtml5',
                text:      'Copiar <i class="fa fa-clipboard"></i>',
                titleAttr: 'Copiar a clipboard',
                className: 'btn btn-info',
                footer: true
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                footer: true
            },
        ]           
    });     
});

$(document).ready(function() {    
    $('#listar').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "", //Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        order: [],
        searching: true,
        paging: true,   // Si esta en true, es mejor no paginar en el controlador, si se pagina en el controlador, puede quedar false
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
            
        ]           
    });     
});

function establecerFechas(rango) {
    var timeZone = 'America/Lima'; // Cambia America/Lima por la zona horaria que necesites

    var hoy = new Date();
    hoy.setHours(0, 0, 0, 0); // Establece la hora en cero
    var fechaInicial, fechaFinal;

    switch (rango) {
        case 'hoy':
            fechaInicial = hoy;
            fechaFinal = hoy;
            break;
        case 'ultimos7dias':
          fechaInicial = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() - 6);
          fechaFinal = hoy;
          break;
        case 'estaSemana':
            var primerDiaSemana = 1; // Lunes (0 para Domingo, 1 para Lunes, etc.)
            var diaSemana = hoy.getDay();
            var primerDia = new Date(hoy.setDate(hoy.getDate() - diaSemana + primerDiaSemana));
            var ultimoDia = new Date(hoy.setDate(primerDia.getDate() + 6));

            fechaInicial = new Date(primerDia.getFullYear(), primerDia.getMonth(), primerDia.getDate());
            fechaFinal = new Date(ultimoDia.getFullYear(), ultimoDia.getMonth(), ultimoDia.getDate());
            break;
        case 'esteMes':
            fechaInicial = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
            fechaFinal = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0);
            break;
        case 'esteAnno':
            fechaInicial = new Date(hoy.getFullYear(), 0, 1);
            fechaFinal = new Date(hoy.getFullYear(), 11, 31);
            break;
        default:
            console.log('Rango no válido');
            return;
    }

    document.getElementById('fecha_inicial').valueAsDate = fechaInicial;
    document.getElementById('fecha_final').valueAsDate = fechaFinal;
    document.getElementById('filtrar').click();
}

function setSearchField(fieldName) {
    var searchInput = document.getElementById('searchInput_'+fieldName);
    var selectElement = document.getElementById(fieldName);
    var searchList = document.getElementById('searchList_'+fieldName).getElementsByTagName('option');

    searchInput.addEventListener('input', function(event) {
        var searchTerm = event.target.value.toUpperCase();

        for (var i = 0; i < searchList.length; i++) {
            var option = searchList[i];
            var text = option.value.toUpperCase();

            if (text.indexOf(searchTerm) > -1) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
    });

    searchInput.addEventListener('change', function(event) {
        var selectedOption = document.querySelector('option[value="' + event.target.value + '"]');
        if (selectedOption) {
            selectElement.value = selectedOption.getAttribute('data-id');
        } else {
            selectElement.value = '';
        }
    });
}

    function buscarDato(dato){
        var term = dato.trim().toLowerCase();

        // Obtener todas las filas de la tabla
        var rows = document.querySelectorAll('table tbody tr');

        // Iterar sobre cada fila y realizar el filtrado en cualquier campo
        rows.forEach(function(row) {
            var found = false;
            // Iterar sobre cada celda de la fila
            row.querySelectorAll('td').forEach(function(cell) {
                var content = cell.textContent.trim().toLowerCase();
                // Verificar si el término de búsqueda está presente en el contenido de la celda
                if (content.includes(term)) {
                    found = true;
                }
            });
            // Mostrar o ocultar la fila según si se encontró el término de búsqueda en alguna celda
            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }


