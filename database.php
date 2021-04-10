<?php

function get_database_connection(){


    //Get Heroku ClearDB connection information
    $cleardb_server = 'us-cdbr-east-03.cleardb.com';
    $cleardb_username = 'b6983a03d950c7';
    $cleardb_password = '990c3567';
    $cleardb_db = 'heroku_84286c27b59354c';

    // Connect to DB
    $database_conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    // check if the any error in connection.
    if ($database_conn->connect_errno){
        die('The are some issue on connection of database : '.$database_conn->connect_error);
    }

    // return connection object.
    return $database_conn;
}

