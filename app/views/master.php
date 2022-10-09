<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
  <title><?=$this->e($title)?></title>
</head>

<body>

  <div id="header">
    <?=$this->insert('partials/header')?>
  </div>

  <div class="container">
    <?=$this->section('content')?>
  </div>

</body>

</html>