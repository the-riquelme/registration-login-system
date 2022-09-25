<?php

function connectDatabase() {
  return new PDO(
    "mysql:host=127.0.0.1;dbname=site;charset=utf8", 
    'root',
    'Chaves122@',
     [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
     ]
  );
}