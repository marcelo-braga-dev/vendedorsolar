<?php
if (!function_exists('conectaTabela')) {
    function conectaTabela()
    {
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_TABLE = 'vendedorsolar.phennix';

        $mysql = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_TABLE);
        $mysql->set_charset('utf8');

        if ($mysql == FALSE) {
            echo "Erro na conexao";
            exit();
        }

        return $mysql;
    }
}
