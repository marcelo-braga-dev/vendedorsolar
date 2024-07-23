<?php

namespace App\src\Integracoes\Aldo;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class ManipulaZip
{
    private string $pathFile;
    private string $pathExtract;

    public function __construct()
    {
        if (!extension_loaded('zip')) exit('Extencao Zip nao encontrada');
        $this->pathFile = storage_path('integracao-aldo' . DIRECTORY_SEPARATOR . 'xml_aldo.zip');
        $this->pathExtract = storage_path('integracao-aldo');
    }

    public function extractZip($dadosArquivo): string
    {
        $this->armazenarZip($dadosArquivo);

        try {
            $zip = new ZipArchive();
            $zip->open($this->pathFile);
            $zip->extractTo($this->pathExtract);
            $zip->close();
        } catch (\ErrorException $e) {
            throw new \DomainException('Falha na leitura do arquivo.');
        }

        return $this->localizarXML($this->pathExtract);
    }

    private function armazenarZip($dadosArquivo)
    {
        if (file_exists($this->pathFile)) unlink($this->pathFile);
        file_put_contents($this->pathFile, $dadosArquivo);
    }

    private function localizarXML(string $dir)
    {
        $directory_iterator = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directory_iterator);

        foreach ($iterator as $file) {
            $diretorioAtual = dirname($file);
            $path = glob($diretorioAtual . '/*.xml', GLOB_BRACE);
            if (!empty($path)) return implode($path);
        }
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

        delTree($this->pathExtract, $this->pathExtract);
    }
}
