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
        <input id="password" name="password" class="input _border_main" required />
      </div>

      <button id="login-button" class="button button_theme_positive">Войти</button>
    </form>
    <a class="form-link" href="/register.php">Регистрация</a>
  </div>
</div>

<script>
const loginInput = $('#login');
const passwordInput = $('#password');
const loginButton = $('#login-button');

function login(e) {
  e.preventDefault()

  const login = loginInput.val();
  const password = loginInput.val();
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
      console.log('auth');
    },
  })
}

loginButton.on('click', login);
</script>