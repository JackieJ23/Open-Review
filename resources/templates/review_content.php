<div class="container mt-3 text-center">
  <div class="row text-center g-0">
    <h1 class="display-1">Review Employer</h1>
  </div>


  <div class="row mt-2">
    <div class="col-10">
      <?php // Search box for finding company stats?>
      <select class="form-select" id="companySearch">
        <option value="" selected disabled>Select Company</option>
        <?php
          $company_names = getCompanyNames();
          foreach ($company_names as $company_id => $company_name) {
            echo "<option value=\"$company_id\">$company_name</option>";
          }
        ?>
      </select>
    </div>
    <div class="col-2 d-grid">
       <button class="btn btn-primary btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#reviewFormContainer" aria-expanded="false" aria-controls="collapse review form">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
          </svg>
          Review
        </button>
    </div>
  </div>

  <div class="row mt-3">
    <div id="liveAlertPlaceholder"></div>
  </div>
</div>

<div id="reviewFormContainer" class="container mt-2 mb-5 collapse">
  <form id="reviewForm" class="needs-validation" novalidate>
    <input name="companyId" type="hidden" id="companyId" required>
    <div class="row mb-3">
      <div class="col-12">
        <div class="form-floating">
          <input name="companyName" type="text" class="readonly form-control" id="staticCompanyName" autocomplete="off" placeholder="Company Name" required>
          <label for="staticCompanyName">Company (select above)</label>
        </div>
      </div>
    </div>
    <div class="mb-3 row align-items-center">
      <div class="col-3">
        <div class="form-floating">
          <input name="jobTitle" type="text" class="form-control" id="jobTitle" placeholder="Job Title" maxlength="255" required>
          <label for="jobTitle">Job Title</label>
        </div>
      </div>
      <div class="col-2">
        <div class="form-floating">
          <input name="employmentLen" type="number" class="form-control" id="employmentLen" min="0" max="100" placeholder="Years Employed" required>
          <label for="employmentLen">Years Employed</label>
        </div>
      </div>
      <div class="col-3">
        <div class="form-floating">
          <input name="jobEnding" type="number" class="form-control" id="jobEnding" min="1900" placeholder="Job Ending Year" required>
          <label for="jobEnding">Job Ending Year</label>
        </div>
      </div>
      <div class="col-2">
        <div class="form-check">
          <input name="isCurrentJob" type="checkbox" class="form-check-input" id="isCurrentJob">
          <label class="form-check-label" for="isCurrentJob">Current Job</label>
        </div>
      </div>
      <div class="col-2">
        <div class="form-check">
          <input name="recommendToFriend" type="checkbox" class="form-check-input" id="recommendToFriend">
          <label class="form-check-label" for="recommendToFriend">Recommend to friend</label>
        </div>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-4">
        <div class="form-floating">
          <select name="employmentStatus" class="form-select" id="employmentStatusSelect" aria-label="Employment status select" required>
            <option disabled selected hidden value="">Select Status</option>
            <option value=1>Intern</option>
            <option value=2>Freelance</option>
            <option value=3>Contract</option>
            <option value=4>Part time</option>
            <option value=5>Regular/Full time</option>
          </select>
          <label for="employmentStatusSelect">Employment Status</label>
        </div>
      </div>
      <div class="col-4">
        <div class="form-floating">
          <select name="businessOutlook" class="form-select" id="businessOutlookSelect" aria-label="Business outlook select" required>
            <option disabled selected hidden value="">Select Outlook</option>
            <option value=1>Neutral</option>
            <option value=2>Negative</option>
            <option value=3>Positive</option>
          </select>
          <label for="businessOutlookSelect">Business Outlook</label>
        </div>
      </div>
      <div class="col-4">
        <div class="form-floating">
          <select name="ceoRating" class="form-select" id="ceoRatingSelect" aria-label="CEO rating select" required>
            <option disabled selected hidden value="">Select Rating</option>
            <option value=1>Disapprove</option>
            <option value=2>No opinion</option>
            <option value=3>Approve</option>
          </select>
          <label for="ceoRatingSelect">CEO Rating</label>
        </div>
      </div>
    </div>
    <div class="mb-3 row align-items-center">
      <div class="col-3">
        <label for="careerOpportunities" class="form-label">Career Opportunities - <output id="careerOpportunitiesVal">3</output></label>
        <input name="careerOpportunities" type="range" class="form-range" min="0" max="5" id="careerOpportunities" oninput="careerOpportunitiesVal.value = careerOpportunities.value">
      </div>
      <div class="col-3">
        <label for="comp" class="form-label">Compensation & Benefits - <output id="compVal">3</output></label>
        <input name="compBenefits" type="range" class="form-range" min="0" max="5" id="comp" oninput="compVal.value = comp.value">
      </div>
      <div class="col-3">
        <label for="cultureValues" class="form-label">Culture & Values - <output id="cultureValuesVal">3</output></label>
        <input name="cultureValues" type="range" class="form-range" min="0" max="5" id="cultureValues" oninput="cultureValuesVal.value = cultureValues.value">
      </div>
      <div class="col-3">
        <label for="diversityInc" class="form-label">Diversity & Inclusion - <output id="diversityIncVal">3</output></label>
        <input name="diversityInclusion" type="range" class="form-range" min="0" max="5" id="diversityInc" oninput="diversityIncVal.value = diversityInc.value">
      </div>
    </div>
    <div class="mb-3 row align-items-center">
      <div class="col-3">
        <label for="seniorLeader" class="form-label">Senior Leadership - <output id="seniorLeaderVal">3</output></label>
        <input name="seniorLeader" type="range" class="form-range" min="0" max="5" id="seniorLeader" oninput="seniorLeaderVal.value = seniorLeader.value">
      </div>
      <div class="col-3">
        <label for="workLife" class="form-label">Work Life Balance - <output id="workLifeVal">3</output></label>
        <input name="workLife" type="range" class="form-range" min="0" max="5" id="workLife" oninput="workLifeVal.value = workLife.value">
      </div>
      <div class="col-3">
        <label for="overall" class="form-label">Overall Rating - <output id="overallVal">3</output></label>
        <input name="overallRating" type="range" class="form-range" min="0" max="5" id="overall" oninput="overallVal.value = overall.value">
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-12">
        <div class="form-floating">
          <textarea name="adviceText" class="form-control" id="adviceTextArea" placeholder="Company advice" aria-label="Advice" maxlength="255" required></textarea>
          <label for="adviceTextArea">Advice</label>
        </div>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-6">
        <div class="form-floating">
          <textarea name="positivesText" class="form-control" id="positivesTextArea" placeholder="Company pros" aria-label="Positives" maxlength="255" required></textarea>
          <label for="positivesTextArea">Positives</label>
        </div>
      </div>
      <div class="col-6">
        <div class="form-floating">
          <textarea name="negativesText" class="form-control" id="negativesTextArea" placeholder="Company cons" aria-label="Negatives" maxlength="255" required></textarea>
          <label for="negativesTextArea">Negatives</label>
        </div>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-12">
        <div class="form-floating">
          <textarea name="summaryText" class="form-control" id="summaryTextArea" placeholder="Summary" aria-label="Summary" maxlength="255" required></textarea>
          <label for="summaryTextArea">Summary</label>
        </div>
      </div>
    </div>
    <button type="submit" id="reviewSubmit" class="btn btn-primary" value="submit">Submit Review</button>
  </form>
</div>

<main id="reviews-container" class="container mb-5">
  <div id="review-pagination" class="mb-2"></div>
  <div id="review-content" class="list-group mb-2"></div>
</main>

<script>
var paginationContainer;
<?php
  // Set JS variables to display form if we are coming from the overview page and have clicked on "review"
  if (isset($_POST["company_id"])) {
    $company_id = intval($_POST["company_id"]);
    $company_name = $_POST["company_name"];
    echo "var startSearch = true;
var companyId = {$company_id}
var companyName = \"{$company_name}\";";
}
?>

// enabling dselect for selectable search box
dselect(document.querySelector('#companySearch'),{
search: true
});


$(document).ready(function(e) {
  $("#companySearch").on('change', function() {
    selectChange();
  });

  $("input:text.form-control").first().on('input', function() {
    searchChange();
  });

  // Set max value on employment year ended to current year
  $("#jobEnding").attr({
      "max" : new Date().getFullYear()
  });

  $("#jobEnding").val(new Date().getFullYear());

  if (typeof startSearch !== 'undefined' && startSearch) {
    $('#companySearch').append($('<option>', {
        value: companyId,
        text: companyName
    }));

    $("#companySearch").val(companyId).change();
  };
});

const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

const alert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

// Register collapsable form
const bsCollapse = new bootstrap.Collapse('#reviewFormContainer', {
  toggle: false
});

if (typeof startSearch !== 'undefined' && startSearch) {
  bsCollapse.show();
}

// Custom readonly https://stackoverflow.com/questions/12777751/html-required-readonly-input-in-form
$(".readonly").on('keydown paste focus mousedown', function(e){
    if(e.keyCode != 9) // ignore tab
        e.preventDefault();
});

function getFormData(form) {
    let formDataArr = form.serializeArray();
    let formData = {};

    formDataArr.forEach((inputObj) => {
      formData[inputObj.name] = inputObj.value;
    });

    formData.isCurrentJob = $("#isCurrentJob").is(":checked") | 0;
    formData.recommendToFriend = 1 + $("#recommendToFriend").is(":checked");
    return formData;
}

function resetReviewForm($form) {
    $form.find('input:text, select, textarea').val('');
    $form.find('input[type=range]').val('3');
    $form.find('output').html('3');
    $form.find('#employmentLen').val('');
    $form.find('#jobEnding').val(new Date().getFullYear());
    $form.find('input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

function insertReview(reviewData) {
  $.post(
    "./../resources/submit_review.php",
    reviewData,
    function(response) {
      $("#liveAlertPlaceholder").empty();
      if (response.wasSuccessful) {
        $("#reviewForm").removeClass('was-validated');
        bsCollapse.hide();
        resetReviewForm($('#reviewForm'));
        // Clear alerts then alert
        alert(`Review for ${response.companyName} submitted`, 'success')
        refreshPagination();
      } else {
        alert(`Review for ${response.companyName} failed`, 'danger')
        if (response.errorMessage !== false) {
          alert("Reason: " + response.errorMessage, 'danger')
        }
      }
    },
    "json",
  );
}

$("#reviewForm").submit(function( event ) {
  event.preventDefault();
  event.stopPropagation();

  if (this.checkValidity()) {
    formData = getFormData($(this));
    insertReview(formData);
  } else {
    $(this).addClass('was-validated');
  };
});

function selectChange() {
  companySelected({companyId: $("#companySearch").val(),});
  refreshPagination();
}

function companySelected(companyId) {
  $.post(
    "./../resources/getCompanyInfo.php",
    companyId,
    function(data) {
      // Set review form data
      $("#companyId").val(data.employer_id);
      $("#staticCompanyName").val(data.company_name);
      $(document).attr("title", `${data.company_name} Review`);
    },
    "json"
  )
}

function refreshPagination() {
  // Get number of reviews -> setup pagination -> get data for pagination
    $.post(
    "./../resources/getNumReviews.php",
    {companyId: $("#companySearch").val(),},
    function(data) {
      $("#review-content").empty();
      if (typeof paginationContainer !== "undefined") paginationContainer.pagination('destroy');

      if (data.num_reviews == 0) {
        $("#review-content").html("<h3 class=\"text-center\">No reviews found 😔</h3>");
      } else {
        paginationContainer = $("#review-pagination");
        paginationContainer.pagination({
            dataSource: "./../resources/getReviews.php",
            pageSize: 5,
            totalNumber: data.num_reviews,
            locator: "data",
            showPageNumbers: false,
            showNavigator: true,
            showGoInput: true,
            showGoButton: true,
            ajax: {
              type: "GET",
              data: {companyId: $("#companySearch").val(),},
            },
            callback: function(data, pagination) {
              var dataHtml = '';
              $.each(data, function (index, review) {
                dataHtml += `<div class="list-group-item">
                               <div class="d-flex w-100 justify-content-between align-middle">
                                 <div class="d-flex">
                                   <h5>${review.ratingOverall}</h5><span class="material-symbols-outlined">star</span>
                                   <h5 class="col-xs-11">${review.summary}</h5>
                                 </div>
                                 <small>${review.reviewDateTime}</small>
                               </div>
                               <div class="max-height-300px min-height-150px overflow-auto">
                                 <p class="mb-1 overflow-auto">${review.pros}</p>
                                 <p class="mb-1 overflow-auto">${review.cons}</p>
                                 <!-- <small>And some small print.</small> -->
                               </div>
                             </div>`;
              });

              $("#review-content").html(dataHtml);
            },
            className: 'paginationjs-theme-green paginationjs-big',
        });
      }

    },
    "json"
  )
}
</script>