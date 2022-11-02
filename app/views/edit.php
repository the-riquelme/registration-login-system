<?php $this->layout('master', ['title' => $title]); ?>

<form action="/user/profile/update" method="POST"></form>

<hr>

<?= getFlash('upload_error'); ?>
<?= getFlash('upload_success', 'color:green'); ?>
<form action="/user/image/update" method="POST" enctype="multipart/form-data">

  <input type="file" name="file" accept="image/png, image/jpeg, image/gif">

  <button type="submit">Alterar foto</button>

</form>