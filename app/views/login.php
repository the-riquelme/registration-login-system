<h2>Login</h2>

<?= getFlash('message'); ?>

<form action="/login" method="POST" id="box-login">
  <input type="email" name="email" placeholder="Seu email" value="rd15075@gmail.com">
  <input type="password" name="password" placeholder="Sua senha" value="Chaves122@">
  <button type="message">Login</button>
</form>