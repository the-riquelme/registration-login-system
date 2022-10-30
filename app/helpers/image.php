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