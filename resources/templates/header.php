<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    echo isset($title) ? "<title>$title</title>" : "<title>Open Review</title>";
    echo isset($meta_desc) ? "<meta name=\"description\" content=\"$meta_desc\">" : "<meta name=\"description\" content=\"Open Review is a safe and anonymous place to rate and review your employers and view ratings of other employers to find your best fit for a job.\">";
    echo isset($meta_keywords) ? "<meta name=\"keywords\" content=\"$meta_keywords\">" : "<meta name=\"keywords\" content=\"Review, Job, Employer, Rate, Anonymous, Ratings, Employee\">";
    echo isset($meta_author) ? "<meta name=\"author\" content=\"$meta_author\">" : "<meta name=\"author\" content=\"Jackie Jone\">";
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
  crossorigin="anonymous">
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"
  ></script>
  <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
  <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
  <script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css"/>
  <script src="js/script.js" defer></script>
  <link rel="stylesheet" href="css/style.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap"
    rel="stylesheet"
  />
  <!-- Star icon -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
  />

</head>
