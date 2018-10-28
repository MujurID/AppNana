<?php

echo "\033[31m *Script ini dibuat oleh Alfian Ananda Putra (@pianjammalam) pada tanggal 28 Oktober 2018. \n";
echo "\033[31m *Tidak di perbolehkan untuk mengedit atau menulis ulang kode! \n \n";
echo "\033[1;36m Masukkan Email APPNANA : ";
$email = trim(fgets(STDIN));
echo "\033[1;36m Masukkan Password APPNANA : ";
$password = trim(fgets(STDIN));

// Login Time

$resultAwal = file_get_contents('http://dashlikes.com/Projek/Appnana/login.php?email='.$email.'&password='.$password);

if(!empty(json_decode($resultAwal,true)['userId'])){
  echo "\nBerhasil login ke akun \033[1;33m".json_decode($resultAwal,true)['userId']."\033[0m | Balance \033[1;33m ".json_decode($resultAwal,true)['nanasBalance']."\033[0m \n";
  echo "Terimakasih sudah menggunakan tools kami. Jangan lupa follow @pianjammalam untuk mendapatkan update terbaru. \n";
  echo "Aplikasi akan dimulai dalam \033[1;30m 5 Detik \033[0m \n";
  sleep(5);
  
  while(1){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://a.applovin.com/3.0/ad?accept=custom_size,launch_app,video&v4=true&api_did=".json_decode($resultAwal,true)['deviceId']."&zone_id=inter_videoa_direct&country_code=ID&sim=0&carrier=TELKOMSEL&preloading=false&idfa=".json_decode($resultAwal,true)['idfa']."&wvvc=353806410&dy=1920&format=json&orientation_lock=portrait&adns=3.0&sdk_key=wT2o5DOKtwBs_nrNr8rVnBTkEGJV4Q_-v1m_F9J63Vz3GoQ6wFcgQ4PfKi9O89N1A80PHKWKqTN5FpCA2psTuF&gy=true&v1=true&brand_name=asus&sc=".$sc."&si=6&volume=0&dnt=false&dx=1080&locale=in_ID&revision=Z00A_1&ia=15406019".rand(11111,99999)."&li=20&adr=0&os=5.0&v3=true&tz_offset=7.0&network=wifi&platform=android&app_version=3.5.9&adnsd=480&build=103&installer_name=com.android.vending&brand=asus&sdk_version=8.1.4&v2=true&pnr=false&vz=1e89c69ab45abdfb&hardware=mofd_v1&model=ASUS_Z00AD");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $headers = array();
    $headers[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)";
    $headers[] = "Host: a.applovin.com";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $resultA = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    
    $clcsode    =   json_decode($resultA,true)['clcode'];
    $sc =   json_decode($resultA,true)['settings']['sc'];
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/vr?device_token=".json_decode($resultAwal,true)['deviceToken']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clcsode.'","user_id":"'.json_decode($resultAwal,true)['userId'].'","zone_id":"inter_videoa_direct"}');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $headers = array();
    $headers[] = "Content-Type: application/json; charset=utf-8";
    $headers[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)";
    $headers[] = "Host: d.applovin.com";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $resultB = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    
    if(json_decode($resultB,true)['results'][0]['result']   ==  'accepted'){
        sleep(2);
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/cr?device_token=".json_decode($resultAwal,true)['deviceToken']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clcsode.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"15.000000","currency":"Nanas"},"user_id":"'.json_decode($resultAwal,true)['userId'].'"}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        
        $headers = array();
        $headers[] = "Content-Type: application/json; charset=utf-8";
        $headers[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)";
        $headers[] = "Host: d.applovin.com";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        
        echo "\033[1;33m".json_decode($resultAwal,true)['userId'].">>".json_decode($result,true)['results'][0]['result']."\033[0m \n";

    }
    
  }
  
}else{
  print_r($resultAwal);
}
