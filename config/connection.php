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
function allArticlesJSON(){

    // SQL Statement.
    $sql = "SELECT * FROM articles";

    // Get Data from Database.
    $array = db_select($sql);

    // Check to see if it's valid.
    if($array === false) {
        echo "ERROR - No Records.";
    }

    // outputs the JSON.
    echo json_encode($array);
}

// Takes 1 article Id and returns that article row in JSON Form.
function oneArticleJSON($id){

    // SQL Statement.
    $sql = "SELECT * FROM articles WHERE articleid='$id'";

    // Get Data from Database.
    $array = db_select($sql);

    // Check to see if it's valid.
    if($array === false) {
        echo "ERROR - No Records.";
    }

    // outputs the JSON.
    echo json_encode($array);
}

?>