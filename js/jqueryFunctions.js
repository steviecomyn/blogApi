// caches the DOM elements.
var $navigationMenu = $('#navigation');
var $contentArea = $('.content');
var $updateArticleFormDiv = $('#updateArticleFormDiv');
var $loadingSpinner = $('#loader');

// createArticleForm DOM Elements.
var $createArticleTitle = $('.createArticle #title');
var $createArticleBodyText = $('.createArticle #bodyText');
var $createArticlePublishDate = $('.createArticle #publishDate');
var $createArticleSubmit = $('.createArticle #submit');

// updateArticleForm DOM Elements.
var $updateArticleId = $('.updateArticle #id');
var $updateArticleTitle = $('.updateArticle #title');
var $updateArticleBodyText = $('.updateArticle #bodyText');
var $updateArticlePublishDate = $('.updateArticle #publishDate');
var $updateArticleSubmit = $('.updateArticle #submit');
var $updateArticleCancel = $('.updateArticle #cancel');

// Hides the spinner by default.
$loadingSpinner.hide();

// Shows spinner if ajax call is made.
$(document).ajaxStart(function(){
    $loadingSpinner.show();
});

// Hide's the spinner when ajax call is complete.
$(document).ajaxComplete(function(){
    $loadingSpinner.hide();
});


// Document.ready (once page has loaded)
$(function(){

    // Update Navigation Links.
    updateNavigation();

    // Hide the UpdateArticleForm until needed.
    $updateArticleFormDiv.hide();

    // Delay's the Listeners to allow the navigation links to load.
    $(this).delay(200).queue(function() {

        // Listener for createArticleForm Submit Button.
        $createArticleSubmit.on('click', function(event){
            // Prevent Normal link Behaviour.
            event.preventDefault();

            // Some basic error handing.
            if($createArticleTitle.val().length > 0 && $createArticleBodyText.val().length > 0){

                // Sends the createArticleForm results to API.
                createArticle();

            } else {
                alert("STOP HUMAN - You're supposed to write something.");
            }
        });

        // Listener for Navigiation Link Clicks.
        $('.retrieveArticle').on('click', function(event){
            
            // Prevent Normal link Behaviour.
            event.preventDefault();

            // Make GET Call to API with the article id taken from the clicked link's id.
            retrieveArticle(this.id);
        });

        // Listener for updateArticleForm Submit Button.
        $updateArticleSubmit.on('click', function(){

            // Some basic error handing.
            if($updateArticleTitle.val().length > 0 && $updateArticleBodyText.val().length > 0){

                // Send updated article to API.
                updateArticle();

            } else {
                alert("STOP HUMAN - So you deleted everything and didn't replace it!?");
            }
            
        });

        // Listener for updateArticleForm Cancel Button.
        $updateArticleCancel.on('click', function(){

            // THIS IS BLOODY BROKEN AND I DON'T KNOW WHY!!!!!
            $updateArticleFormDiv.hide();

        });

        // Listener for loading updateArticleForm link.
        $('.updateArticle').on('click', function(event){

            $linkId = this.id;

            // Prevent Normal link Behaviour.
            event.preventDefault();

            // Loads the form for editing Post.
            $('#updateArticleFormDiv').show();

            // populates form with original data from API.
            getArticletoUpdate($linkId);
            
        });

        // Listener for Deleting an Article.
        $('.deleteArticle').on('click', function(event){

            $linkId = this.id;

            // Prevent Normal link Behaviour.
            event.preventDefault();

            if (confirm('Are you sure you want to delete this Article (#'+ $linkId +') from the database? This cannot be undone.')) {

                // Send the Article id to the API with a DELETE HTTP Method.
                deleteArticle($linkId);

            } else {
                alert('So... you just wanted to see what would happen?');
            }
            
        });

    });

});

// MAIN FUNCTIONS

// Get's all current articles and creates navigation links for them.
function updateNavigation(){

    // Make an AJAX call and GET links to all Articles.
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/blogApi/api/posts/',
        success: function(allArticles){

            // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
            $.each(allArticles, function(i, article) {
                createArticleLink(article);
            });
        }
    });
}

// creates a link based on a JSON object.
function createArticleLink(article){
    $navigationMenu.append('<tr id="row' + article.articleId + '"><td><a href="" class="retrieveArticle" id="' + article.articleId + '">' + article.title + '</a></td><td style="text-align: center;"><a href="" class="updateArticle" id="' + article.articleId +'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td><td style="text-align: center;"><a href="" class="deleteArticle" id="' + article.articleId +'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
}

// MAIN CRUD FUNCTIONS

// Creates an article based on form input values, and passes it to the API via POST.
function createArticle(){

    // Create JSON Object.
    var article = {
        action: 'createArticle',
        title: $createArticleTitle.val(),
        bodyText: $createArticleBodyText.val(),
        publishDate: $createArticlePublishDate.val()
    };

    // Send JSON via POST to API.
    $.ajax({
        type: 'POST',
        url: '/blogApi/api/posts/',
        data: article,
        beforeSend: function(){
            $loadingSpinner.show();
        },
        success: function(newArticle){
            createArticleLink(newArticle);
        },
        complete: function(){
            $loadingSpinner.hide();
            clearCreateArticleForm();
        },
        error: function(something){
            alert("It Failed to Add the Article.");
        }
    });
}

function clearCreateArticleForm(){

    $createArticleTitle.val("");
    $createArticleBodyText.val("");
}

// Retreives a selected article.
function retrieveArticle($id){

    $.ajax({
        type: 'GET',
        data: {
            id: $id
        },
        url: '/blogApi/api/posts/',
        success: function(response){

            // if successful, go through each item in the array(JSON), and output a list-item and link for each article.
            $.each(response, function(i, article) {
                $contentArea.html(article.bodyText);
            });
        },
        error: function(something) {
            alert("it failed to Get the Article.");
          }
    });
}

// Populates the updateArticleForm for updating.
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
                $updateArticleId.val(article.articleId);
                $updateArticleTitle.val(article.title);
                $updateArticleBodyText.val(article.bodyText);
                $updateArticlePublishDate.val(article.publishDate);
            });
        },
        error: function(something) {
            alert("it failed to Get the Article for Modification.");
          }
    });
}

// Creates and article based on form input values, and passes it to the API via POST.
function updateArticle(){

    // Create JSON Object.
    var article = {
        action: 'updateArticle',
        id: $updateArticleId.val(),
        title: $updateArticleTitle.val(),
        bodyText: $updateArticleBodyText.val(),
        publishDate: $updateArticlePublishDate.val()
    };

    // Send JSON via POST to API.
    $.ajax({
        type: 'POST',
        url: '/blogApi/api/posts/',
        data: article,
        success: function(updatedArticle){
            // Confirms Success.
            alert("Article id:" + updatedArticle.id + " was Updated Successfully!");
            // Hide's the updateArticleForm.
            $updateArticleFormDiv.hide();
            //Removes old links.
            $('#navigation > tr').remove();
            //Updates with new links.
            updateNavigation();
        },
        error: function(something){
            alert("It Failed to Update the Article.");
        }
    });
}

// Deletes a selected article.
function deleteArticle($id){

    // Identify the link for that Article Id.
    $navLink = $navigationMenu.find("#row"+$id);

    $.ajax({
        type: 'POST',
        data: {
            action: 'deleteArticle',
            id: $id
        },
        url: '/blogApi/api/posts/',
        beforeSend: function() {
            // Visual Feedback of Deletion.
            $navLink.find('a').animate({ color : '#fff'}, "fast");
            $navLink.animate({ backgroundColor : '#e74c3c', color : '#fff'}, "fast");
        },
        success: function(response){
            $navLink.hide("slow", function() {
                $navLink.remove();
            });
        },
        error: function(something) {
            alert("JQUERY - it failed to Delete the Article.");
          }
    });
}