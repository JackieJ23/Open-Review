<?php
  require_once(realpath(dirname(__file__)) . "./../resources/templates/template_render.php");

  renderTemplate("overview_content.php", array("title" => "Overview",
                                               "meta_desc" => "View overall aggregate and average ratings for employers",
                                               "meta_keywords" => "Average, Ratings, Employers, View, Aggregate, Rating"));
?>