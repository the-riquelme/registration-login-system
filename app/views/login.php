<?php $this->layout('master', ['title' => $title]) ?>

<h2>Login</h2>

<?= getFlash('message'); ?>

<?php if (!logged()): ?>

<form action="/login" method="POST" id="box-login">
  <input type="email" name="email" placeholder="Seu email" value="">
  <input type="password" name="password" placeholder="Sua senha" value="">
  <button type="message">Login</button>
</form>

<?php else: ?>

<h2>Já está Logado</h2>

<?php endif; ?>
