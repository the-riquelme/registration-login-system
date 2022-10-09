<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users <?= count($users) ?></h2>

<ul id="users-home">
  <?php foreach ($users as $user) : ?>
  <li>
    <?= $user->name; ?> | <a href="/user/<?= $user->id; ?>">detalhes</a>
  </li>
  <?php endforeach; ?>
</ul>