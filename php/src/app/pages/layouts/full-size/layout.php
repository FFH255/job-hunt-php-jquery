<?php 
$pageName = str_replace('.php', '', $_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/app/styles/main.css" />
  <link rel="stylesheet" href="/app/styles/button.css" />
  <link rel="stylesheet" href="/app/styles/form.css" />
  <link rel="stylesheet" href="/app/styles/list.css" />
  <link rel="stylesheet" href="/app/pages/layouts/full-size/layout.css" />
  <link rel="stylesheet" href="<?php echo "/app/pages" . $pageName . $pageName . '.css';?>" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <title>Job Hunt</title>
</head>

<body>
  <main class="main">
    <?php
    include_once dirname(__FILE__) . '/../..' . $pageName . $pageName . '.php';
    ?>
  </main>
</body>

</html>