<?php

/**
 * Génère config/countries_fr.php à partir des libellés ICU (fr).
 * Anciens codes ISO / doublons exclus (on garde le code moderne : DE, BF, etc.).
 */

$deprecated = [
    'DD', 'HV', 'DY', 'ZR', 'AN', 'FX', 'BU', 'UK', 'SU', 'CS', 'YU', 'TP', 'NH', 'VD', 'YD', 'RH',
];

$out = [];
for ($i = 0; $i < 676; $i++) {
    $a = chr(65 + intdiv($i, 26) % 26);
    $b = chr(65 + $i % 26);
    $code = $a.$b;
    if (in_array($code, $deprecated, true)) {
        continue;
    }
    $name = Locale::getDisplayRegion('-'.$code, 'fr');
    if ($name === $code || $name === '') {
        continue;
    }
    if (mb_strlen($name) < 2) {
        continue;
    }
    $out[$code] = $name;
}

asort($out, SORT_LOCALE_STRING);

$path = dirname(__DIR__).'/config/countries_fr.php';
$fh = fopen($path, 'w');
fwrite($fh, "<?php\n\n");
fwrite($fh, "/**\n * Pays ISO 3166-1 alpha-2, libellés français (ICU).\n * Régénérer : php scripts/build_countries.php\n */\n\n");
fwrite($fh, "return [\n\n");
foreach ($out as $code => $name) {
    $escaped = str_replace(["\\", "'"], ["\\\\", "\\'"], $name);
    fwrite($fh, "    '".$code."' => '".$escaped."',\n");
}
fwrite($fh, "\n];\n");
fclose($fh);

echo 'Écrit '.$path.' ('.count($out)." entrées).\n";
