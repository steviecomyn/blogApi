<?php

// Pulls Database connection and Functions.
include('../config/connection.php');

// Determine the type of Request being recieved.
$request_method=$_SERVER["REQUEST_METHOD"];

// filters response based on Request Type.
switch($request_method){
	
	case 'GET':

		// Retrive specific Artile by Id.
		if(!empty($_GET["id"])){

			$id=intval($_GET["id"]);
			db_retrieveArticle($id);

		} else {
			// Show all Articles.
			db_retrieveAllArticles();
		}
		break;

	case 'POST':

		if(!empty($_POST)){
			//Pass JSON to create Article function for processing.
			db_createArticle($_POST);
		} else {
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
		}
		break;

	case 'DELETE':

		// Delete Artile by Id.
		if(!empty($_DELETE["id"])){

			$id=intval($_DELETE["id"]);
			db_deleteArticle($id);

		}
		break;

	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;
	}

?>