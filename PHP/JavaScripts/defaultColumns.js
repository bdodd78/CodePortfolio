$(document).ready(function() {

   $('.cbChoice').change(function() {
    var choice = $(this).val();
      // alert(choice);
    if ($(this).is(':checked')) {
        $('.'+ choice).css('display','table-column');
    } else {
        $('.'+ choice).css('display','none');
    }
   });
    
    $('.sortable').on('click', function() {
        //alert("here");
       var sortCol = $(this).data("column"); 
        //alert(sortCol);
        $('#sortColumn').val(sortCol);
        viewForm.submit();
    });
    
    $('input[type=checkbox]').each(function () {
      if ($(this).is(':checked')) {
          var choice = $(this).val();
          $('.'+ choice).css('display','table-column');
      }
    });
    
    $('.sortable').each(function() {
        //alert($(this).data("column"));
        if ($('#sortColumn').val() == $(this).data("column")) {
            
            $(this).addClass('chosen');   
        }
    });
});