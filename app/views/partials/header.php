<ul id="menu_list">
  <li><a href="/">Home</a></li>
  <?php if (!logged()): ?>
  <li><a href="/login">Login</a></li>
  <?php else: ?>
  <li><a href="/user/create">Create</a></li>
  <?php endif; ?>
</ul>

<div id="status_login">
  Bem vindo,
  <?php if (logged()): ?>
  <?= getSessionUser()->name ?>| <a href="/logout">Logout</a>
  <?php else: ?>
  visitante
  <?php endif; ?>
</div>