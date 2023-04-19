<?php
require_once "config.php";


/**
 * Create connection to the database
 *
 * @return PDO object which is the connection to the database
 */
function openConnection(): PDO
{
    global $config;

    try {
        $pdo = new PDO($config['db']['attr'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    return $pdo;
}

/**
 * Get the names of all the companies which have reviews
 *
 * @return array object with the key as the employer_id and the company_value as the value
 */
function getCompanyNames(): array
{
    $names = array();
    $pdo = openConnection();
    $query = "SELECT employer.employer_id, employer.company_name
              FROM employer LEFT JOIN reviewedEmployer_S
              ON employer.employer_id = reviewedEmployer_S.employer_id
              ORDER BY reviews_count DESC
              LIMIT 20;";
    $result = $pdo->query($query);
    $pdo = null;

    while ($row = $result->fetch()) {
        $employer_id = htmlspecialchars(($row["employer_id"]));
        $company_name = htmlspecialchars(($row["company_name"]));

        $names[$employer_id] = $company_name;
    }

    $result = null;
    return $names;
}

/**
 * Gets the aggregated statistics of a given company
 *
 * @param int $company_id
 * @return array object of the statistic_name => value
 */
function getCompanyStats(int $company_id): array
{
    $query = "SELECT company_name,
                     company_hq,
                     company_url,
                     reviews_count,
                     business_outlook_rating,
                     career_opportunities_rating,
                     ceo_rating,
                     compensation_and_benefits_rating,
                     culture_and_values_rating,
                     diversity_and_inclusion_rating,
                     recommend_to_friend_rating,
                     senior_leadership_rating,
                     work_life_balance_rating,
                     overall_rating
              FROM reviewedEmployer_S
              WHERE employer_id = :employer_id;";

    $pdo = openConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':employer_id', $company_id, PDO::PARAM_INT);

    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stats) { // No reviews for employer
        $query = "SELECT company_name, company_hq, company_url, employer_id
                  FROM employer
                  WHERE employer_id = :employer_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':employer_id', $company_id, PDO::PARAM_INT);
        $stmt->execute();
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $pdo = null;
    $stmt = null;
    return $stats;
}

/**
 * Searches the names of all the reviewed companies and returns 20 matches ordered alphabetically
 *
 * @param string $search_term
 * @return array object containing arrays of each company name and id
 */
function getSearchValues(string $search_term): array
{

    $full_term = "%".$search_term."%";
    $prefix_term = $search_term."%";
    $suffix_term = "%".$search_term."%";

    $query = "SELECT employer.employer_id, employer.company_name
              FROM employer LEFT JOIN reviewedEmployer_S
              ON employer.employer_id = reviewedEmployer_S.employer_id
              WHERE employer.company_name LIKE :full_term
              ORDER BY reviews_count DESC,
                  CASE
                      WHEN employer.company_name LIKE :search_term THEN 1
                      WHEN employer.company_name LIKE :prefix_term THEN 2
                      WHEN employer.company_name LIKE :suffix_term THEN 4
                      ELSE 3
                  END

              LIMIT 20;";

    $pdo = openConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':full_term', $full_term, PDO::PARAM_STR);
    $stmt->bindParam(':search_term', $search_term, PDO::PARAM_STR);
    $stmt->bindParam(':prefix_term', $prefix_term, PDO::PARAM_STR);
    $stmt->bindParam(':suffix_term', $suffix_term, PDO::PARAM_STR);
    $stmt->bindParam(':suffix_term', $suffix_term, PDO::PARAM_STR);
    $stmt->execute();
    $companies = $stmt->fetchAll();

    $pdo = null;
    $stmt = null;
    return $companies;
}

function getCompanyName($company_id)
{
    $query = "SELECT company_name,
                     employer_id
              FROM employer
              WHERE employer_id = :employer_id;";

    $pdo = openConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':employer_id', $company_id, PDO::PARAM_INT);

    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
    return $stats;
}

function insertReview($review): bool
{
    extract($review);
    $insert = "INSERT INTO employerReview_S (
                employerId,
                reviewDateTime,
                advice,
                cons,
                employmentStatus,
                isCurrentJob,
                jobEndingYear,
                jobTitle,
                lengthOfEmployment,
                pros,
                ratingBusinessOutlook,
                ratingCareerOpportunities,
                ratingCeo,
                ratingCompensationAndBenefits,
                ratingCultureAndValues,
                ratingDiversityAndInclusion,
                ratingOverall,
                ratingRecommendToFriend,
                ratingSeniorLeadership,
                ratingWorkLifeBalance,
                summary
            )
            VALUES (
                :employerId,
                NOW(),
                :advice,
                :cons,
                :employmentStatus,
                :isCurrentJob,
                :jobEndingYear,
                :jobTitle,
                :lengthOfEmployment,
                :pros,
                :ratingBusinessOutlook,
                :ratingCareerOpportunities,
                :ratingCeo,
                :ratingCompensationAndBenefits,
                :ratingCultureAndValues,
                :ratingDiversityAndInclusion,
                :ratingOverall,
                :ratingRecommendToFriend,
                :ratingSeniorLeadership,
                :ratingWorkLifeBalance,
                :summary
            );";

    $pdo = openConnection();
    $stmt = $pdo->prepare($insert);
    $stmt->bindParam(':employerId', $employerId, PDO::PARAM_INT);
    $stmt->bindParam(':advice', $advice, PDO::PARAM_STR);
    $stmt->bindParam(':cons', $cons, PDO::PARAM_STR);
    $stmt->bindParam(':employmentStatus', $employmentStatus, PDO::PARAM_INT);
    $stmt->bindParam(':isCurrentJob', $isCurrentJob, PDO::PARAM_INT);
    $stmt->bindParam(':jobEndingYear', $jobEndingYear, PDO::PARAM_INT);
    $stmt->bindParam(':jobTitle', $jobTitle, PDO::PARAM_STR);
    $stmt->bindParam(':lengthOfEmployment', $lengthOfEmployment, PDO::PARAM_INT);
    $stmt->bindParam(':pros', $pros, PDO::PARAM_STR);
    $stmt->bindParam(':ratingBusinessOutlook', $ratingBusinessOutlook, PDO::PARAM_INT);
    $stmt->bindParam(':ratingCareerOpportunities', $ratingCareerOpportunities, PDO::PARAM_INT);
    $stmt->bindParam(':ratingCeo', $ratingCeo, PDO::PARAM_INT);
    $stmt->bindParam(':ratingCompensationAndBenefits', $ratingCompensationAndBenefits, PDO::PARAM_INT);
    $stmt->bindParam(':ratingCultureAndValues', $ratingCultureAndValues, PDO::PARAM_INT);
    $stmt->bindParam(':ratingDiversityAndInclusion', $ratingDiversityAndInclusion, PDO::PARAM_INT);
    $stmt->bindParam(':ratingOverall', $ratingOverall, PDO::PARAM_INT);
    $stmt->bindParam(':ratingRecommendToFriend', $ratingRecommendToFriend, PDO::PARAM_INT);
    $stmt->bindParam(':ratingSeniorLeadership', $ratingSeniorLeadership, PDO::PARAM_INT);
    $stmt->bindParam(':ratingWorkLifeBalance', $ratingWorkLifeBalance, PDO::PARAM_INT);
    $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);


    $retval = $stmt->execute();
    $pdo = NULL;
    $stmt = NULL;
    return $retval;
}

function getNumReviews($employer_id)
{
    $query = "SELECT COUNT(*) AS num_reviews
              FROM employerReview_S
              WHERE employerId = :employer_id;";

    $pdo = openConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);

    $stmt->execute();
    $num_reviews = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = NULL;
    $stmt = NULL;
    return $num_reviews;
}

function getReviewsPage($employer_id, $page_num, $page_size): array
{
    $query = "SELECT *
              FROM employerReview_S
              WHERE employerId = :employer_id
              ORDER BY reviewDateTime DESC
              LIMIT :page_size
              OFFSET :offset;";

    $offset = ($page_num - 1) * $page_size;

    $pdo = openConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
    $stmt->bindParam(':page_size', $page_size, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    $results = array();
    while ($result = $stmt->fetch()) {
        $result["reviewDateTime"] = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $result["reviewDateTime"]), 'j M Y \a\t g:i A');
        $results[] = $result;
    }

    return array("data" => $results);
}

function getTimeRange(int $employer_id, string $period, string $trend)
{

    $validTrends = array("ratingBusinessOutlook",
                         "ratingCareerOpportunities",
                         "ratingCeo",
                         "ratingCompensationAndBenefits",
                         "ratingCultureAndValues",
                         "ratingDiversityAndInclusion",
                         "ratingOverall",
                         "ratingWorkLifeBalance",
                         "ratingSeniorLeadership",
    );

    if (in_array($trend, $validTrends)) {
        $minMaxQuery = "SELECT MIN(reviewDateTime) AS minDate,
                            MAX(reviewDateTime) AS maxDate
                        FROM employerReview_S
                        WHERE employerId = :employer_id AND
                              {$trend} != 0 and NOT ISNULL({$trend})";
    } else {
        return false;
    }

    $pdo = openConnection();
    $minMaxStmt = $pdo->prepare($minMaxQuery);
    $minMaxStmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
    $minMaxStmt->execute();
    $minMax = $minMaxStmt->fetchAll();

    if ($minMax[0]["minDate"] == NULL ||
        $minMax[0]["maxDate"] == NULL) {
        return false;
    }
    $minYear = intval(date_format(DateTime::createFromFormat('Y-m-d H:i:s', $minMax[0]["minDate"]), "Y"));
    $maxYear = intval(date_format(DateTime::createFromFormat('Y-m-d H:i:s', $minMax[0]["maxDate"]), "Y"));


    $dates = array();
    if ($period == "month") {
        $minMonth = intval(date_format(DateTime::createFromFormat('Y-m-d H:i:s', $minMax[0]["minDate"]), "m"));
        $maxMonth = intval(date_format(DateTime::createFromFormat('Y-m-d H:i:s', $minMax[0]["maxDate"]), "m"));

        $year = $minYear;
        $month = $minMonth;
        while ($year < $maxYear || $month <= $maxMonth) {
            $strMonth = str_pad($month, 2, '0', STR_PAD_LEFT);
            $dates[] = "${year}-${strMonth}";
            if ($month + 1 > 12) $year++;
            $month = ($month + 1) > 12 ? 1 : $month + 1;
        }
    } else {
        foreach (range($minYear, $maxYear) as $year) {
            $dates[] = strval($year);
        }
    }
    return $dates;
}

function getTrendData($employer_id, $trend, $timeRange)
{
    // Labels => Years/Months
    // Data   => Aggregate value for Year/Month

    // Could use regex to match start of dates in database
    $validTrends = array("ratingBusinessOutlook",
                         "ratingCareerOpportunities",
                         "ratingCeo",
                         "ratingCompensationAndBenefits",
                         "ratingCultureAndValues",
                         "ratingDiversityAndInclusion",
                         "ratingOverall",
                         "ratingWorkLifeBalance",
                         "ratingSeniorLeadership",
    );

    if (in_array($trend, $validTrends)) {
    $query = "SELECT avg({$trend}) as 'rating'
              FROM employerReview_S
              WHERE employerId = :employer_Id AND
                    reviewDateTime REGEXP CONCAT(\"^(\", :time_period, \")\")";
    } else {
        return false;
    }


    $pdo = openConnection();

    $stmt = $pdo->prepare($query);
    // $stmt->bindParam(, PDO::PARAM_INT);

    $results = array();
    foreach ($timeRange as $time) {
        $stmt->execute([":time_period" => $time, ":employer_Id" => $employer_id]);
        $result = $stmt->fetch()["rating"];
        $results[] = is_null($result) ? 0 : $result;
    }

    $data = array("labels" => $timeRange,
                "datasets" => array(array(
                "label" => "Rating",
                "data" => $results,
                "fill" => false,
                "borderColor" => 'rgb(75, 192, 192)',
                "tension" => 0.1
                )));

    $pdo = null;
    $stmt = null;
    return $data;
}

function getTotalReviews(){
    $query = "SELECT COUNT(*) AS total_reviews
              FROM employerReview_S;";

    $pdo = openConnection();
    $result = $pdo->query($query);
    $total_reviews = $result->fetch()["total_reviews"];

    $pdo = null;
    $result = null;
    return $total_reviews;
}

function getTopSixReviewsCount(){
    $query = "SELECT company_name, company_url, reviews_count, overall_rating
              FROM reviewedEmployer_S
              ORDER BY reviews_count DESC
              LIMIT 6;";

    $pdo = openConnection();
    $result = $pdo->query($query);
    $total_reviews = $result->fetchAll();

    $pdo = null;
    $result = null;
    return $total_reviews;
}
?>