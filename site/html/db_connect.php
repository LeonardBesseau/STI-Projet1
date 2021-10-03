<?php

// Set default timezone
date_default_timezone_set('UTC');

try {
    /**************************************
     * Create databases and                *
     * open connections                    *
     **************************************/

    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:../../databases/database.sqlite');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    // Create table users
    $file_db->exec("CREATE TABLE IF NOT EXISTS users (
                    email TEXT PRIMARY KEY NOT NULL, 
                    password TEXT NOT NULL, 
                    is_activ BOOLEAN NOT NULL, 
                    is_admin BOOLEAN NOT NULL)");

    // Create table messages
    $file_db->exec("CREATE TABLE IF NOT EXISTS messages (
                    'id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
                    'subject' TEXT NOT NULL, 
                    'body' TEXT NOT NULL, 
                    'sender' TEXT NOT NULL, 
                    'recipient' TEXT NOT NULL, 
                    'date' DATETIME NOT NULL,
                    FOREIGN KEY(sender) REFERENCES User(email),
                    FOREIGN KEY(recipient) REFERENCES User(email))");

} catch(PDOException $e) {

    echo "lol";
    // Close file database.sqlite connection
    $file_db = null;
    // Print PDOException message
    echo $e->getMessage();
}

