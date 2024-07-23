<?php

function cadastrarKits()
{
    $fornecedorTitan = 7;
    $fornecedorDicomp = 5;
    $mysql = conectaTabela();
    $dados = $mysql->query("SELECT * FROM `kits`
                                    WHERE `fornecedor` = $fornecedorTitan
                                    OR `fornecedor` = $fornecedorDicomp")
        ->fetch_all(MYSQLI_ASSOC);

    cadastrarKitImpKits($dados, $mysql);
}

function cadastrarKitImpKits($kits, $mysql)
{
    foreach ($kits as $dados) {

        $classKits = (new \App\Models\Kits())->newQuery();

        //if (!$classKits->where('modelo', $dados['modelo-kit'])->exists()) {

            $potenciaPainel = getPotenciaPainelImpKits($dados['linha'], $mysql);
            if (empty($potenciaPainel)) $potenciaPainel = 1500;

            try {
                $classKits->create([
                    'sku' => $dados['sku'],
                    'modelo' => $dados['modelo-kit'],
                    'potencia_kit' => $dados['potencia-kit'],
                    'marca_inversor' => $dados['inversor'],
                    'marca_painel' => $dados['painel'],
                    'potencia_inversor' => 1,
                    'potencia_painel' => $potenciaPainel,
                    'margem' => $dados['margem'],
                    'preco_fornecedor' => $dados['preco-kit-empresa'],
                    'fornecedor' => $dados['fornecedor'],
                    'tensao' => $dados['tensao'],
                    'estrutura' => $dados['estrutura'],
                    'produtos' => $dados['produtos'],
                    'status' => 0,
                    'status_fornecedor	' => 0
                ]);
            } catch (\Illuminate\Database\QueryException $exception) {
                echo '<br><br>ERRO INT 1<br><br>';
                print_pre($exception->getMessage());
            }
        //}
    }
}

function getPotenciaPainelImpKits($linha, $mysql)
{
    $cod = preg_replace('/[^a-z]/', '', $linha);
    try {
        $dados = ($mysql->query("SELECT * FROM `linha_painel` where `codigo` = '$cod'"))
            ->fetch_all(MYSQLI_ASSOC);
        return $dados[0]['potencia'];
    } catch (Error $exception) {
        print_pre($exception->getMessage());
    } catch (ErrorException $exception) {
        return 6666;
    }
}
