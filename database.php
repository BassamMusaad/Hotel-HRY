<?php

function get_database_connection(){

    // connection info.
    $database_info = [
        'host_ip' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'database' => 'hry'
    ];

    // database connection object.
    $database_conn = new mysqli($database_info['host_ip'], $database_info['username'],
        $database_info['password'], $database_info['database']);

    // check if the are any error in the connection.
    if ($database_conn->connect_errno) {
        die('The are some issue on connection of database : ' . $database_conn->connect_error);
    }

    // return connection object.
    return $database_conn;
}

