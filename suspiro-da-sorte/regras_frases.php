<?php
$fraseAtual = "";

require 'frases.php';

// arquivo TXT que armazenará as frases usadas
$arquivo_txt = 'frases_usadas.txt';

// função para carregar frases usadas do arquivo TXT
function carregarFrasesUsadas($arquivo_txt) {
    if (!file_exists($arquivo_txt)) {
        return [];
    }
    $frases_usadas = file($arquivo_txt, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $frases_usadas;
}

// função para salvar a frase usada no arquivo TXT
function salvarFraseUsada($frase, $arquivo_txt) {
    $arquivo = fopen($arquivo_txt, 'a');
    fwrite($arquivo, $frase . PHP_EOL);
    fclose($arquivo);
}

// função para reiniciar o arquivo de frases usadas
function reiniciarArquivoFrasesUsadas($arquivo_txt) {
    $arquivo = fopen($arquivo_txt, 'w');
    fclose($arquivo);
}

// carrega frases usadas
$frases_usadas = carregarFrasesUsadas($arquivo_txt);

// obtem frases disponíveis
$frases_disponiveis = array_diff($frases, $frases_usadas);

// verifica se ainda há frases disponíveis, caso contrário, reinicia
if (empty($frases_disponiveis)) {
    reiniciarArquivoFrasesUsadas($arquivo_txt);
    $frases_usadas = [];
    $frases_disponiveis = $frases;
}

// seleciona uma frase aleatória das disponíveis
$frase_selecionada = $frases_disponiveis[array_rand($frases_disponiveis)];

//pra achar os numeros correspondentes de cada frase
$indice_frase = array_search($frase_selecionada, $frases);
$numeros_associados = explode(" - ", $numeros[$indice_frase]);

$numeros_associados = array_map('intval', $numeros_associados);
sort($numeros_associados);

// salva a frase selecionada no arquivo de frases usadas
salvarFraseUsada($frase_selecionada, $arquivo_txt);

// exibe a frase selecionada
$fraseAtual = $frase_selecionada;

$_SESSION['numeros_associados'] = $numeros_associados;
$_SESSION['frase_atual'] = $fraseAtual;
$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (1 * 60);

$temp_array = array_unique($frases); 
$duplicates = sizeof($temp_array) != sizeof($frases);

?>