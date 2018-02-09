<?php
    include("../dbconnect.php");
?>

<?php
    include("icerikEkle.html");
?>

<?php


session_start();


if(!isset($_SESSION["ad"]))
    header("Location:adminLogin.php");


    if(@$_POST["onay"]) {

        $sayac=1;

        $kategori = $_POST["kategori"];

        if ($kategori == "TEMEL SEVİYE PROGRAMLAMA") {
            $id=1;
        }

        if($kategori=="İLERİ SEVİYE PROGRAMLAMA") {
            $id=2;
        }

            $baslik = $_POST["icerikBas"];

            $icerik = $_POST["icerik"];

            $ekleic = $con->prepare("INSERT INTO baslikicerik(kat_id,icerikBaslik,icerik) VALUES (?,?,?)");

            $ekleic->bind_param("iss", $id, $baslik, $icerik);

            $durum1 = $ekleic->execute();

            $ekleic->close();

            $cek = $con->query("SELECT * FROM baslikicerik");

            if ($cek->num_rows > 0) {
                while (($oku = $cek->fetch_assoc()) != null) {

                    if ($sayac != $cek->num_rows) {
                        $sayac++;
                    }
                    else {
                        $icerikid = $oku['id'];
                        break;
                    }

                }
            }

            $dosya1 = $_FILES["dosya1"]["tmp_name"];
            $dosya2 = $_FILES["dosya2"]["tmp_name"];

            if($id==1) {
                $dosya1yol = "../img/temel/" . $_FILES["dosya1"]["name"];
                $dosya2yol = "../img/temel/" . $_FILES["dosya2"]["name"];
            }

            else{
                $dosya1yol = "../img/ileri/" . $_FILES["dosya1"]["name"];
                $dosya2yol = "../img/ileri/" . $_FILES["dosya2"]["name"];
            }

            copy($dosya1, $dosya1yol);
            copy($dosya1, $dosya2yol);

            $resimekle = $con->prepare("INSERT INTO icerikfoto(kate_id,icerik_id,resim1,resim2) VALUES (?,?,?,?)");

            $resimekle->bind_param("iiss", $id, $icerikid, $dosya1yol, $dosya2yol);

            $durum2=$resimekle->execute();

            $resimekle->close();

            if($durum1 && $durum2)
                echo "<script>alert('BAŞARILI ! EKLEME İŞLEMİ GERÇEKLEŞTİ');</script>";

            else
                echo "<script>alert('BAŞARISIZ ! EKLEME İŞLEMİ GERÇEKLEŞMEDİ');</script>";

    }

?>

<?php

$con->close();

?>
