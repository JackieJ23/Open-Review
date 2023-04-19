<?php
  require_once(realpath(dirname(__file__)) . "./../resources/templates/template_render.php");

  renderTemplate("index_content.php", array("title" => "Open Review"));
?>