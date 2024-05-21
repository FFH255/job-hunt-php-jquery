<?php 
$vacancies = $getApplicantVacancies->execute();
if(count($vacancies) === 0): 
?>

<h2 class="placeholder">Нет доступных вакансий</h2>

<?php else: ?>

<div class="wrapper">
  <div class="filter">
    <span>Занятость:</span>
    <form id="employment-form">
      <input id="employment-filter" class="input _border_main" />
    </form>
  </div>
  <div class='list' id="vacancy-list">
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
        <button data-id="<?= $vacancy->id ?>" class='replay-button button button_theme_positive'
          disabled<?= $vacancy->isReplied ?>>
          Откликнуться
        </button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
$('.vacancy').on('click', function() {
  const vacancyId = $(this).data('id');
  window.location.href = '/vacancy.php?id=' + vacancyId;
});

$('.replay-button').on('click', function(e) {
  e.stopPropagation();

  const vacancyId = $(this).data('id');

  $.ajax({
    url: `/api/reply-vacancy.php?id=${vacancyId}`,
    method: 'get',
    success: () => {
      $(this).prop('disabled', true);
    },
  })
});

$('#employment-form').on('submit', function(e) {
  e.preventDefault();
  const employment = $('#employment-filter').val();

  $.ajax({
    url: `/api/get-vacancies.php?employment=${employment}`,
    method: 'get',
    success: function(res) {
      const vacancies = JSON.parse(res);
      $('#vacancy-list').empty();
      if (vacancies.length === 0) {
        $('#vacancy-list').append('<h2 class="placeholder">Нет доступных вакансий</h2>');
      } else {
        vacancies.forEach(function(vacancy) {
          const vacancyHtml = `
          <div data-id="${vacancy.id}" class='vacancy item item_hoverable _border_sub'>
            <h3 class='item__title'>${vacancy.title}</h3>
            <span>${vacancy.company}</span>
            <span>${vacancy.city}</span>
            <span>${vacancy.employment}</span>
            <span>Опыт работы: ${vacancy.experienceFrom ? 'от ' + vacancy.experienceFrom : ''} ${vacancy.experienceTo ? 'до ' + vacancy.experienceTo : 'не указано'}</span>
            <span>Оклад: ${vacancy.salaryFrom ? 'от ' + vacancy.salaryFrom : ''} ${vacancy.salaryTo ? 'до ' + vacancy.salaryTo : 'не указано'}</span>
            <div class='item__buttons'>
              <button data-id="${vacancy.id}" class='replay-button button button_theme_positive' ${vacancy.isReplied ? 'disabled' : ''}>Откликнуться</button>
            </div>
          </div>
          `;
          $('#vacancy-list').append(vacancyHtml);
        });
      }
    },
  })
});
</script>

<?php endif;?>