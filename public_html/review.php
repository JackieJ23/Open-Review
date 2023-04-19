<?php
  require_once(realpath(dirname(__file__)) . "./../resources/templates/template_render.php");

  renderTemplate("review_content.php", array("title" => "Review Employers",
                                             "meta_desc" => "Read and write reviews for your employers",
                                             "meta_keywords" => "Reviews, Employers, Write, Rate"));
?>