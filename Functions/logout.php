<?php 
require "../Functions/db_conn.php";
require "insertLogs.php";


session_start();
insertLogs("Logged out");

session_unset();
session_destroy();

header("Location: ../index.php");