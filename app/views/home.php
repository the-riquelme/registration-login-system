<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users <?= count($users) ?></h2>

<div x-data="users()" x-init="loadUsers()">
  <ul>
    <template x-for="user in data">
      <li x-text="user.name"></li>
    </template>
  </ul>
</div>

<ul id="users-home">
  <?php foreach ($users as $user) : ?>
  <li>
    <?= $user->name; ?> | <a href="/user/<?= $user->id; ?>">detalhes</a>
  </li>
  <?php endforeach; ?>
</ul>