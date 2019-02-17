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
    <style>
    body {
        background-color: #f5f5f5;
        color: #111;
        font-family: 'Arial', 'Helvetica', sans-serif;
    }
    hr {
        border: 1px solid #BBB;
    }
    </style>
</head>
<body>

<h1>JSON API - Backend Version. 1</h1>
<p>This project has been created to act as an API for my Blog by serving Database entries via GET Methods in JSON format.</p>
<hr>

<h2>Insert a Blog Post</h2>

<form id="createArticleForm" action="">

    Post Title:<br>
    <input type="text" id="postTitle">
    <br><br>
    Body Text:<br>
    <textarea id="bodyText" cols="50" rows="10"></textarea>
    <br><br>
    <input type="hidden" id="publishDate" value="<?php echo date("Y-m-d"); ?>">
    <input type="hidden" id="coverImage" value="<?php echo 'Week10.jpg'; ?>">
    <button id="submitNewArticle">Submit</button>
</form>

<br><hr>

<h2>View a Blog Post</h2>

<ul id="navigation"></ul>

<p>Content Div</p>
<div class="content" style="border: 1px solid #000; padding: 1em; width: 60%; background: #fff;">
</div>

<script src="js/jqueryFunctions.js"></script>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>