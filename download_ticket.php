<?php
require_once 'includes/init.php';

requireLogin();

$fichier = $_GET['file'] ?? '';

if ($fichier == '' || !file_exists('tickets/' . $fichier)) {
    header('Location: destinations.php');
    exit;
}

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $fichier . '"');
readfile('tickets/' . $fichier);
exit;
