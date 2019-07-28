<?php
date_default_timezone_set("Asia/Jakarta");
function request($url, $post = null, $cookies = null, $headers = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    if(!is_null($headers))
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if(!is_null($cookies))
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    if(!is_null($post)){
    	curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $resp = curl_exec($ch);
    $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($resp, 0, $header_len);
    $body = substr($resp, $header_len);
    curl_close($ch);
    preg_match_all('#Set-Cookie: ([^;]+)#', $header, $d);
    $cookie = '';
    for ($o=0;$o<count($d[0]);$o++) {
        $cookie.=$d[1][$o].";";
    }

    return [$header, $body, $cookie];
}
function request_post_without_params($url, $post = null, $cookies = null, $headers = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    if(!is_null($headers))
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if(!is_null($cookies))
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    if(!is_null($post)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $resp = curl_exec($ch);
    $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($resp, 0, $header_len);
    $body = substr($resp, $header_len);
    curl_close($ch);
    preg_match_all('#Set-Cookie: ([^;]+)#', $header, $d);
    $cookie = '';
    for ($o=0;$o<count($d[0]);$o++) {
        $cookie.=$d[1][$o].";";
    }

    return [$header, $body, $cookie];
}
function request_options($url, $post = null, $cookies = null, $headers = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
    curl_setopt($ch, CURLOPT_HEADER, 1);
    if(!is_null($headers))
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if(!is_null($cookies))
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    if(!is_null($post)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $resp = curl_exec($ch);
    $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($resp, 0, $header_len);
    $body = substr($resp, $header_len);
    curl_close($ch);
    preg_match_all('#Set-Cookie: ([^;]+)#', $header, $d);
    $cookie = '';
    for ($o=0;$o<count($d[0]);$o++) {
        $cookie.=$d[1][$o].";";
    }

    return [$header, $body, $cookie];
}
function generate_name()
{
    $header = array(
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:68.0) Gecko/20100101 Firefox/68.0',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: keep-alive',
        'Referer: http://ninjaname.horseridersupply.com/indonesian_name.php',
        'Upgrade-Insecure-Requests: 1'
    );
    $get_nama = request('http://ninjaname.horseridersupply.com/indonesian_name.php', 'number_generate=30&gender_type=male&submit=Generate', null, $header);
    preg_match_all('#&bull; ([^;]+)<br/>&bull; #', $get_nama[1], $nama);
    $nama = $nama[1][0];
    $username = strtolower(str_replace(' ', '', $nama));

    return [$nama, $username];
}
function generate_password()
{
    $characters = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuioipasdfghjklzxcvbnm0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generate_voucher($lenght)
{
    $characters = 'ABCDEF0123456789'; //php php/tes_gojek.php
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $lenght; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function gmail_dot_trick($str)
{ 
    if ((strlen($str) > 1) && (strlen($str) < 31)) { 
        $ca = preg_split("//",$str); 
        array_shift($ca); 
        array_pop($ca); 
        $head = array_shift($ca); 
        $res = gmail_dot_trick(join('',$ca)); 
        $result = array(); 
        foreach($res as $val){ 
            $result[] = $head . $val; 
            $result[] = $head . '.' .$val; 
        } 
        return $result; 
    } 
    return array($str); 
}
?>