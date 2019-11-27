<?php

if (!function_exists('dump')) {
    function dump(...$args)
    {
        foreach ($args as $var) {
            debug($var);
        }
    }
}
if (!function_exists('dd')) {
    function dd(...$args)
    {
        foreach ($args as $var) {
            debug($var);
        }
        die();
    }
}

/**
 * Função debug. mostra o conteúdo de uma variável, ou array dentro da tag <pre>.
 *
 * @param mixed	 - A variável a ser impressa.
 * @param boolean   - True continua a execução do cósigo, False sai da execução do cósigo com die();
 * @param boolean   - Corta qualquer espaço em branco vindo da variavel.
 */
if (!function_exists('debug')) {
    function debug($var, $continua = true, $cortaEspacosEmBranco = false)
    {
        echo "\n<pre>\n";
        if ($cortaEspacosEmBranco) {
            $var = preg_replace("%\n[\t\ \n\r]+%", "\n", $var);
        }
        if (is_bool($var)) {
            var_dump($var);
        } elseif (is_array($var)) {
            print_r($var);
        } else {
            print_r($var);
        }
        echo "\n</pre>\n";

        if (!$continua) die();
    }
}

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
            ],
        ],
    ],
];
