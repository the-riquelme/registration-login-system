<?php $this->layout('master', ['title' => $title]) ?>

<h2>Create</h2>

<?= getFlash('message'); ?>

<form action="/user/store" method="POST" class="create-form">
  <input type="text" name="name" placeholder="Seu nome" value="">
  <?= getFlash('name'); ?>
  <br>
  <input type="text" name="surname" placeholder="Seu sobrenome" value="">
  <?= getFlash('surname'); ?>
  <br>
  <input type="text" name="email" placeholder="Seu email" value="">
  <?= getFlash('email'); ?>
  <br>
  <input type="password" name="password" placeholder="Sua senha" value="">
  <?= getFlash('password'); ?>
  <br>
  <button type="submit">Create</button>
</form>