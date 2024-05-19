<?php
$replies = $getApplicantReplies->execute();

echo "
  <div>
";

if (count($replies) === 0) {
  echo "<h2 class='placeholder'>Вы еще ни разу не откликнулись</h2>";
} else {
  echo "<div class='list'>";
  foreach ($replies as $reply) {
    echo "
    <div class='item _border_sub'>
      <h3 class='item__title'>$reply->title</h3>
      <span>$reply->company</span>
      <span>$reply->date</span>
      <div class='item__buttons'>
        <a class='button button_theme_danger'>Удалить</a>
      </div>
    </div>
  ";
  }
  echo "</div>";
}

echo "
  </div>
";