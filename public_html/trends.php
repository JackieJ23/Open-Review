<?php
  require_once(realpath(dirname(__file__)) . "./../resources/templates/template_render.php");

  renderTemplate("trends_content.php", array("title" => "Review Trends",
                                             "meta_desc" => "Trends of employers based on reviews",
                                             "meta_keywords" => "Reviews, Employers, Trends, Statistics, Graphs, Time, Business, Outlook, Career, Opportunities, CEO, Compensation, Benefits, Culture, Values, Diversity, Inclusion, Overall Rating, Work life, Balance, Leadership"));
?>