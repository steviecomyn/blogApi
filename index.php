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
<div id="loader"><div id="spinner"></div></div>
<header>
<div class="icon">
    <img src="icon.png" alt="API">
</div>
<div class="title">
    <h1>JSON API - Backend Control Panel</h1>
    <p>This project has been created to act as an API for my Blog by serving Database entries via GET Methods in JSON format.</p>
</div>
</header>
<hr>

<h2>Create an Article</h2>

<form class="createArticle" id="createArticleForm" action="">

    Post Title:<br>
    <input type="text" id="title"><br>
    Body Text:<br>
    <textarea id="bodyText" cols="50" rows="10"></textarea><br>
    Publish Date:<br>
    <input type="text" id="publishDate" value="<?php echo date("Y-m-d"); ?>" disabled>
    <br><br>
    <button id="submit">Create</button>
</form>

<br><hr>

<h2>Retrieve an Article</h2>
<div id="retrieveSection">
    <div id="navigationDiv">
        <h4>Navigation Links</h4>
        <table id="navigation">
        <thead><tr>
            <td>Title</td>
            <td style="text-align: center;">Edit</td>
            <td style="text-align: center;">Delete</td>
        </tr></thead>
        </table>
    </div>

    <div id="contentDiv">
        <h4>Content Area</h4>
        <div class="content">
        Content will load here.
        </div>
    </div>
</div>

<div id="updateArticleFormDiv">
<br><hr>
    <h2>Update an Article</h2>

    <form class="updateArticle" id="updateArticleForm" action="">
        Post id:<br>
        <input type="text" id="id" disabled><br>
        Post Title:<br>
        <input type="text" id="title"><br>
        Body Text:<br>
        <textarea id="bodyText" cols="50" rows="10"></textarea><br>
        Publish Date:<br>
        <input type="text" id="publishDate" value="<?php echo date("Y-m-d"); ?>" disabled>
        <br><br>
        <button id="submit">Update</button>
        <button id="cancel">Cancel</button>
    </form>
</div>

<script src="js/jqueryFunctions.js"></script>
<script src="js/jquery.animate-colors-min.js"></script>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>