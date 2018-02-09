<?php
    include ("../dbconnect.php");
    include ("../dbDatas.php");
?>

<?php
    include("temelSevProgDuz.html");
?>

<?php

session_start();


if(!isset($_SESSION["ad"]))
    header("Location:adminLogin.php");


    if(@$_POST["gnc"]){


//GİRİLEN İÇERİK BAŞLIĞINA GÖRE GÜNCELLEME YAPIYOR
        $baslik = $_POST["icerikBas"];

        $cek=$con->prepare("SELECT id FROM baslikicerik WHERE icerikBaslik=?");

        $cek->bind_param("s",$baslik);

        $cek->execute();

        $veriler=$cek->get_result();


        if($veriler->num_rows>0){
            while (($oku=$veriler->fetch_assoc())!=null){
                $id=$oku['id'];
                break;
            }
        }

        $cek->close();

        $guncelle=$con->prepare("UPDATE baslikicerik SET icerikBaslik=?,icerik=? WHERE id=?");

        $guncelle->bind_param("ssi",$_POST["icerikBas"],$_POST["icerik"],$id);

        $durum1=$guncelle->execute();

        $guncelle->close();


        if($durum1){
            echo "<script>alert('KAYIT BAŞARIYLA GÜNCELLENDİ');</script>";
        }

        else{
            echo "<script>alert('KAYIT GÜNCELLENEMEDİ');</script>";
        }

    }

?>

<?php

    if(@$_POST["sil"]){

// GİRİLEN İÇERİĞİN İD SİNİ BULUP GETİRİR
        $baslik = $_POST["icerikBas"];

        $cek=$con->prepare("SELECT id FROM baslikicerik WHERE icerikBaslik=?");

        $cek->bind_param("s",$baslik);

        $cek->execute();

        $veriler=$cek->get_result();

        if($veriler->num_rows>0){
            while (($oku=$veriler->fetch_assoc())!=null){
                $id=$oku['id'];
            }
        }

        $cek->close();

// KLASÖRDEKİ RESİMLERİ SİLME
        $resimcek=$con->query("SELECT resim1,resim2 FROM icerikfoto WHERE icerik_id='$id' ");

        while (($oku=$resimcek->fetch_assoc())!=null){
            $silresim1=$oku['resim1'];
            $silresim2=$oku['resim2'];
            break;
        }

        unlink($silresim1);
        unlink($silresim2);

// DB DEKİ RESİMLERİ SİLME
        $resimsil=$con->prepare("DELETE FROM icerikfoto WHERE icerik_id=?");

        $resimsil->bind_param("i",$id);

        $durum1=$resimsil->execute();

        $resimsil->close();

// DB DEKİ İÇERİĞİ SİLER
        $sil=$con->prepare("DELETE FROM baslikicerik WHERE id=?");
        $sil->bind_param("i",$id);
        $durum2=$sil->execute();

        $sil->close();


        if($durum1&&$durum2){
            echo "<script>alert('KAYIT BAŞARIYLA SİLİNDİ');</script>";
        }

        else{
            echo "<script>alert('KAYIT SİLİNEMEDİ');</script>";
        }

    }

?>

<?php
    $con->close();
?>