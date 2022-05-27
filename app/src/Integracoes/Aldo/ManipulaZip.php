<?php

namespace App\src\Integracoes\Aldo;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class ManipulaZip
{
    private string $path = __DIR__ . '/RepositorioZip/';
    private string $nameFile = 'xml_aldo.zip';

    public function __construct()
    {
        if (!extension_loaded('zip')) exit('Extencao Zip nao encontrada');
    }

    public function extractZip($dadosArquivo): string
    {
        $this->armazenarZip($dadosArquivo);

        $zip = new ZipArchive();
        $zip->open($this->path . $this->nameFile);

        $zip->extractTo($this->path . 'extract');
        $zip->close();

        return $this->localizarXML($this->path . 'extract');
    }

    private function armazenarZip($dadosArquivo)
    {
        file_put_contents($this->path . $this->nameFile, $dadosArquivo);
    }

    private function localizarXML(string $dir): string
    {
        $arquivo = '';

        $directory_iterator = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directory_iterator);

        foreach ($iterator as $file) {
            $diretorioAtual = dirname($file);
            $path = glob($diretorioAtual . '/*.xml', GLOB_BRACE);
            if (!empty($path)) $arquivo = implode($path);
        }

        return $arquivo;
    }

    public function removerXML()
    {
        function delTree($original, $dir)
        {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? delTree($original, "$dir/$file") : unlink("$dir/$file");
            }
            if ($dir != $original) rmdir($dir);
        }

        //delTree($this->path, $this->path);
    }
}
