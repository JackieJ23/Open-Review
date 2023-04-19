<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  if (isset($_POST["companyId"])) {
    echo json_encode(getNumReviews(intval($_POST["companyId"])));
  }
?>