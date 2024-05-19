<h1 class="form-title">Создание вакансии</h1>
<form class="form">
  <div class="form__item form__item_direction_col">
    <label>Заголовок:</label>
    <input name="title" type="text" class="input _border_main" required />
  </div>

  <div class="form__item form__item_direction_col">
    <label>Компания:</label>
    <input name="company" type="text" class="input _border_main" />
  </div>

  <div class="form__item form__item_direction_col">
    <label>Занятость:</label>
    <input name="employment" type="text" class="input _border_main" required />
  </div>

  <div class="form__item form__item_direction_row">
    <div class="form__item form__item_direction_col">
      <label>Отып работы от:</label>
      <input name="experience_from" type="number" class="input _border_main" />
    </div>

    <div class="form__item form__item_direction_col">
      <label>Опыт работы до:</label>
      <input name="experience_to" type="number" class="input _border_main" />
    </div>
  </div>

  <div class="form__item form__item_direction_col">
    <label>Город:</label>
    <input name="city" type="text" class="input _border_main" />
  </div>

  <div class="form__item form__item_direction_row">
    <div class="form__item form__item_direction_col">
      <label>Зарплата от:</label>
      <input name="salary_from" type="number" class="input _border_main" />
    </div>

    <div class="form__item form__item_direction_col">
      <label>Зарплата до:</label>
      <input name="salary_to" type="number" class="input _border_main" />
    </div>
  </div>

  <div class="form__item form__item_direction_col">
    <label>Описание:</label>
    <textarea name="description" class="input _border_main" required></textarea>
  </div>

  <button id="create-vacancy-button" class="button button_theme_positive" type="submit">Создать</button>
</form>

<script>
$('.form').submit(function(event) {

  event.preventDefault();

  const formData = {};

  $(this).find('input, textarea').each(function() {
    const key = $(this).attr('name');
    formData[key] = $(this).val();
  });

  $.ajax({
    url: `/api/create-vacancy.php`,
    method: 'POST',
    data: formData,
    success: (e) => {
      window.location = '/employer-vacancies.php';
    },
  })
});
</script>