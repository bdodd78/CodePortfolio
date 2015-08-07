$(document).ready(function() {
    /*$('.searchField').on ('click',function() {
        $('.searchRadio').attr('checked',false);
        $(this).closest('label').find('.searchRadio').attr('checked', true);
    });*/
    
    
    $('#saveList').on('click',function() {
        $('.my-new-list').html("");
        var criteria = '';
        var field = '';
       
        if ($('#radioTitle').is (':checked')){
            field = 'intitle';
            criteria = $('#searchTitle').val();
        } else if ($('#radioAuthor').is (':checked')) {
            field = 'inauthor';
            criteria = $('#searchAuthor').val();
        } else if ($('#radioISBN').is (':checked')) {
            field = 'isbn';
            criteria = $('#searchISBN').val();
        }
        $('#saveDiv').html("<p><b>Search Results for "+ field +" = "+ criteria +":</b></p>"); 
        $.ajax({
            type:"GET",
            url: "https://www.googleapis.com/books/v1/volumes?q="+ field +":"+ criteria  +"&key=[API KEY]&maxResults:40&startIndex:0", 
            dataType: "jsonP",
            success: function(result, status){
                //alert(result.totalItems);
                if (parseInt(result.totalItems) > 40) {
                    
                    $('#saveDiv').append("Viewing records 1-40 of "+ result.totalItems +'</br>' );
                    
                }
                $(result.items).each(function(i, row) {
                    $('#saveDiv').append("<hr />");//<button class='saveButton btn btn-default btn-sm' data-id='"+ i +"'>Save Book</button>"); 
                    $('#saveDiv').append('<p>Book Title: '+ row.volumeInfo.title +'</p>');
                    $('#saveDiv').append('<p>Subtitle: '+ row.volumeInfo.subtitle +'</p>');
                    $('#saveDiv').append('<p>Book Author(s):</p>');
                    for (var i=0; i<row.volumeInfo.authors.length;i++) {
                        $('#saveDiv').append('<li>'+ row.volumeInfo.authors[i] +'</li>'); 
                    }
                    $('#saveDiv').append('<p>Publisher: '+ row.volumeInfo.publisher +' on '+ row.volumeInfo.publishedDate +'</p>');
                    $('#saveDiv').append('<p>Pages: '+ row.volumeInfo.pageCount +'</p>');
                    $('#saveDiv').append('<p>Category(ies):</p>');
                    if (row.volumeInfo.categories) {
                        for (var i=0; i<row.volumeInfo.categories.length;i++) {
                            $('#saveDiv').append('<li>'+ row.volumeInfo.categories[i] +'</li>'); 
                        }
                    }
                    $('#saveDiv').append('<p>Identifiers:</p>');
                    if (row.volumeInfo.industryIdentifiers) {
                        for (var i=0; i<row.volumeInfo.industryIdentifiers.length;i++) {
                            $('#saveDiv').append('<li>'+ row.volumeInfo.industryIdentifiers[i].type +': '+ row.volumeInfo.industryIdentifiers[i].identifier+'</li>'); 
                        }
                    }
                    $('#saveDiv').append('<p>Description: '+ row.volumeInfo.description +'</p>');
                    
                   
                });
            },
            error() {
                alert("An error has occurred");
            }
        });
    });
    
    $('#saveDiv').on ('click', '.saveButton',function() {
       //alert('here');
        console.log ($(this).data('id'));
        //alert($(this).data('id').val()); 
    });
    
   $('#listAll').on('click', function() { 
       $('#saveDiv').html("");
       var criteria = '';
       var field = '';
       
       if ($('#radioTitle').is (':checked')){
            field = 'intitle';
            criteria = $('#searchTitle').val();
       } else if ($('#radioAuthor').is (':checked')) {
            field = 'inauthor';
            criteria = $('#searchAuthor').val();
       } else if ($('#radioISBN').is (':checked')) {
            field = 'isbn';
            criteria = $('#searchISBN').val();
       }
       $('.my-new-list').html('<b><p>Search Results for '+ field +' = '+ criteria +':</b></p>');
            
        $.ajax({
            type:"GET",
            url: "https://www.googleapis.com/books/v1/volumes?q="+ field +":"+ criteria  +"&key=[API Key]", 
            dataType: "jsonP",
            success: function(result, status){
                $(result.items).each(function(i,val){
                    $('.my-new-list').append('<hr>');
                    $.each(val,function(k,v){    
                        
                        if (typeof(v) != "object") {
                            $('.my-new-list').append('<b>'+ k+" : </b>"+ v +'</br>');  
                        } else {
                          $('.my-new-list').append('<b>'+ k +': </b></br>');
                          for(key1 in v) {
                                if (v.hasOwnProperty(key1)) {
                                    if(v[key1] instanceof Array) {
                                          $('.my-new-list').append('<li>'+ key1 + ' :</li>');
                                          for(var i=0;i<v[key1].length;i++) {
                                              if (typeof(v[key1][i]) != "object") {
                                                $('.my-new-list').append("<li class='level2'>"+ v[key1][i] +'</li>');
                                            } else { 
                                                for (key2 in v[key1][i]) {
                                                   $('.my-new-list').append("<li class='level2'>"+ key2 +' : '+ v[key1][i][key2]+'</li>');   
                                                }
                                            }
                                          }
                                    } else {
                                        if (typeof(v[key1]) != "object") {
                                            $('.my-new-list').append('<li>'+ key1 +' : '+ v[key1]+'</li>');
                                        } else {
                                            $('.my-new-list').append('<li>'+ key1 +' : </li>');
                                            for (key2 in v[key1]) {
                                                   $('.my-new-list').append("<li class='level2'>"+ key2 +' : '+ v[key1][key2]+'</li>');   
                                                }
                                        }
                                    }
                                }
                          };
                          
                        }
                        
                    });
                });  
                
            },
            error(){
                alert('An error has occured');   
            }
        });
       
    });

   
   
});