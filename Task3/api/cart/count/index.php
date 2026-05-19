<?php

require_once __DIR__ . "/../../../Controller/cartHelpers.php";

sendJson([
    'success' => true,
    'cart_count' => getCartCount()
]);

?>
