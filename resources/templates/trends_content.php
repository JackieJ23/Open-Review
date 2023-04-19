<div class="container mt-3 text-center">
  <div class="row text-center g-0">
    <h1 class="display-1">Trends</h1>
  </div>

  <div class="row">
    <div class="col-4">
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
    <div class="col-4">
      <div class="form-floating">
        <select class="form-select" id="trendSelect" aria-label="Select Trend">
        <?php
          // Trends to show
          $trends = array("ratingOverall" => "Overall Rating",
                          "ratingBusinessOutlook" => "Business Outlook",
                          "ratingCareerOpportunities" => "Career Opportunities",
                          "ratingCeo" => "CEO Rating",
                          "ratingCompensationAndBenefits" => "Compensation & Benefits",
                          "ratingCultureAndValues" => "Culture & Values",
                          "ratingDiversityAndInclusion" => "Diversity & Inclusion",
                          "ratingSeniorLeadership" => "Senior Leadership Rating",
                          "ratingWorkLifeBalance" => "Work Life Balance Rating"
          );

          $isSelected = false;
          foreach ($trends as $value => $name) {
            if ($isSelected) {
              echo "<option value=\"{$value}\" selected>{$name}</option>";
              $isSelected = true;
            } else {
              echo "<option value=\"{$value}\">{$name}</option>";
            }
          }
        ?>
        </select>
        <label for="trendSelect">Trend</label>
      </div>
    </div>
    <div class="col-4">
      <div class="form-floating">
        <select class="form-select" id="periodSelect" aria-label="Select time period">
          <option value="year" selected>Year</option>
          <option value="month">Month</option>
        </select>
        <label for="periodSelect">Period Length</label>
      </div>
    </div>
  </div>

  <main class="row d-flex mt-3 text-center justify-content-center" id="trend-row">
    <h3 class="d-none" id="no-data">No data</h3>
    <div class="d-none spinner-border text-primary mt-5" id="loading" role="status" style="width: 4rem; height: 4rem;">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="chart-container w-100 mb-5" id="trend-chart-container">
      <canvas id="trendChart"></canvas>
    </div>
  </main>
</div>

<script>
var isChartDisplayed = false;
var trendChart;

/*
  Grabs Company ID, Trend, and Period Length and tries to make an AJAX request
  to grab the required temporal statistics from the database.
*/
function grabAllArgs() {
  let trend = $("#trendSelect").val();
  let period = $("#periodSelect").val();
  let company = $("#companySearch").val();

  if (trend != null &&
      period != null &&
      company != null) {
    return {"employerId": company, "trend": trend, "period": period};
  }

  return null;
}

function createGraph(data) {
  const ctx = document.getElementById('trendChart').getContext('2d');
  trendChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
      legend: {
        display: false
      },
      scales: {
          y: {
              beginAtZero: true,
              max: 5,
          }
      },
    }
  });

  return trendChart;
}

function displayTrendGraph() {
  let args = grabAllArgs();
  if (args === null) return;

  $.ajax({
    method: "GET",
    url: "./../resources/getTrendData.php",
    data: args,
    dataType: "json",
    beforeSend: function(xhr) {
      $("#no-data").addClass("d-none");
      $("#trend-chart-container").addClass("d-none");
      $("#loading").removeClass("d-none");

      $("#trendSelect").attr('disabled', true);
      $("#periodSelect").attr('disabled', true);
      $("button.form-select:first").removeClass('show');
      $("div.dropdown-menu:first").removeClass('show');
      $("button.form-select:first").attr('disabled', true);
    }
    }).done(function (data) {
      if (!data) {
        $("#trend-chart-container").addClass("d-none");
        if (isChartDisplayed) trendChart.destroy();
        isChartDisplayed = false;
        $("#loading").addClass("d-none");
        $("#no-data").removeClass("d-none");
      } else {
        $("#trend-chart-container").removeClass("d-none");
        $("#loading").addClass("d-none");
        if (isChartDisplayed) trendChart.destroy();
        isChartDisplayed = false;
        createGraph(data);
        isChartDisplayed = true;
      }

      $("#trendSelect").removeAttr('disabled');
      $("#periodSelect").removeAttr('disabled');
      $("button.form-select:first").removeAttr('disabled');
    });
}

$("#trendSelect").bind("change", function() {
  displayTrendGraph();
});

$("#periodSelect").bind("change", function() {
  displayTrendGraph();
});

$("#companySearch").bind("change", function() {
  displayTrendGraph();
});


// enabling dselect for selectable search box
dselect(document.querySelector('#companySearch'),{
search: true
});

$("input:text.form-control").first().on('input', function() {
  searchChange();
});

</script>