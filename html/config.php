<?php

$host       = "db";
$username   = "root";
$password   = "my_secret_password";
$dbname     = "myCookBook";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );