<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  if (isset($_GET["companyId"])) {
    $company_id = intval($_GET["companyId"]);
    $page_num = intval($_GET["pageNumber"]);
    $pageSize = intval($_GET["pageSize"]);
    echo json_encode(getReviewsPage($company_id, $page_num, $pageSize));
  }
?>