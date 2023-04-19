<div class="container text-center">
  <div class="row mb-3">
    <h1 class="display-1">
      <strong>Review your employers</strong>
    </h1>
    <h1 class="display-5"><small small class="text-muted"><strong>Spill the tea 🍵</strong></small></h1>
  </div>

  <div class="row mb-3">
    <h1 class="display-1"><?php echo getTotalReviews()?> Total Reviews</h1>
  </div>

  <main class="container text-center mb-5">
    <?php
        $cardContent = getTopSixReviewsCount();
        echo '<div class="row row-cols-3 g-3 justify-content-center d-flex">';
          for ($i = 0; $i < count($cardContent); $i++) {
            $currCardInfo = $cardContent[$i];
            $domain = substr($currCardInfo["company_url"], 7);
            $overall = round($currCardInfo["overall_rating"], 1);
            echo '<div class="col justify-content-center d-flex">';
            echo "
              <div class=\"card\" style=\"width: 18rem;\">
                <div class=\"card-header\">
                  <img src=\"https://www.google.com/s2/favicons?domain=${domain}&sz=256\"class=\"card-img-top\" alt=\"{$currCardInfo["company_name"]} company icon\" id=\"card-img-{$i}\">
                </div>
                <div class=\"card-body\">
                  <h5 class=\"card-title\">{$currCardInfo["company_name"]}</h5>
                  <p class=\"card-text d-flex justify-content-center\">{$currCardInfo["reviews_count"]} Reviews {$overall}<span class=\"material-symbols-outlined\">star</span></p>
                </div>
              </div>";
            echo '</div>';
          }
        echo '</div>';
      ?>
  </main>
</div>
