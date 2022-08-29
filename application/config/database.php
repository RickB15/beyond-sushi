<?php
   $serverName = "localhost";
   $userName = "root";
   $password = "";
   $databaseName = "beyond_sushi";

   $conn = mysqli_connect($serverName, $userName, $password, $databaseName) or die("Database is niet werkzaam");

   $query = "SELECT * FROM `photos`";

   $result = mysqli_query($conn, $query);

   $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

   $jsonString = json_encode($records);

   echo $jsonString;