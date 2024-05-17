<div class="register-page">
  <div class="register-page__content">
    <h1 class="form-title">Регистрация</h1>
    <form class="form">
      <div class="form__item form__item_direction_col">
        <label>Логин</label>
        <input id="login" name="login" class="input _border_main" required />
      </div>

      <div class="form__item form__item_direction_col">
        <label>Пароль</label>
        <input id="password" name="password" class="input _border_main" required />
      </div>

      <div class="form__item form__item_direction_col">
        <label>Роль</label>
        <input type="number" name="role" id="role" class="input _border_main" required />
      </div>
      <button class="button button_theme_positive" id="register-button">Регистрация</button>
    </form>
    <span id="error-message" class="form-error-message"></span>
    <a href="/login.php" class="form-link">Вход</a>
  </div>
</div>

<script>
const loginInput = $('#login');
const passwordInput = $('#password');
const roleInput = $('#role');
const registerButton = $('#register-button');
const errorMessage = $('#error-message');

function register(e) {
  e.preventDefault()

  const login = loginInput.val();
  const password = passwordInput.val();
  const role = roleInput.val();
  if (!login || !password || role === undefined) {
    return;
  }
  $.ajax({
    url: '/api/auth/register.php',
    method: 'post',
    data: {
      login: login,
      password: password,
      role: role,
    },
    success: () => {
      errorMessage.text('');
      window.location.replace('/');
    },
    error: () => {
      errorMessage.text('Пользователь уже существует');
    }
  })
}

registerButton.on('click', register);
</script>