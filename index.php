<?php
require('config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>JSON API Backend</title>
</head>
<body>

<header>
<div class="icon">
    <img src="icon.png" alt="API">
</div>
<div class="title">
    <h1>JSON API - Backend Test Area</h1>
    <p>This project has been created to act as an API for my Blog by serving Database entries via GET Methods in JSON format.</p>
</div>
</header>
<hr>

<h2>Insert a Blog Post</h2>

<form id="createArticleForm" action="">

    Post Title:<br>
    <input type="text" id="postTitle"><br>
    Body Text:<br>
    <textarea id="bodyText" cols="50" rows="10"></textarea>
    <br><br>
    <input type="hidden" id="publishDate" value="<?php echo date("Y-m-d"); ?>">
    <input type="hidden" id="coverImage" value="<?php echo 'Image.jpg'; ?>">
    <button id="submitNewArticle">Submit</button>
</form>

<br><hr>

<h2>View a Blog Post</h2>

<table id="navigation">
<thead><tr>
    <td>Title</td>
    <td style="text-align: center;">Edit</td>
    <td style="text-align: center;">Delete</td>
</tr></thead>
</table>

<div id="modifyForm">
    <h2>Modify a Blog Post</h2>

    <form id="modifyArticleForm" action="">

        Post Title:<br>
        <input type="text" id="editPostTitle"><br>
        Body Text:<br>
        <textarea id="editBodyText" cols="50" rows="10"></textarea>
        <br><br>
        <button id="submitEditedArticle">UPDATE</button>
        <button id="cancelEditArticle">cancel</button>
    </form>
</div>

<div id="contentDiv">
    <h4>Content Div</h4>
    <div class="content">
    Content will load here.
    </div>
</div>

<script src="js/jqueryFunctions.js"></script>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>