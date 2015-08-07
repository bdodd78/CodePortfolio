$(document).ready(function() {
    $('.sortable').on('click', function() {
        //alert("here");
       var sortCol = $(this).data("column"); 
        //alert(sortCol);
        $('#sortColumn').val(sortCol);
        sortForm.submit();
    });
    
  $('.sortable').each(function() {
        //alert($(this).data("column"));
        if ($('#sortColumn').val() == $(this).data("column")) {
            
            $(this).addClass('chosen');   
        }
    });
});