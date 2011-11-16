<?php

$page = array_key_exists ( 'p', $_GET ) ? $_GET['p'] : false;

if ( $page === false ) {
  $data = (object) array(
  'title' => 'Snavi test',
  'content' => 'unknown species thingy'
  );
} else {
  $data = (object) array(
    'title' => "Superman has a $page",
    'content' => "extraordinary $page",
  );
}

$format = array_key_exists ( 'format', $_GET ) ? $_GET['format'] : false;
if ( $format == 'json' ) {
  header('Content-type: application/json');
  echo json_encode($data);
  exit(0);
}

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?php echo $data->title; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <script src="snavi.js"></script>
    <script src="config.js"></script>
    <style>
      .sidebar nav a {
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="sidebar">
        <nav>
        <a href="?p=mouse">Go to mouse page</a>
        <a href="?p=dog">Go to dog page</a>
        <a href="?p=cat">Go to cat page</a>
      </div>
      <div class="content">
        Hello there you <?php echo $data->content; ?>!
      </div>
    </div>
  </body>
</html>
