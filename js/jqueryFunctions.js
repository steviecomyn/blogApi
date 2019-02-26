// caches the DOM elements.
var $navMenu = $('#navigation');
var $postTitleInput = $('#postTitle');
var $bodyTextInput = $('#bodyText');
var $coverImageInput = $('#coverImage');
var $publishDateInput = $('#publishDate');
var $content = $('.content');

// On Page Load, do this.
$(function(){

    // Pulls Article list from API and creates NavMenu.
    updateNavigation();

    // Listener for Navigiation Clicks.
    $('#nav1').on('click', function(event){
        // Prevent Normal link Behaviour.
        event.preventDefault();

        // Make GET Call to API.s
        loadArticle(1);
        
    });

    $('#nav2').on('click', function(event){
        // Prevent Normal link Behaviour.
        event.preventDefault();

        // Make GET Call to API.s
        loadArticle(2);
        
    });


    // Listener for form Submittion Button.
    $('#submitNewArticle').on('click', function(){

        // Some basic error handing.
        if($postTitleInput.val().length > 0 && $bodyTextInput.val().length > 0){
            addArticle();
        } else {
            alert("Keep with the Program, USER.");
        }
        
    });

});


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

// Retreives a selected article.
function loadArticle($id){

    $.ajax({
        type: 'GET',
        data: {
            id: $id
        },
        url: '/blogApi/api/posts/',
        success: function(response){

            // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
            $.each(response, function(i, article) {
                $('.content').html(article.bodyText);
            });
        },
        error: function(something) {
            alert("it failed");
          }
    });
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

// creates a link based on a JSON object.
function addArticleLink(article){
    $navMenu.append('<li><a href="" id="nav' + article.articleId + '">' + article.title + '</a></li>');        
}

