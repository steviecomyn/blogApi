// On Page Load, do this.
$(function(){

    // caches the DOM element to Update.
    var $navMenu = $('#navigation');

    $.ajax({
        type: 'GET',
        dataType: "json",
        url: '/blogApi/api/posts/',
        success: function(posts){

            // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
            $.each(posts, function(i, item) {
                $navMenu.append('<li><a href="#" id="week'+ item.articleId +'">'+ item.title +'</a></li>');
            });
        }
    });

    $('#button').on('click', function(){

    });
});