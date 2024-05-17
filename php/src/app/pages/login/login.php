<div class="login-page">
  <div class="login-page__content">
    <h1 class="form-title">Вход</h1>
    <form class="form">
      <div class="form__item form__item_direction_col">
        <label>Логин</label>
        <input id="login" name="login" class="input _border_main" required />
      </div>

      <div class="form__item form__item_direction_col">
        <label>Пароль</label>
        <input id="password" name="password" type="password" class="input _border_main" required />
      </div>

      <button id="login-button" class="button button_theme_positive" type="button">Войти</button>
    </form>
    <span id="error-message" class="form-error-message"></span>
    <a class="form-link" href="/register.php">Регистрация</a>
  </div>
</div>

<script>
const loginInput = $('#login');
const passwordInput = $('#password');
const loginButton = $('#login-button');
const errorMessage = $('#error-message');

function login(e) {
  const login = loginInput.val();
  const password = passwordInput.val();
  if (!login || !password) {
    return;
  }
  $.ajax({
    url: '/api/auth/login.php',
    method: 'post',
    data: {
      login: login,
      password: password,
    },
    success: () => {
      errorMessage.text('');
      window.location.replace('/');
    },
    error: () => {
      errorMessage.text('Пользователь не найден');
    }
  })
}

loginButton.on('click', login);
</script>