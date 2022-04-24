<?php

function &get_cart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    return $_SESSION['cart'];
}
