<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users <?= count($users) ?></h2>

<ul id="users-home">
  <?php foreach ($users as $user) : ?>
  <li>
    <?= $user->name; ?> | <a href="/user/<?= $user->id; ?>">detalhes</a>
  </li>
  <?php endforeach; ?>
</ul>

<?php $this->start('scripts') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.2/axios.min.js"
  integrity="sha512-bHeT+z+n8rh9CKrSrbyfbINxu7gsBmSHlDCb3gUF1BjmjDzKhoKspyB71k0CIRBSjE5IVQiMMVBgCWjF60qsvA=="
  crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
axios.defaults.header = {
  "Content-type": "application/json",
  HTTP_HTTP_X_REQUESTED_WITH: "XMLHttpRequest",
}
async function loadUsers() {
  try {
    const data = await axios.get('/users');
    console.log(data.data);
  } catch (error) {
    console.log(error);
  }
}
loadUsers();
</script>
<?php $this->stop() ?>