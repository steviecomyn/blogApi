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
    <title>JSON API Backend</title>
    <style>
    body {
        background-color: #f5f5f5;
        color: #111;
        font-family: 'Arial', 'Helvetica', sans-serif;
        width: 90%;
        margin: 0 auto;
    }

    a:visited {
        color:blue;
    }
    hr {
        border: 1px solid #BBB;
    }

    header {
        display: grid;
        grid-template-columns: 110px auto;
    }

    .icon img {
        margin: 10px auto;
    }

    h1 {
        line-height: 1.2em;
    }

    .content {
        border: 1px solid #ccc;
        background: #fff;
        padding: 1em;
        margin: 0.5em 0;
        max-width: 400px;
    }

    ul {
        list-style: none;
    }

    li {
        padding: 0.2em;
    }

    textarea,input {
        border-radius: 0;
        min-width: 400px;
        padding: 1em;
        margin: 0.5em 0;
        border: 1px solid #ccc;
        resize: none;
    }

    button {
        background-color: #2196F3;
        color: #fff;
        font-weight: bold;
        font-size: 1em;
        text-transform: uppercase;
        padding: 0.6em 1em;
        border: 0;
        border-radius: 0.2em;
        transition: linear 0.1s;
    }

    button:hover {
        background-color: #39a1f4;
    }

    button:active {
        background-color: #0c7cd6;
    }
    </style>
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

<a href="" id="nav1">Week 1</a>

<a href="" id="nav2">Week 2</a>

<ul id="navigation"></ul>

<h4>Content Div</h4>
<div class="content">
Content will load here.
</div>

<script src="js/jqueryFunctions.js"></script>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>