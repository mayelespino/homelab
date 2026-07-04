<html>
<body>

<?php
$form_url = $_POST["url"];
$form_tags = $_POST["tags"];
$form_description = $_POST["description"];

echo "<H3>Adding:</H3>";
echo "URL: ".$form_url."<br>";
echo "Description: ".$form_description."<br>";
echo "Tags: ".$form_tags."<br>";


   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('bookmarks.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } 

$db = $connection->prepare("INSERT INTO bookmarks (url, description, tags) VALUES($form_url, $form_description, $form_tags)");
if(!$db->execute()) echo $db->error;

?>
</body>
</html>

