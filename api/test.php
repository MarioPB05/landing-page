<?php
include_once 'database.php';

$database = new Database('database/ecosun_power.db');

$database->query('CREATE TABLE IF NOT EXISTS user (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email VARCHAR NOT NULL,
        username VARCHAR NOT NULL UNIQUE,
        password VARCHAR NOT NULL
    )');

$database->query('CREATE TABLE IF NOT EXISTS plan (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR NOT NULL,
        price DOUBLE NOT NULL
    )');

$database->query('CREATE TABLE IF NOT EXISTS client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR NOT NULL,
        surname VARCHAR NOT NULL,
        dni VARCHAR NOT NULL,
        address VARCHAR NOT NULL,
        user_id INTEGER NOT NULL,
        plan_id INTEGER NOT NULL,
        FOREIGN KEY (user_id) REFERENCES user(id),
        FOREIGN KEY (plan_id) REFERENCES plan(id)
    )');


/*$database->insert("plan", [
    'name' => 'Tarifa Solar Básica',
    'price' => 29.99
]);

$database->insert("plan", [
    'name' => 'Tarifa Eólica Plus',
    'price' => 39.99
]);

$database->insert("plan", [
    'name' => 'Tarifa EcoTotal Green',
    'price' => 49.99
]);*/