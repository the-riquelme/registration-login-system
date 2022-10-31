<?php

function getExtension(string $name)
{
    return pathinfo($name, PATHINFO_EXTENSION);
}

function isFileToUpload($fieldName)
{
    if (!isset($_FILES[$fieldName], $_FILES[$fieldName]['name']) || $_FILES[$fieldName]['name'] === '') {
        throw new Exception("O campo {$fieldName} não existe ou não foi escolhida uma imagem");
    }
}

function isImage($extension)
{
    $acceptedExtensions = ['jpeg', 'jpg', 'gif', 'png'];
    if (!in_array($extension, $acceptedExtensions)) {
        $extensions = implode(',', $acceptedExtensions);
        throw new Exception("O arquivo não é aceito, aceitamos somente {$extensions}");
    }
}

function getFunctionCreateFrom(string $extension)
{
    return match ($extension) {
        'png' => ['imagecreatefrompng', 'imagepng'],
        'jpg', 'jpeg' => ['imagecreatefromjpeg', 'imagejpeg'],
        'gif' => ['imagecreatefromgif', 'imagegif'],
    };
}

function upload(int $newWidth, int $newHeight, string $folder, string $type = 'resize')
{
    isFileToUpload('file');

    $extension = getExtension($_FILES['file']['name']);

    isImage($extension);

    [$width, $height] = getimagesize($_FILES['file']['tmp_name']);

    [$functionCrateFrom, $saveImage] = getFunctionCreateFrom($extension);

    $src = $functionCrateFrom($_FILES['file']['tmp_name']);
}