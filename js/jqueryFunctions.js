// On Page Load, do this.
$(function(){

    // Pulls Article list from API and creates NavMenu.
    updateNavigation();

    // caches the DOM elements.
    var $navMenu = $('#navigation');
    var $postTitleInput = $('#postTitle');
    var $bodyTextInput = $('#bodyText');
    var $coverImageInput = $('#coverImage');
    var $publishDateInput = $('#publishDate');

    // creates a link based on a JSON object.
    function addArticleLink(article){
        $navMenu.append('<li><a href="#" id="week'+ article.articleId +'">'+ article.title +'</a></li>');
    }

    // Get's all current articles and creates navigation links for them.
    function updateNavigation(){

        // Make an AJAX call and GET links to all Articles.
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/blogApi/api/posts/',
            success: function(posts){
    
                // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
                $.each(posts, function(i, article) {
                    addArticleLink(article);
                });
            }
        });
    }

    // Creates and article based on form input values, and passes it to the API via POST.
    function addArticle(){

        // Create JSON Object.
        var article = {
            title: $postTitleInput.val(),
            bodyText: $bodyTextInput.val(),
            coverImage: $coverImageInput.val(),
            publishDate: $publishDateInput.val()
        };

        // Send JSON via POST to API.
        $.ajax({
            type: 'POST',
            url: '/blogApi/api/posts/',
            data: article,
            success: function(newArticle){
                addArticleLink(newArticle)
            }
        });
    }

    // Listener for form Submittion Button.
    $('#submitNewArticle').on('click', function(){
        addArticle();
    });

});