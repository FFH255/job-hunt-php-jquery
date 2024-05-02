<div class="login-page">
  <div class="login-page__content">
    <form>
      <div>
        <label>Логин</label>
        <input />
      </div>

      <div>
        <label>Пароль</label>
        <input />
      </div>

      <button>Войти</button>
    </form>
  </div>
</div>

<script>
$.ajax({
  url: '/api/login.php',
  method: 'post',
  data: {
    login: 'login',
    password: 'password',
  },
  success: (res) => {
    console.log(res);
  }
})
</script>