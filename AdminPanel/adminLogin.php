<html>

<head>

    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script>

        $(function () {
            $("#frm").submit(function () {

                if($("#usrname").val()=="" || $("#usrpass").val()=="" ){
                    alert("LÜTFEN BOŞ ALAN BIRAKMAYINIZ");
                }

            });
        });

    </script>

</head>

<body>

    <div class="container">

        <div class="row">
            <div class="pager page-header col-xs-12 well">
                <h3 class="text-center text-info">ADMİN PANEL LOGİN PAGE</h3>
            </div>
        </div>

    </div>

    <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <form action="adminLogin.php" method="post" id="frm">

                        <h4 class="text-info">KULLANICI ADINIZ</h4>
                        <input type="text" id="usrname" name="usrname" class="form-control"><br>

                        <h4 class="text-info">PAROLANIZ</h4>
                        <input type="password" id="usrpass" name="usrpass" class="form-control"><br>

                        <div class="text-center">
                            <input type="submit" id="btnLogin" name="btnLogin" class="btn btn-success" value="GİRİŞ YAP">
                        </div>

                    </form>

                </div>
            </div>
    </div>

</body>

</html>


<?php

    include("../dbconnect.php");

    session_start();

    if(@$_POST["btnLogin"]) {


        $cek = $con->prepare("SELECT * FROM admingiris WHERE kullanici_adi=? AND parola=?");

        @$cek->bind_param("ss", $_POST["usrname"],  md5($_POST["usrpass"]));

        $durum = $cek->execute();

        if ($durum) {

            $veri = $cek->get_result();

            if ($veri->num_rows > 0) {

                while (($oku = $veri->fetch_assoc()) != null) {

                    $ad = $oku['kullanici_adi'];
                    $sifre = $oku['parola'];

                    $_SESSION["ad"]=$ad;

                    $con->close();

                    header("Location:AdminHomepage.php");

                    break;
                }
            }

        }

        else
            echo "HATALI KULLANICI ADI VEYA PAROLA";

    }

?>