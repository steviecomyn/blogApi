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

			// Identifies what action is required.
			$action = $_POST['action'];

			// Filter's actions to the right function.
			switch($action){

				case 'createArticle':
					//Pass JSON to create Article function for processing.
					db_createArticle($_POST);
					break;

				case 'updateArticle':
					//Pass JSON to update Article function for processing.
					db_updateArticle($_POST);
					break;

				case 'deleteArticle':
					//Pass JSON to delete Article function for deletion.
					db_deleteArticle($_POST);
				default:
					echo("ARTICLES.PHP - Something failed with the Post");
			}

		} else {
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
		}
		break;

	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;
	}

?>