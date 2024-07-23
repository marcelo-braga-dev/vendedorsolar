<?php
if (!function_exists('conectaTabela')) {
    function conectaTabela()
    {
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_TABLE = 'phennix_antigo';

        $mysql = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_TABLE);
        $mysql->set_charset('utf8');

        return $mysql;
    }
}
