<?php
include "../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


function encryptJWT($payload, $algorithm = 'HS256') {
    $jwt = JWT::encode($payload, "sadaka@private.key", $algorithm);
    return $jwt;
}

function decryptJWT($jwt, $algorithm = 'HS256') {
    $decoded = JWT::decode($jwt, new Key("sadaka@private.key", $algorithm));
    return $decoded;
}

?>
