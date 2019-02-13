<?php
require('config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSON API Backend</title>
</head>
<body>

<h1>JSON API - Backend Version. 1</h1>
<p>This project has been created to act as an API for my Blog by serving Database entries via GET Methods in JSON format.</p>
<hr>

<h2>Insert a Blog Post</h2>

<form action="">

    Post Title:<br>
    <input type="text" value="Post Title">
    <br><br>
    Body Text:<br>
    <textarea name="bodyText" cols="50" rows="10">This is Example Text.</textarea>
    <br><br>
    <input type="submit" value="Submit">

</form>

<br><hr>
<p>Stevie Comyn &copy; 2019</p>
</body>
</html>