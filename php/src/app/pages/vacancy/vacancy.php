<?php $id = $_GET['id']; ?>

<?php if(!ctype_digit($id)): ?>
<h2 class="placeholder">Вакансия не найдена</h2>
<?php else: ?>

<?php $vacancy = $getApplicantVacancy->execute($id) ?>

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
    <button id="reply-button" class="button button_theme_positive"
      disabled<?= $vacancy->isReplied; ?>>Откликнуться</button>
  </div>
</div>

<script>
$('#reply-button').on('click', function() {
  const id = <?= $id ?>;
  $.ajax({
    url: `/api/reply-vacancy.php?id=${id}`,
    method: 'get',
    success: () => {
      $(this).prop('disabled', true);
    },
  })
});
</script>

<?php endif ?>
<?php  endif ?>