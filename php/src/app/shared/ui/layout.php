<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/app/shared/ui/layout.css" />
  <link rel="stylesheet" href="<?php echo "/app/pages" . str_replace('.php', '.css', $_SERVER['PHP_SELF']); ?>" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <title>Document</title>
</head>

<body>
  <header></header>
  <main class="main">
    <?php
    include_once dirname(__FILE__) . '/../../pages' . $_SERVER['PHP_SELF']; 
    ?>
  </main>
</body>

</html>