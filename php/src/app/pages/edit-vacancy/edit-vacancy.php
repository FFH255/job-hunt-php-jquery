<?php 
$id = $_GET['id'];
$vacancy = $vacanciesRepository->getVacancy($id);
?>

<h1 class="form-title">Редактирование вакансии</h1>
<form class="form">
  <div class="form__item form__item_direction_col">
    <label>Заголовок:</label>
    <input name="title" type="text" class="input _border_main" required value="<?= $vacancy->title ?>" />
  </div>

  <div class="form__item form__item_direction_col">
    <label>Компания:</label>
    <input name="company" type="text" class="input _border_main" value="<?= $vacancy->company ?>" />
  </div>

  <div class="form__item form__item_direction_col">
    <label>Занятость:</label>
    <input name="employment" type="text" class="input _border_main" required value="<?= $vacancy->employment ?>" />
  </div>

  <div class="form__item form__item_direction_row">
    <div class="form__item form__item_direction_col">
      <label>Отып работы от:</label>
      <input name="experience_from" type="number" class="input _border_main" value="<?= $vacancy->experienceFrom ?>" />
    </div>

    <div class="form__item form__item_direction_col">
      <label>Опыт работы до:</label>
      <input name="experience_to" type="number" class="input _border_main" value="<?= $vacancy->experienceTo ?>" />
    </div>
  </div>

  <div class="form__item form__item_direction_col">
    <label>Город:</label>
    <input name="city" type="text" class="input _border_main" value="<?= $vacancy->city ?>" />
  </div>

  <div class="form__item form__item_direction_row">
    <div class="form__item form__item_direction_col">
      <label>Зарплата от:</label>
      <input name="salary_from" type="number" class="input _border_main" value="<?= $vacancy->salaryFrom ?>" />
    </div>

    <div class="form__item form__item_direction_col">
      <label>Зарплата до:</label>
      <input name="salary_to" type="number" class="input _border_main" value="<?= $vacancy->salaryTo ?>" />
    </div>
  </div>

  <div class="form__item form__item_direction_col">
    <label>Описание:</label>
    <textarea name="description" class="input _border_main" required><?= $vacancy->description ?></textarea>
  </div>

  <button class="button button_theme_positive" type="submit">Изменить</button>
</form>

<script>
$('.form').submit(function(event) {
  event.preventDefault();

  const formData = {};

  $(this).find('input, textarea').each(function() {
    const key = $(this).attr('name');
    formData[key] = $(this).val();
  });

  const id = <?= $id ?>;

  $.ajax({
    url: `/api/edit-vacancy.php?id=${id}`,
    method: 'post',
    data: formData,
    success: function(response) {
      window.location.replace(`/employer-vacancy.php?id=${id}`);
    },
  });
});
</script>