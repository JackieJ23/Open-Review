<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  if (isset($_POST["companyId"])) {
    $company_id = intval($_POST["companyId"]);
    echo json_encode(getCompanyName($company_id));
  }
?>