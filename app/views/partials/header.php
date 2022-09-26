<ul id="menu_list">
  <li><a href="/">Home</a></li>
  <li><a href="/login">Login</a></li>
  <li><a href="/user/create">Create</a></li>
</ul>

<div id="status_login">
  Bem vindo,
  <?php if (logged()): ?>
  <?= getSessionUser()->name ?>| <a href="/logout">Logout</a>
  <?php else: ?>
  visitante
  <?php endif; ?>
</div>