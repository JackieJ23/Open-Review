<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  if (isset($_POST["companyId"])) {
    $company_id = intval($_POST["companyId"]);
    $company_stats = getCompanyStats($company_id);

    foreach ($company_stats as $stat => $val) {
      if (is_null($val)) $company_stats[$stat] = 0;
    }

    echo json_encode($company_stats);
  }
?>