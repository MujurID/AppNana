<?php

echo "\033[31m*Script ini dibuat oleh Alfian Ananda Putra (@pianjammalam) pada tanggal 3 November 2018. \n";
echo "\033[31m*Tidak di perbolehkan untuk mengedit atau menulis ulang kode atau pun diperjual belikan! \n \n";
echo "\033[1;36mMasukkan Data APPNANA : ";
$data = trim(fgets(STDIN));
$dataJson = json_decode($data,true);

if(!empty($dataJson['userId'])){
    
  echo "\nAkun Anda ".$dataJson['userId']." | Balance \033[1;33m ".$dataJson['nanasBalance']."\033[0m  \n";
  echo "Terimakasih sudah menggunakan tools kami. Jangan lupa follow @pianjammalam untuk mendapatkan update terbaru. \n";
  echo "\nAnda menjadi seorang penyihir, memiliki semua kemampuan, bisa menanam iklan, merawat iklan, hingga memanen iklan dengan kekuatan sihir tersebut. Sihir akan berjalan jika beberapa ramuan terpenuhi, yang pertama adalah WIFI yang optimal, yang kedua adalah berdoa, huehuehue. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      while(1){
          
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://a.applovin.com/3.0/ad?accept=custom_size,launch_app,video&v4=true&api_did=".$dataJson['appId']."&zone_id=inter_videoa_direct&country_code=ID&sim=0&carrier=INDOSAT&preloading=false&idfa=".$dataJson['idfa']."&wvvc=353806410&dy=1920&format=json&orientation_lock=portrait&adns=3.0&sdk_key=wT2o5DOKtwBs_nrNr8rVnBTkEGJV4Q_-v1m_F9J63Vz3GoQ6wFcgQ4PfKi9O89N1A80PHKWKqTN5FpCA2psTuF&gy=true&v1=true&brand_name=asus&sc=".$sc."&si=0&volume=66&dnt=false&dx=1080&locale=in_ID&revision=Z00A_1&ia=15406019".rand(00000,99999)."&li=".rand(1,99999999)."&adr=0&os=5.0&v3=true&tz_offset=7.0&network=wifi&platform=android&app_version=3.5.9&adnsd=480&build=103&installer_name=com.android.vending&brand=asus&sdk_version=8.1.4&v2=true&pnr=false&vz=1e89c69ab45abdfb&hardware=mofd_v1&model=ASUS_Z00AD");
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
            $clc    =   json_decode($result,true)['clcode'];
            if(!empty(json_decode($result,true)['ad_size'])){
                echo "\033[1;34m >".$dataJson['userId']."<  Alhamdulillah kita berhasil nanem :') \033[0m \n";
                
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/vr?device_token=".$dataJson['deviceToken']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clc.'","user_id":"'.$dataJson['userId'].'","zone_id":"inter_videoa_direct"}');
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
                    echo "\033[1;34m >".$dataJson['userId']."<  Sudah di siram, di beri pupuk. Tinggal Lu panen cuk \033[0m \n";
                    sleep(1);
                    
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "https://d.applovin.com/cr?device_token=".$dataJson['deviceToken']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clcode":"'.$clc.'","fire_percent":-1,"zone_id":"inter_videoa_direct","result":"accepted","params":{"amount":"5.000000","currency":"Nanas"},"user_id":"'.$dataJson['userId'].'"}');
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
                        echo "\033[1;34m >".$dataJson['userId']."<  cieee.. berhasil panen. Jangan lupa follow @pianjammalam \033[0m \n";
                    }else{
                        echo "\033[31m >".$dataJson['userId']."<  Kamu udah nyiramin air blom? kok tanemannya kering?!!!. \033[0m \n";
                    }
                    
                    
                }else{
                    echo "\033[31m >".$dataJson['userId']."<  Kena hama coy:( Gagal Panen kita. \033[0m \n";
                }
            
            }else{
                echo "\033[31m".$clc." | Gagal \033[0m \n";
            }
        
      }
  
}else{
    echo "\nGagal \n";
}
