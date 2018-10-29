<?php

echo "\033[31m*Script ini dibuat oleh Alfian Ananda Putra (@pianjammalam) pada tanggal 28 Oktober 2018. \n";
echo "\033[31m*Tidak di perbolehkan untuk mengedit atau menulis ulang kode! \n \n";
echo "\033[1;36mMasukkan Email APPNANA : ";
$email = trim(fgets(STDIN));
echo "\033[1;36mMasukkan Password APPNANA : ";
$password = trim(fgets(STDIN));

// Login Time

$resultAwal = file_get_contents('http://dashlikes.com/Projek/Appnana/Proses/login.php?email='.$email.'&password='.$password);

if(!empty(json_decode($resultAwal,true)['userId'])){
  echo "\nBerhasil login ke akun ".json_decode($resultAwal,true)['userId']." | Balance \033[1;33m ".json_decode($resultAwal,true)['nanasBalance']."\033[0m \n";
  echo "Terimakasih sudah menggunakan tools kami. Jangan lupa follow @pianjammalam untuk mendapatkan update terbaru. \n";
  echo "Ingin menjadi apa anda? \033[1;30m 5 Detik \033[0m \n";
  echo "ketik \033[0;36ma\033[0m untuk berperan menjadi \033[0;36planter(penanam)\033[0m \n";
  echo "ketik \033[0;32mb\033[0m untuk berperan menjadi \033[0;32treat(merawat)\033[0m \n";
  echo "ketik \033[1;31mc\033[0m untuk berperan menjadi \033[1;31harvesters(pemanen)\033[0m \n >>> ";
  $option = trim(fgets(STDIN));
  
  if(strtolower($option)    ==  'a'){
      echo "\nAnda berperan sebagai \033[1;33mplanter(penanam)\033[0m, bekerja untuk menanamkan semua iklan yang ada dari APPNANA(Applovin) sebagai akun yang terdaftar di database. Jadi kamu membantu semua user yang menggunakan tools ini untuk menanamkan iklan. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      $listAkun =   file_get_contents('http://dashlikes.com/Projek/Appnana/Proses/loginuserdata.php');
      
      while(1){
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
            $tanamiklan =   file_get_contents('http://dashlikes.com/Projek/Appnana/Proses/tanam.php?userid='.explode('|',$k)[0].'&devicetoken='.json_decode($resultAwal,true)['deviceToken'].'&clc='.json_decode($result,true)['clcode'].'&codesc='.json_decode($result,true)['settings']['sc'].'&command=insert');
            if(!empty(json_decode($result,true)['ad_size'])){
                echo "\033[1;34m".explode('|',$k)[0]." | Sukses \033[0m \n";
            }else{
                echo "\033[31m".explode('|',$k)[0]." | Gagal \033[0m \n";
            }
        }
      }
      
  }
  
  
}else{
    echo "\nGagal Login \n";
}
