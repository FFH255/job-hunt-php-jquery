<div class="login-page">
  <div class="login-page__content">
    <form>
      <div>
        <label>Логин</label>
        <input id="login" name="login" />
      </div>

      <div>
        <label>Пароль</label>
        <input id="password" name="password" />
      </div>

      <button id="login-button">Войти</button>
    </form>
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
    url: '/api/login.php',
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