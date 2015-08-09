
$(document).ready(function () {
    var pageNum = 0;
    var startCt = 1;
    var endCt = 40;
    var maxPages = 0;
    var field = "";
    var criteria = "";
    $('#saveList').on('click', function () {
        $('.my-new-list').html("");


        if ($('#radioTitle').is(':checked')) {
            field = 'intitle';
            criteria = $('#searchTitle').val();
        } else if ($('#radioAuthor').is(':checked')) {
            field = 'inauthor';
            criteria = $('#searchAuthor').val();
        } else if ($('#radioISBN').is(':checked')) {
            field = 'isbn';
            criteria = $('#searchISBN').val();
        }
        pageNum = 0;
        $('#saveDiv').html("<p><b>Search Results for " + field + " = " + criteria + ":</b></p>");
        $.ajax({
            type: "GET",
            url: "https://www.googleapis.com/books/v1/volumes?q=" + field + ":" + criteria + "&key=AIzaSyBI26WttPbWcpEIArsvZpZb0uk1e6eXcWQ&maxResults=40&startIndex=" + pageNum,
            dataType: "jsonP",
            success: ajaxResults
        });
    });

    $('#saveDiv').on('click', '.nextPage', function () {
        pageNum = parseInt(pageNum) + 1;
        endCt = parseInt(startCt) + 38;
        if (pageNum > maxPages) { pageNum = maxPages; }
        $('#saveDiv').html("<p><b>Search Results for " + field + " = " + criteria + ":</b></p>");
        $.ajax({
            type: "GET",
            url: "https://www.googleapis.com/books/v1/volumes?q=" + field + ":" + criteria + "&key=AIzaSyBI26WttPbWcpEIArsvZpZb0uk1e6eXcWQ&maxResults=40&startIndex=" + pageNum,
            dataType: "jsonP",
            success: ajaxResults
        });
    });

    $('#saveDiv').on('click', '.prevPage', function () {
        pageNum = parseInt(pageNum) - 1;
        startCt = parseInt(startCt) - (39*2);
        endCt = parseInt(startCt) + 38;
        if (pageNum < 0) { pageNum = 0; }
        $('#saveDiv').html("<p><b>Search Results for " + field + " = " + criteria + ":</b></p>");
        $.ajax({
            type: "GET",
            url: "https://www.googleapis.com/books/v1/volumes?q=" + field + ":" + criteria + "&key=AIzaSyBI26WttPbWcpEIArsvZpZb0uk1e6eXcWQ&maxResults=40&startIndex=" + pageNum,
            dataType: "jsonP",
            async: false,
            success: ajaxResults
        });
    });

    $('#saveDiv').on('click', '.saveButton', function () {
        var bookID = $(this).data('id');
        //window.open ("https://www.googleapis.com/books/v1/volumes/"+ bookID);
        $(".invisible").each(function () {
            if ($(this).data('id') == bookID) {
                // alert($(this).data("name"));
                var elementName = "#"+ $(this).data("name");
                var elementValue = $(this).data("value");
                if (elementValue == "undefined") { elementValue = ""; }
                //console.log(elementName);
                $('form').find($(elementName)).val($('form').find($(elementName)).val() + elementValue);
                $('form').submit();
            }
        });
    });

    function ajaxResults(result, status) {
        //alert(result.totalItems);
        if (pageNum == 0) {
            startCt = 1;
            endCt = 39;
        } 
        if (parseInt(result.totalItems) > 40) {
            maxPages = Math.ceil(parseInt(result.totalItems) / 40);
            $('#saveDiv').append("Viewing records " + startCt + "-" + endCt + " of " + result.totalItems + '. Page ' + (parseInt(pageNum) + 1) + ' of ' + maxPages + '.</br>');
            $('#saveDiv').append("<button class='prevPage btn btn-default btn-sm' runat='server'><< Previous </button>   <button class='nextPage btn btn-default btn-sm'>Next >> </button> </br>");

        }
        $(result.items).each(function (i, row) {
            
            $('#saveDiv').append("<hr /><button class='saveButton btn btn-default btn-sm' data-id='"+ row.id +"'>Save Book</button>"); 
            $('#saveDiv').append('<p>' + startCt + '. Book Title: ' + row.volumeInfo.title + '</p>');
            $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="book_title" data-value="' + row.volumeInfo.title + '"/>');
            $('#saveDiv').append('<p>Subtitle: ' + row.volumeInfo.subtitle + '</p>');
            $('#saveDiv').append("<span class='invisible' data-id='" + row.id + "' data-name='subtitle' data-value='" + row.volumeInfo.subtitle + "' />");
            $('#saveDiv').append('<p>Book Author(s):</p>');
            if (row.volumeInfo.authors) {
                for (var i = 0; i < row.volumeInfo.authors.length; i++) {
                    $('#saveDiv').append('<li>' + row.volumeInfo.authors[i] + '</li>');
                    if (i > 0) {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="author" data-value=",' + row.volumeInfo.authors[i] + '"/>');
                    } else {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="author" data-value="' + row.volumeInfo.authors[i] + '"/>');
                    }
                }
            }
            $('#saveDiv').append('<p>Publisher: ' + row.volumeInfo.publisher + ' (' + row.volumeInfo.publishedDate + ')</p>');
            $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="publisher" data-value="' + row.volumeInfo.publisher + '"/>');
            $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="published_date" data-value="' + row.volumeInfo.publishedDate + '"/>');
            $('#saveDiv').append('<p>Pages: ' + row.volumeInfo.pageCount + '</p>');
            $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="page_count" data-value="' + row.volumeInfo.pageCount + '"/>');
            $('#saveDiv').append('<p>Category(ies):</p>');
            if (row.volumeInfo.categories) {
                for (var i = 0; i < row.volumeInfo.categories.length; i++) {
                    $('#saveDiv').append('<li>' + row.volumeInfo.categories[i] + '</li>');
                    if (i > 0) {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="categories" data-value=",' + row.volumeInfo.categories[i] + '"/>');
                    } else {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="categories" data-value="' + row.volumeInfo.categories[i] + '"/>');
                    }
                }
            }
            $('#saveDiv').append('<p>Identifiers:</p>');
            if (row.volumeInfo.industryIdentifiers) {
                for (var i = 0; i < row.volumeInfo.industryIdentifiers.length; i++) {
                    $('#saveDiv').append('<li>' + row.volumeInfo.industryIdentifiers[i].type + ': ' + row.volumeInfo.industryIdentifiers[i].identifier + '</li>');
                    if (i > 0) {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="industry_type" data-value=",' + row.volumeInfo.industryIdentifiers[i].type + '"/>');
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="industry_identifier" data-value=",' + row.volumeInfo.industryIdentifiers[i].identifier + '"/>');
                    } else {
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="industry_type" data-value="' + row.volumeInfo.industryIdentifiers[i].type + '"/>');
                        $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="industry_identifier" data-value="' + row.volumeInfo.industryIdentifiers[i].identifier + '"/>');
                    }
                    
                }
            }
            $('#saveDiv').append('<p>Description: ' + row.volumeInfo.description + '</p>');
            $('#saveDiv').append('<span class="invisible" data-id="' + row.id + '" data-name="description" data-value="' + row.volumeInfo.description + '"/>');
            startCt += 1;
        });
    }
});