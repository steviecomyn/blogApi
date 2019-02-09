<?php

include('../config/connection.php');

$request_method=$_SERVER["REQUEST_METHOD"];

// For Testing Purposes.
// echo $request_method;

switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				oneArticleJSON($id);
			}
			else
			{
				allArticlesJSON();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

?>