<?php
  require_once(realpath(dirname(__file__)) . "./../config.php");
  require_once(realpath(dirname(__file__)) . "./../database.php");

  function renderTemplate($contentFile, $variables = array()) {
    extract($variables);

    $path = realpath(dirname(__file__));

    echo <<< HDR
    <!doctype html>
    <html lang="en">
    HDR;
    require_once($path . '/header.php');
    echo '<body class="d-flex flex-column min-vh-100">
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
  integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
  ></script>';
    require_once($path . '/nav.php');
    require_once($path . "/{$contentFile}");
    require_once($path . '/footer.php');
    echo <<< END
    </body>
    </html>
    END;
  }
?>