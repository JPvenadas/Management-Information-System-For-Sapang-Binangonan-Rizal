<?php 
require "../Functions/db_conn.php";
session_start();
session_unset();
session_destroy();

header("Location: ../index.php");