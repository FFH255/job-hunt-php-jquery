<?php
$vacancies = $getEmployerVacancies->execute();
?>

<?php if(count($vacancies) === 0): ?>
<h2 class="placeholder">У вас нет созданных вакансий</h2>
<?php else: ?>
<div class='list'>
  <?php foreach ($vacancies as $vacancy): ?>
  <div data-id="<?= $vacancy->id ?>" class='vacancy item item_hoverable _border_sub'>
    <h3 class='item__title'><?= $vacancy->title ?></h3>
  </div>
  <?php endforeach; ?>
</div>

<script>
$('.vacancy').on('click', function() {
  const vacancyId = $(this).data('id');
  window.location.href = '/employer-vacancy.php?id=' + vacancyId;
});
</script>
<?php endif ?>