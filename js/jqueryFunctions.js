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

    // Hide's the modify form until needed.
    $('#modifyForm').hide();

    // Delay's the Listeners to allow the navigation links to load.
    $(this).delay(100).queue(function() {
        
        // Listeners for Navigiation Clicks.
        $('.loadPost').on('click', function(event){
            // Prevent Normal link Behaviour.
            event.preventDefault();

            // Make GET Call to API with the post id taken from the links id.
            loadArticle(this.id);
        });

        // Listener for add post form Submittion Button.
        $('#submitNewArticle').on('click', function(){

            // Some basic error handing.
            if($postTitleInput.val().length > 0 && $bodyTextInput.val().length > 0){
                addArticle();
            } else {
                alert("STOP HUMAN - You're supposed to write something.");
            }
        });

        // Listener for form edit post link.
        $('.editPost').on('click', function(event){

            // Prevent Normal link Behaviour.
            event.preventDefault();

            // Loads the form for editing Post.
            $('#modifyForm').show();

            // populates form with original data from API.
            getArticletoUpdate(this.id);
            
        });

        // Listener for delete post link.
        $('.deletePost').on('click', function(event){

            // Prevent Normal link Behaviour.
            event.preventDefault();

            if (confirm('Are you sure you want to delete this item from the database? This cannot be undone.')) {

                // Send the Article id to the API with a DELETE HTTP Method.
                deleteArticle(this.id);

            } else {
                alert('So... you just wanted to see what would happen?');
            }
            
        });

        // Listener for edit post form Submittion Button.
        $('#submitEditedArticle').on('click', function(){

            // Some basic error handing.
            if($('#editTitle').val().length > 0 && $('#editBodyText').val().length > 0){

                $id = $('#editId').val();

                editArticle($id);

            } else {
                alert("Keep with the Program, USER.");
            }
            
        });

        $('#cancelEditArticle').on('click', function(){

            $('#modifyForm').hide();
        });
    });


});


// Allows the user to edit an existing Post.
function getArticletoUpdate($id){
    
    $.ajax({
        type: 'GET',
        data: {
            id: $id
        },
        url: '/blogApi/api/posts/',
        success: function(response){

            // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
            $.each(response, function(i, article) {
                $('#editId').val(article.articleId);
                $('#editTitle').val(article.title);
                $('#editBodyText').html(article.bodyText);
            });
        },
        error: function(something) {
            alert("it failed to Get the Article for Modification.");
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
        },
        error: function(something){
            alert("It Failed to Add the Article.");
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
            alert("it failed to Get the Article.");
          }
    });
}

// Deletes a selected article.
function deleteArticle($id){

    $.ajax({
        type: 'DELETE',
        data: {
            id: $id
        },
        url: '/blogApi/api/posts/',
        success: function(response){
            alert("Entry Deleted.");
        },
        error: function(something) {
            alert("it failed to Delete the Article.");
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
   $navMenu.append('<tr><td><a href="" class="loadPost" id="' + article.articleId + '">' + article.title + '</a></td><td style="text-align: center;"><a href="" class="editPost" id="' + article.articleId +'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td><td style="text-align: center;"><a href="" class="deletePost" id="' + article.articleId +'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');        
    
}

