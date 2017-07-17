<?php

$aWhitelist = array(
    'json_form',
    'json_blub',
);

if (in_array($_GET['what'], $aWhitelist)) {
    $aJson = array(
        'content' => file_get_contents($_GET['what'] . '.html'),
        'footer' => file_get_contents($_GET['what'] . '_footer.html'),
        'brand' => "Hurra!",
    );

    echo json_encode($aJson);
}

