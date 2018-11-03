<?php
echo "\033[31m*Script ini dibuat oleh Alfian Ananda Putra (@pianjammalam) pada tanggal 3 November 2018. \n";
echo "\033[31m*Tidak di perbolehkan untuk mengedit atau menulis ulang kode atau pun diperjual belikan! \n \n";
echo "\033[1;36mMasukkan Data APPNANA : ";
$data = '{"userId":28128972,"currentDeviceId":26411281,"fullUserId":"28128972z26411281","deviceId":"10b86467c2dadf003d","vx":"1e89c69ab45abdfb","deviceToken":"MaznYs97JTiqaqEwnZGZ5g9Pz9jLmvt3VdE-hRvFGE2N3C4br_34EMwxlwBM-SDNGdcZKksc4hmVTv-XwPONVg5QhXMPj_B9OvmPo2Y9SknPZy6FTjC8LpNYMojR4aYRwVp8lD048zvUAE7M-VvHYZzwBp4DnM-iWwCrAWcmjYM=","appId":"1e89c69ab45abdfb","nanasBalance":10425,"idfa":"37e6b995-1405-4026-bf9f-d36a31c6aa6f"}';//trim(fgets(STDIN));
$dataJson = json_decode($data,true);
if(!empty($dataJson['userId'])){
    
  echo "\nAkun Anda ".$dataJson['userId']." | Balance \033[1;33m ".$dataJson['nanasBalance']."\033[0m  \n";
  echo "Terimakasih sudah menggunakan tools kami. Jangan lupa follow @pianjammalam untuk mendapatkan update terbaru. \n";
  echo "\nAnda menjadi seorang penyihir, memiliki semua kemampuan, bisa menanam iklan, merawat iklan, hingga memanen iklan dengan kekuatan sihir tersebut. Sihir akan berjalan jika beberapa ramuan terpenuhi, yang pertama adalah WIFI yang optimal, yang kedua adalah berdoa, huehuehue. \n Aplikasi akan mulai dalam 5 detik ... \n";
      sleep(5);
      
      while(1){
          
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://a.applovin.com/3.0/ad?v1=true&adr=0&model=GT-I9060I&hardware=sc8830&dx=480&dy=800&v4=true&v3=true&accept=custom_size,launch_app,video&v2=true&api_did=".$dataJson['appId']."&locale=in_ID&huc=true&app_version=3.5.10&build=103&network=wifi&brand_name=samsung&revision=grandneove3g&preloading=false&ia=154107100".rand(00000,99999)."&plugin_version=MoPub-3.1.0&installer_name=com.android.vending&carrier=TELKOMSEL&wvvc=0&platform=android&os=4.4.4&gy=false&adnsd=240&tz_offset=7.0&zone_id=inter_videoa_direct&pnr=true&sdk_version=8.1.4&sc=".$sc."&dnt=false&format=json&country_code=&sdk_key=wT2o5DOKtwBs_nrNr8rVnBTkEGJV4Q_-v1m_F9J63Vz3GoQ6wFcgQ4PfKi9O89N1A80PHKWKqTN5FpCA2psTuF&si=5&li=".rand(1,99999999)."&adns=1.5&vz=1e89c69ab45abdfb&volume=0&sim=0&brand=samsung&mediation_provider=mopub&orientation_lock=portrait&idfa=".$dataJson['idfa']."");
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
                //echo "\033[31m".$clc." | Gagal \033[0m \n";
                print_r($result);
            }
        
      }
  
}else{
    echo "\nGagal \n";
}
