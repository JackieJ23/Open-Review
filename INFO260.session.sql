-- select *
-- from jjo134_data.employerReview_S left join jjo134_data.employer
-- on employerReview_S.employerId = employer.employer_id
-- where company_name like "Punch Bowl Social"
-- order by reviewDateTime desc
-- limit 10;

-- delete from jjo134_data.employerReview_S
-- where employerid = 992585;

-- select *
-- from jjo134_data.reviewedEmployer_S;

-- select isCurrentJob, jobEndingYear from
-- jjo134_data.employerReview_S
-- where employerid = 992585
-- order by reviewDateTime desc;

-- select *
-- from employer
-- where employer_id = 993525;


-- delete from jjo134_data.employerReview_S
-- where reviewId between 55868596 and 55868628;

-- select * from jjo134_data.employerReview_S
-- order by reviewDateTime desc
-- limit 20;

-- Google - 9079
-- Xero   - 318448


-- SELECT avg(ratingOverall) as ratingOverall,
--                      avg(ratingBusinessOutlook) as ratingBusinessOutlook,
--                      avg(ratingCareerOpportunities) as ratingCareerOpportunities,
--                      avg(ratingCeo) as ratingCeo,
--                      avg(ratingCompensationAndBenefits) as ratingCompensationAndBenefits,
--                      avg(ratingCultureAndValues) as ratingCultureAndValues,
--                      avg(ratingDiversityAndInclusion) as ratingDiversityAndInclusion,
--                      avg(ratingSeniorLeadership) as ratingSeniorLeadership,
--                      avg(ratingWorkLifeBalance) as ratingWorkLifeBalance
--               FROM employerReview_S
--               WHERE employerId = 318448 AND
--                     reviewDateTime REGEXP "^(2013)"



-- select *
-- from employerReview_S
-- where employerid = 9079 and reviewDateTime = (
-- select min(reviewDateTime)
-- from employerReview_S
-- where employerid = 9079);

-- SELECT max(ratingOverall) as 'ratingOverall',
--                      avg(ratingBusinessOutlook) as 'ratingBusinessOutlook',
--                      avg(ratingCareerOpportunities) as 'ratingCareerOpportunities',
--                      avg(ratingCeo) as 'ratingCeo',
--                      avg(ratingCompensationAndBenefits) as 'ratingCompensationAndBenefits',
--                      avg(ratingCultureAndValues) as 'ratingCultureAndValues',
--                      avg(ratingDiversityAndInclusion) as 'ratingDiversityAndInclusion',
--                      avg(ratingSeniorLeadership) as 'ratingSeniorLeadership',
--                      avg(ratingWorkLifeBalance) as 'ratingWorkLifeBalance'
--               FROM employerReview_S
--               WHERE employerId = 9079 AND
--                     reviewDateTime REGEXP CONCAT("^(", "2015-02", ")")

-- SELECT company_name, company_url, count(*) AS total_reviews
-- FROM jjo134_data.employerReview_S LEFT JOIN jjo134_data.reviewedEmployer_S
--       ON employer_id = employerid
-- GROUP BY employer_id
-- ORDER BY count(*) DESC
-- LIMIT 6;

-- SELECT company_name, company_url, reviews_count, overall_rating
-- FROM jjo134_data.reviewedEmployer_S
-- ORDER BY reviews_count DESC
-- LIMIT 6;

-- select *
-- from jjo134_data.employerReview_S
-- where employerid = 9079
-- order by reviewDateTime desc
-- limit 10;

-- delete from jjo134_data.employerReview_S
-- where reviewId = 55868639;




-- select *
-- from jjo134_data.employerReview_S left join jjo134_data.employer on employer_id = employerId
-- where company_name like "Punch Bowl Social"
-- order by reviewDateTime desc
-- limit 10;

-- delete from jjo134_data.employerReview_S
-- where employerid = 992585;