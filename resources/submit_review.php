<?php
  require_once(realpath(dirname(__file__) . "/database.php"));
  $errorMessage = false;

  $review_data = array();
  $review["employerId"] = intval($_POST["companyId"]);
  $review["advice"] = $_POST["adviceText"];
  $review["cons"] = $_POST["negativesText"];
  $review["employmentStatus"] = intval($_POST["employmentStatus"]);
  $review["isCurrentJob"] = intval($_POST["isCurrentJob"]);
  $review["jobEndingYear"] = $review["isCurrentJob"] ? NULL : intval($_POST["jobEnding"]);
  $review["jobTitle"] = $_POST["jobTitle"];
  $review["lengthOfEmployment"] = intval($_POST["employmentLen"]);
  $review["pros"] = $_POST["positivesText"];
  $review["ratingBusinessOutlook"] = intval($_POST["businessOutlook"]);
  $review["ratingCareerOpportunities"] = intval($_POST["careerOpportunities"]);
  $review["ratingCeo"] = intval($_POST["ceoRating"]);
  $review["ratingCompensationAndBenefits"] = intval($_POST["compBenefits"]);
  $review["ratingCultureAndValues"] = intval($_POST["cultureValues"]);
  $review["ratingDiversityAndInclusion"] = intval($_POST["diversityInclusion"]);
  $review["ratingOverall"] = intval($_POST["overallRating"]);
  $review["ratingRecommendToFriend"] = intval($_POST["recommendToFriend"]);
  $review["ratingSeniorLeadership"] = intval($_POST["seniorLeader"]);
  $review["ratingWorkLifeBalance"] = intval($_POST["workLife"]);
  $review["summary"] = $_POST["summaryText"];


  $insertResponse = insertReview($review);
  echo json_encode(array("wasSuccessful" => $insertResponse,
                         "companyName" => $_POST["companyName"],
                         "errorMessage" => $errorMessage));
?>