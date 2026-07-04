<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<body bgcolor = "#336699">
  <a href="javascript:history.back()">Go Back</a><br><br>

<?php

  $form_search_string = strtolower($_POST["search_string"]);
  echo "<b>Searching for:</b>  ".$form_search_string."<br><br><br>";

   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('bookmarks.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   }

   $results = $db->query('SELECT * FROM bookmarks');
   while ($row = $results->fetchArray()) {
     $full_row = strtolower($row["url"]." ".$row["description"]." ".$row["tags"]);

     if ($form_search_string == '' || strpos($full_row, $form_search_string) !== false) {
       echo $row["url"]."<br>";
       echo $row["description"]."<br>";
       echo $row["tags"]."<br>";
     }
   }	
   $db->close();
?>
 

</body>
</html>

