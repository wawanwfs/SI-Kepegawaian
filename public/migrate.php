<?php

// Load the framework bootstrap file
require_once __DIR__ . '/../app/Config/Paths.php';
require_once FCPATH . 'index.php';

// Run the migration
$migrate = \Config\Services::migrations();

try {
    $migrate->latest();
    echo 'Migrations run successfully!';
} catch (\Throwable $e) {
    echo $e->getMessage();
}
