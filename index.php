<?php
    include ("dbconnect.php");
?>

<?php
    include ("dbDatas.php");
?>

<?php

// BURADA İÇEİĞİN SADECE BELLİ BİR KISMI GETİRİLMİŞTİR


    $url=$_SERVER['REQUEST_URI'];

    $varmi=strstr($url,"?id");  // EĞER URL ?id var ise içerik getirilecektir.

    if($_REQUEST && $varmi){

        $f=0;

            $metin=explode("?id=",$url);
            $gelen=$metin[1];

            $veriler=explode("-",$gelen);

            $katid=intval($veriler[0]);
            $icid=intval($veriler[1]);

         $x=$con->prepare("SELECT icerikBaslik,icerik FROM baslikicerik WHERE id=? AND kat_id=?");

         $x->bind_param("ii",$icid,$katid);

         $x->execute();

         $icerikveriler=$x->get_result();

         if($icerikveriler->num_rows){
             while (($oku=$icerikveriler->fetch_assoc())!=null){
                 $icrkbaslik=$oku['icerikBaslik'];
                 $icrk=$oku['icerik'];
                 break;
             }
         }

         $x->close();

         $parcaliicerik=substr($icrk,0,strlen($icrk)-(strlen($icrk)-30));  //BU KISIMDA İÇERİK PARÇALANIYOR

         $parcaliicerik=$parcaliicerik." <a href='index.php?fid=$icid-$katid'>Devamı için buraya tıklayınız...</a>";

    }

?>

<?php

// BURADA FULL İÇERİĞİN GÖRÜNMESİ GEREKEN İŞLEMLER YAPILMIŞTIR


$url=$_SERVER['REQUEST_URI'];

$varmi=strstr($url,"?fid");

if($_REQUEST && $varmi){

    $f=1;

    //BU KISIMDA URL PARÇALANIP İÇERİK VE GEREKLİ KATEGORİ İD DEĞERLERİ ALINIYOR

    $metin=explode("?fid=",$url);
    $gelen=$metin[1];

    $veriler=explode("-",$gelen);

    $icid=intval($veriler[0]);
    $katid=intval($veriler[1]);

    $x=$con->prepare("SELECT icerikBaslik,icerik FROM baslikicerik WHERE id=? AND kat_id=?");

    $x->bind_param("ii",$icid,$katid);

    $x->execute();

    $icerikveriler=$x->get_result();

    if($icerikveriler->num_rows){
        while (($oku=$icerikveriler->fetch_assoc())!=null){
            $icrkbaslik=$oku['icerikBaslik'];
            $icrk=$oku['icerik'];
            break;
        }
    }

    $x->close();

    $y=$con->prepare("SELECT resim1,resim2 FROM icerikfoto WHERE icerik_id=?");
    $y->bind_param("i",$icid);

    $y->execute();

    $icerikfotolar=$y->get_result();

    if($icerikfotolar->num_rows){
        while (($oku=$icerikfotolar->fetch_assoc())!=null){
            $resim1=$oku['resim1'];
            $resim2=$oku['resim2'];
            break;
        }
    }

    $y->close();

    // BU KISIMDA İSE DB DEN ÇEKİLEN RESİM YOLLARI PARÇALANIP KAYNKA PATH LER ELDE EDİLİYOR

    $resim1path=substr($resim1,3,strlen($resim1)-0);
    $resim2path=substr($resim2,3,strlen($resim2)-0);

}

?>

<?php
    include("index.html");
?>



