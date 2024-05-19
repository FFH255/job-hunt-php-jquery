<?php $id = $_GET['id']; ?>

<?php if(!ctype_digit($id)): ?>
<h2 class="placeholder">Вакансия не найдена</h2>
<?php else: ?>

<?php $vacancy = $vacanciesRepository->getVacancy(($id)); ?>

<?php if ($vacancy === null): ?>
<h2 class="placeholder">Вакансия не найдена</h2>
<?php else: ?>

<div class='item'>
  <h2 class='item__title'><?= $vacancy->title ?></h2>
  <span><?= $vacancy->company ?></span>
  <span><?= $vacancy->city ?></span>
  <span><?= $vacancy->employment ?></span>
  <span>от <?= $vacancy->experienceFrom ?> до <?= $vacancy->experienceTo ?></span>
  <span>от <?= $vacancy->salaryFrom ?> до <?= $vacancy->salaryTo ?></span>
  <span><?= $vacancy->description ?></span>
  <div class='item__buttons'>
    <button class="button button_theme_positive">Откликнуться</button>
  </div>
</div>

<?php endif ?>
<?php  endif ?>