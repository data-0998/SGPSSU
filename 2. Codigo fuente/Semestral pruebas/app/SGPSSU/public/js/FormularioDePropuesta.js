/*Funciones para controlar la adición y remoción de filas en las tablas de actividades y datos participantes*/
$(function(){
    $('#addMore1').on('click', function() {
            var data = $("#actividades tr:eq(1)").clone(true).appendTo("#actividadesBody");
            data.find("input").val('');
    });
    $(document).on('click', '.remove1', function() {
        var trIndex = $(this).closest("tr").index();
            if(trIndex>0) {
            $(this).closest("tr").remove();
        } else {
            alert("No puede eliminar la primera fila de la tabla");
        }
    });
});      

$(function(){
    $('#addMore2').on('click', function() {
            var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
            data.find("input").val('');
    });
    $(document).on('click', '.remove2', function() {
        var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
            $(this).closest("tr").remove();
        } else {
            alert("No puede eliminar la primera fila de la tabla");
        }
    });
});   

/*Funcion que muestra y esconde la seccion de productos y actividades*/
$(document).ready(function () {
    $('input[type="radio"]').click(function () {
        if ($(this).attr("id") == "actividad") {
            $(".ProductoClass").hide('slow');
            $(".ActividadClass").show('slow');
        }
        if ($(this).attr("id") == "producto") {
            $(".ProductoClass").show('slow');
            $(".ActividadClass").hide('slow');
        }
    });

    $('input[type="radio"]').trigger('click'); 
    });

/*Funcion para colocar la fecha por defecto en el formulario*/
    function getDate(){
        var todaydate = new Date();
        var day = todaydate.getDate();
        var month = todaydate.getMonth() + 1;
        var year = todaydate.getFullYear();
        var datestring = day + "/" + month + "/" + year;
        document.getElementById("frmDate").value = datestring;
    } 
    getDate(); 

/*Coloca automaticamente la suma en el campo "total" del formulario en actividades*/
    $(document).on('click', '#addMore1', function(){
    event.preventDefault();
    var num = $('.piezas').length; 
    var newNum = new Number(num + 1); 
    $('#piezas' + num).after('<input type="number" class="piezas" name="piezas'+newNum+'" id="piezas'+ newNum +'" value=0>');   
    });
    
    $(document).on('keyup', '.piezas', function(){
    var resultado = 0;
    $(".piezas").each(function() {      
        resultado += parseInt($(this).val());
        if (isNaN(resultado)){
            resultado = "";
        }
    }); 
    $("#resultado").val(resultado); 
});
 