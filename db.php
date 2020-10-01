<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PSW", "password");
define("DB_NAME", "database");

$db = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME);
