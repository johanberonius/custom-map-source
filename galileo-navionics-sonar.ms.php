<?php
        $url = 'http://backend.navionics.io/tile/get_key/Navionics_internalpurpose_00001/webapp.navionics.com';
        $referer = 'https://webapp.navionics.com';
        $mapsource = '<?xml version="1.0" encoding="UTF-8"?>
<customMapSource>
<name>Navionics SonarCharts</name>
<url>http://backend.navionics.io/tile/{$z}/{$x}/{$y}?LAYERS=config_1_18.29_1&TRANSPARENT=FALSE&UGC=TRUE&navtoken={$navtoken}</url>
</customMapSource>';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        $navtoken = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($info["http_code"] == 200) {
            header('Content-type: application/x-galileo');
            echo str_replace('{$navtoken}', urlencode($navtoken), $mapsource);
        } else {
            header('Content-type: text/plain');
            echo 'Something went wrong';
        }

