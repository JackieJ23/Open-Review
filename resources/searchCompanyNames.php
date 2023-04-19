<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  if (isset($_POST["searchTerm"])) {
    echo json_encode(getSearchValues($_POST["searchTerm"]));
  }
?>