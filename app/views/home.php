<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users <?= $users->count  ?></h2>

<form method="GET" action="/">
  <input type="text" name="search" placeholder="Digite o nome que deseja buscar...">

  <button type="submit">Buscar</button>
</form>

<ul id="users-home">
  <?php foreach ($users->rows as $user) : ?>
  <li>
    <?= $user->name ?? ''; ?> | <a href="/user/<?= $user->id ?? ''; ?>">detalhes</a>
  </li>
  <?php endforeach; ?>
</ul>