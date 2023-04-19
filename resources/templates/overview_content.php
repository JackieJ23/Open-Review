<div class="container mt-3 text-center">
  <div class="row text-center g-0">
    <h1 class="display-1">Company Overview</h1>
  </div>

  <div class="row mt-2">
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
</div>
<main class="container text-center mt-4">
  <div class="row">
    <div id="companyInfo" class="container text-center" style="display: none"></div>
  </div>
  <div id="statisticsContainer" class="row d-flex justify-content-center mb-5">
    <div id="companyStatistics" class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-5 row-cols-xxl-5 g-3 py-0 my-0 d-flex justify-content-center" style="display: none"></div>
  </div>
</main>

<script>
// enabling dselect for selectable search box
dselect(document.querySelector('#companySearch'),{
  search: true
});

$(document).ready(function(e) {
  $("#companySearch").on('change', function() {
    selectChange();
  });

  $("input:text.form-control").on('input', function() {
    searchChange();
  });
});

function selectChange() {
  $.post(
    "./../resources/getCompanyStats.php",
    {companyId: $("#companySearch").val(),},
    function (data) {
        document.getElementById('companyStatistics').style.display = 'flex';
        document.getElementById('companyInfo').style.display = 'block';

        fillCompanyData("companyInfo", data, $("#companySearch").val());

        if (Object.keys(data).length === 14) {
          $("h3.noStatsHeader").remove();
          createDoughnutGraphs("companyStatistics", data);
        } else {
          $("h3.noStatsHeader").remove();
          $('#statisticsContainer')
          .append("<h3 class=\"noStatsHeader\">No review statistics found 😔</h3>");
          $("#companyStatistics").empty();
        }

        $(document).attr("title", `${data.company_name} Overview`);
    },
    "json"
  )
};
</script>