<?php
  require_once(realpath(dirname(__file__) . "/database.php"));

  if (isset($_GET["employerId"]) &&
      isset($_GET["trend"]) &&
      isset($_GET["period"])) {

    $employer_id = intval($_GET["employerId"]);
    $trend = $_GET["trend"];
    $period = $_GET["period"];

    $timeRange = getTimeRange($employer_id, $period, $trend);
    if (gettype($timeRange) == 'boolean' &&
        !$timeRange) {
      echo json_encode(false);
      return;
    }

    echo json_encode(getTrendData($employer_id, $trend, $timeRange));
  }
?>