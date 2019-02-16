<?php
require('config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>JSON API Backend</title>
</head>
<body>

<h1>JSON API - Backend Version. 1</h1>
<p>This project has been created to act as an API for my Blog by serving Database entries via GET Methods in JSON format.</p>
<hr>

<h2>Insert a Blog Post</h2>

<form action="">

    Post Title:<br>
    <input type="text" name="postTitle">
    <br><br>
    Body Text:<br>
    <textarea name="bodyText" cols="50" rows="10"></textarea>
    <br><br>
    <input type="submit" value="Submit">
</form>

<br><hr>

<h2>View a Blog Post</h2>

<ul>
    <li><a href="">Week 1</a></li>
    <li><a href="">Week 2</a></li>
    <li><a href="">Week 3</a></li>
    <li><a href="">Week 4</a></li>
    <li><a href="">Week 5</a></li>
</ul>

<p>Content Div</p>
<div class="content" style="border: 1px solid #000; padding: 1em; width: 60%;">
</div>

<script>

    $(function(){

        var $content = $('.content');

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: '/blogApi/api/posts/',
            success: function(posts){
                $.each(posts, function(i, item) {
                    $content.append('<span>'+ item.articleId + ' - ' + item.title +'</span><br>');
                });
            }
        });
    });



</script>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>