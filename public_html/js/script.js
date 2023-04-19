// Capitalize each word in a sentence
// Base code taken from https://stackoverflow.com/questions/32589197/how-can-i-capitalize-the-first-letter-of-each-word-in-a-string-using-javascript
function titleCase(str) {
  const strExceptions = ["to", "and", "a"];
  if (str === "ceo") return "CEO";

  var splitStr = str.toLowerCase().split(" ");
  for (var i = 0; i < splitStr.length; i++) {
    if (!strExceptions.includes(splitStr[i])) {
      splitStr[i] =
        splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }
  }

  return splitStr.join(" ");
}

// Creates a donut graph
function createDoughnutGraph(canvasId, stat, title) {
  const exceptions = [
    "recommend_to_friend_rating",
    "ceo_rating",
    "business_outlook_rating",
  ];

  let ctx = document.getElementById(canvasId).getContext("2d");

  var statLabel;
  if (exceptions.includes(canvasId)) {
    stat = stat * 100;
    negStat = 100 - stat;
    statLabel = stat.toFixed(2) + "%";
  } else {
    negStat = 5 - stat;
    statLabel = stat.toFixed(2) + "/5";
  }

  let data = {
    labels: ["Positive Rating", "Negative Rating"],
    datasets: [
      {
        data: [stat, negStat],
        backgroundColor: ["rgb(66,185,131)", "rgb(255, 99, 132)"],
        hoverOffset: 4,
      },
    ],
  };

  let options = {
    cutout: "55%",
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: [title, statLabel],
        align: "center",
        padding: 0,
        color: "rgb(0, 0, 0)",
      },
      legend: {
        display: false,
      },
    },
  };

  let chart = new Chart(ctx, {
    type: "doughnut",
    data: data,
    options: options,
  });

  return chart;
}

// Creates multiple donut graphs and returns them as an array
function createDoughnutGraphs(container, data) {
  const re = /(_rating)/; // Regex for removing "_rating from title heading"
  const charts = []; // Store charts here

  var keys = Object.keys(data);
  keys.splice(0, 4); // Remove

  let content = "";
  // Reset container contents
  document.getElementById(container).innerHTML = "";

  // Create containers, wrappers, canvas', and headings
  for (let key of keys) {
    content +=
      '<div class="col"><canvas id="' +
      key +
      '" class="statsDoughnutGraph"></canvas></div>';
  }

  document.getElementById(container).innerHTML = content;

  // Create and place donut graphs inside canvas'
  for (let key of keys) {
    data[key] = parseFloat(data[key]);
    let tag = titleCase(key.replace(re, "").replaceAll("_", " "));
    charts.push(createDoughnutGraph(key, data[key], tag));
  }

  return charts;
}

function fillCompanyData(divId, data, companyId) {
  document.getElementById(divId).innerHTML = `
  <div class="row">
    <div class="col">
      <div class="h1 text-dark">
        <a href="${
          data.company_url
        }" target="_blank" class="link-dark" id="companyName">${
    data.company_name
  }</a>
        <small class="text-muted">(${
          data.reviews_count ? data.reviews_count : 0
        } reviews)</small>
      </div>
    </div>
  </div>
  <div class="row justify-content-md-center align-middle">
    <div class="col col-md-auto align-middle">
      <div class="h4 align-middle">(${data.company_hq})</div>
    </div>
    <div class="col col-md-auto">
      <form action="./../public_html/review.php" method="POST">
        <input type="hidden" name="company_id" value="${companyId}">
        <input type="hidden" name="company_name" value="${data.company_name}">
        <button type="submit" class="btn btn-primary mb-3">Add a review</button>
      </form>
    </div>
  <div>`;
}

function searchChange() {
  $.post(
    "./../resources/searchCompanyNames.php",
    { searchTerm: $("input:text.form-control").val() },
    function (data) {
      // Change options in select field
      var $el = $("#companySearch");
      $el.empty(); // remove old options
      $.each(data, function (key, comp) {
        $el.append(
          $("<option></option>")
            .attr("value", comp.employer_id)
            .text(comp.company_name)
        );
      });

      // Change options in custom select field
      $options = $("div.dselect-items");
      $options.empty(); // remove old options
      $.each(data, function (key, comp) {
        $options.append(
          $("<button></button>")
            .attr("class", "dropdown-item")
            .attr("data-dselect-value", comp.employer_id)
            .attr("type", "button")
            .attr(
              "onclick",
              "dselectUpdate(this, 'dselect-wrapper', 'form-select')"
            )
            .text(comp.company_name)
        );
      });
    },
    "json"
  );
}
