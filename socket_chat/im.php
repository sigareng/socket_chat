<?php
function randomColour() {
    // Found here https://css-tricks.com/snippets/php/random-hex-color/
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    return $color;
}

$img = array('https://avatarbox.net/avatars/img10/porky_pig_concerned_avatar_picture_18020.jpg','https://avatarbox.net/avatars/img37/dancing_kid_avatar_picture_57685.gif','https://avatarbox.net/avatars/img16/bear_hugger_avatar_picture_60544.jpg','https://avatarbox.net/avatars/img16/bald_bull_avatar_picture_49960.jpg','https://gif-avatars.com/img/45x45/sayori-dancing.gif','https://gif-avatars.com/img/45x45/horrid.gif');
 ?>
