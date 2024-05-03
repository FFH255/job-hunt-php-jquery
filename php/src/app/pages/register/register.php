<div class="register-page">
  <div class="register-page__content">
    <form>
      <div>
        <label>Логин</label>
        <input id="login" name="login" />
      </div>

      <div>
        <label>Пароль</label>
        <input id="password" name="password" />
      </div>

      <div>
        <label>Роль</label>
        <input type="number" name="role" id="role" />
      </div>

      <button id="login-button">Войти</button>
    </form>
  </div>
</div>

<script>
const loginInput = $('#login');
const passwordInput = $('#password');
const roleInput = $('#role');
const registerButton = $('#login-button');

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
      console.log('REGISTRATION SUCCESS!!!');
    },
  })
}

registerButton.on('click', register);
</script>