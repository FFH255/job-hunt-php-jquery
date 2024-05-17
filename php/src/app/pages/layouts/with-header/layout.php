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
  <link rel="stylesheet" href="/app/pages/layouts/with-header/layout.css" />
  <link rel="stylesheet" href="<?php echo "/app/pages" . $pageName . $pageName . '.css';?>" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <title>Document</title>
</head>

<body>
  <?php 
  $applicantHeaderLinks = [
    ['link' => '/', 'title' => 'Главная'],
    ['link' => '/replies.php', 'title' => 'Отклики'],
  ];

  $employerHeaderLinks = [
    ['link' => '/', 'title' => 'Главная'],
    ['link' => '/replies.php', 'title' => 'Отклики'],
  ];

  $headerLinks = $authService->getAuth()->role  === Role::User->value ? $applicantHeaderLinks :  $employerHeaderLinks;

  $currentURL = $_SERVER['REQUEST_URI'];
?>

  <header class="header">
    <h3 class="header__sitename">Job Hunt</h3>
    <nav class="header__navigation">
      <?php
        if (isset($headerLinks) && is_array($headerLinks)) {
          foreach ($headerLinks as $item) {
              $isActive = ($currentURL == $item['link']) ? 'header__link_active' : '';

              echo "<a href=\"{$item['link']}\" class=\"header__link $isActive\">{$item['title']}</a>";
          }
        }
      ?>
    </nav>
    <div class="header__actions">
      <span id="logout-button" class="logout-button">Выйти</span>
    </div>
  </header>

  <main class="main">
    <?php
    include_once dirname(__FILE__) . '/../..' . $pageName . $pageName . '.php';
    ?>
  </main>

  <script>
  const logoutButton = $('#logout-button');
  console.log('script')

  function logout() {
    $.ajax({
      url: '/api/auth/logout.php',
      success: () => {
        window.location.replace('/login.php');
      },
    });
  }

  logoutButton.on('click', logout);
  </script>
</body>

</html>