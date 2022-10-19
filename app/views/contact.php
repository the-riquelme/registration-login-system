<?php $this->layout('master', ['title' => $title]) ?>

<h2>Contato</h2>

<?= getFlash('contact_success', 'background-color:green;color:white'); ?>
<?= getFlash('contact_error', 'background-color:red;color:white'); ?>

<form method="POST" action="/contact">

  <?= getCsrf(); ?>

  <input type="text" name="name" placeholder="Seu nome" value="<?= getOld('name'); ?>">
  <?= getFlash('name'); ?><br>
  <input type="text" name="email" placeholder="Seu email" value="<?= getOld('email'); ?>">
  <?= getFlash('email'); ?><br>
  <input type="text" name="subject" placeholder="Assunto" value="<?= getOld('subject'); ?>">
  <?= getFlash('subject'); ?><br>

  <textarea placeholder="Mensagem" name="message"><?= getOld('subject'); ?></textarea>
  <?= getFlash('message'); ?> <br>

  <button type="submit">Enviar</button>

</form>