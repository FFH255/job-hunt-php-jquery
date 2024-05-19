<?php
$vacancies = $vacanciesRepository->getVacancies();
?>

<div class='list'>
  <?php foreach ($vacancies as $vacancy): ?>
  <div data-id="<?= $vacancy->id ?>" class='vacancy item item_hoverable _border_sub'>
    <h3 class='item__title'><?= $vacancy->title ?></h3>
    <span><?= $vacancy->company ?></span>
    <span><?= $vacancy->city ?></span>
    <span><?= $vacancy->employment ?></span>
    <span>Опыт работы:
      <?php if ($vacancy->experienceFrom): ?>
      от <?= $vacancy->experienceFrom ?>
      <?php endif; ?>
      <?php if ($vacancy->experienceTo): ?>
      до <?= $vacancy->experienceTo ?>
      <?php endif; ?>
      <?php if (!$vacancy->experienceFrom && !$vacancy->experienceTo): ?>
      не указано
      <?php endif; ?>
    </span>
    <span>Оклад:
      <?php if ($vacancy->salaryFrom): ?>
      от <?= $vacancy->salaryFrom ?>
      <?php endif; ?>
      <?php if ($vacancy->salaryTo): ?>
      до <?= $vacancy->salaryTo ?>
      <?php endif; ?>
      <?php if (!$vacancy->salaryFrom && !$vacancy->salaryTo): ?>
      не указано
      <?php endif; ?>
    </span>
    <div class='item__buttons'>
      <button class='button button_theme_positive'>Откликнуться</button>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<script>
$(document).ready(function() {
  $('.vacancy').on('click', function() {
    var vacancyId = $(this).data('id');
    window.location.href = '/vacancy.php?id=' + vacancyId;
  });
});
</script>