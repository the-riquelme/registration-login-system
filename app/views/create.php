<h2>Create</h2>

<?= getFlash('message'); ?>

<form action="/user/store" method="POST" class="create-form">
  <input type="text" name="name" placeholder="Seu nome" value="">
  <?= getFlash('name'); ?>
  <input type="text" name="surname" placeholder="Seu sobrenome" value="">
  <?= getFlash('surname'); ?>
  <input type="email" name="email" placeholder="Seu email" value="">
  <?= getFlash('email'); ?>
  <input type="password" name="password" placeholder="Sua senha" value="">
  <?= getFlash('password'); ?>
  <button type="submit">Create</button>
</form>