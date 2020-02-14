<?php

function badgeUpload()
{
    if (! isset($_POST['badgeUpload'])) {
        return;
    }

    $code = trim(filter_var($_POST['code'], FILTER_SANITIZE_STRING));
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $desc = trim(filter_var($_POST['desc'], FILTER_SANITIZE_STRING));

    if (empty($code) || empty($name) || empty($desc) || ! is_file($_FILES['badge']['tmp_name'])) {
        return Html::error('Du musst alle Felder ausfüllen!');
    }

    if (strlen($code) < 3 || strlen($code) > 32) {
        return Html::error('Der Code muss zwischen 3 und 32 Zeichen lang sein.');
    }

    if (ctype_alnum($code) === false) {
        return Html::error('Der Code darf nur Buchstaben und Zahlen enthalten.');
    }

    if (strlen($name) < 3 || strlen($name) > 32) {
        return Html::error('Der Name muss zwischen 3 und 32 Zeichen lang sein.');
    }

    if (strlen($desc) < 3 || strlen($desc) > 128) {
        return Html::error('Die Beschreibung muss zwischen 3 und 128 Zeichen lang sein.');
    }

    $badge = $_FILES['badge'];

    if ($badge['type'] !== 'image/gif') {
        return Html::error('Das Badge muss eine GIF Datei sein.');
    }

    $size = getimagesize($badge['tmp_name']);

    if ($size[0] !== 40 || $size[1] !== 40) {
        return Html::error('Das Badge muss 40x40 Pixel gross sein.');
    }

    $code   = strtoupper($code);
    $target = "{$_SERVER['DOCUMENT_ROOT']}/swfs/c_images/album1584/{$code}.gif";

    if (is_file($target)) {
        return Html::error('Dieses Badge existiert bereits. Vewende einen anderen Code.');
    }

    $move = move_uploaded_file($badge['tmp_name'], $target);

    if ($move === false) {
        return Html::error('Etwas ist schief gelaufen!');
    }

    $text = "badge_name_{$code}={$name}\nbadge_desc_{$code}={$desc}\n";
    file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/swfs/gamedata/override/external_flash_override_texts.txt", $text, FILE_APPEND);

    global $dbh;

    $query = $dbh->prepare('INSERT INTO badge_upload (`user_id`, `code`, `name`, `desc`) VALUES (?, ?, ?, ?)');
    $query->execute([ User::userData('id'), $code, $name, $desc ]);

    return Html::errorSucces('Dein Badge wurde erfolgreich hochgeladen!');
}
