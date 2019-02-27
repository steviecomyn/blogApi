<?php

// Function to connect to the database and keep a static connection.
function db_connect(){

    // Define the connection as a static variable, to avoid multiple connections.
    static $connection;

    if(!isset($connection)){

        // Load external configuration as an array.
        $config = parse_ini_file('config.ini');

        // Try and Connect to the Database with config array.
        $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
        
    }

    // If Connection was unsuccessful, tell me.
    if($connection === false){

        // Give an explaination.
        return mysqli_connect_error();

    }

    // If successful, Return connection.
    return $connection;

}

// Function for Querying the Database.
function db_query($query){

    // Connect to Database.
    $connection = db_connect();

    // Query the Database with given query.
    $result = mysqli_query($connection, $query);

    return $result;
}

// Function for Outputing Database to Array.
function db_select($query) {
    $rows = array();
    $result = db_query($query);
    
    // If query failed, return `false`
    if($result === false) {
        return false;
    }
    
    // If query was successful, retrieve all the rows into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Takes the sql query, pulls data from the db returns it in JSON form.
function db_retrieveAllArticles(){

    // SQL Statement.
    $sql = "SELECT * FROM articles";

    // Get Data from Database.
    $array = db_select($sql);

    // Check to see if it's valid.
    if($array === false) {
        echo "ERROR - No Records.";
    }

    // outputs the JSON.
    header('Content-type: text/json');
    echo json_encode($array);
}

// Takes 1 article Id and returns that article row in JSON Form.
function db_retrieveArticle($id){

    // SQL Statement.
    $sql = "SELECT * FROM articles WHERE articleid='$id'";

    // Get Data from Database.
    $array = db_select($sql);

    // Check to see if it's valid.
    if($array === false) {
        echo "ERROR - No Records.";
    }

    // outputs the JSON.
    header('Content-type: text/json');
    echo json_encode($array);
}

function db_createArticle($json){

    //Decode JSON into PHP Array.
    //$array = json_decode($json, true);
    $array = $json;

    // Connect to Database.
    $connection = db_connect();

    //Seperate variables from array.
    $title = $array['title'];
    $bodyText = $array['bodyText'];
    $coverImage = $array['coverImage'];
    $publishDate = $array['publishDate'];

    // prepare and bind
    $stmt = $connection->prepare("INSERT INTO articles (title, bodyText, coverImage, publishDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $bodyText, $coverImage, $publishDate);

    if ($stmt->execute()) {
        // If Sucessful, Return JSON Response.
        header('Content-type: text/json');
        echo json_encode($array);

     } else {
        var_dump($array);
        echo "Error - Creating an Article Failed.";
     }
}

?>