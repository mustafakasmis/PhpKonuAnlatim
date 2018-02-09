<html>

<head>

        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

    <style>
        #dv{
          display:none;
        }

        a{
            font-family: "Times New Roman";
            font-size:25px;
        }
    </style>

    <script>
        $(function(){

            $("#btn").click(function () {
                $("#dv").slideToggle();
            });

        });
    </script>

</head>

<body>

    <div class="container">
        <div class="row">

            <div class="pager page-header col-xs-12 well">
                <h4 class="text-center text-info">HOŞGELDİNİZ</h4>
            </div>

            <div class="col-xs-12  text-center">
                <button type="button" id="btn" name="btn" class="btn btn-primary">İÇERİK İŞLEMLERİ</button>
                    <form method="post">
                <input type="submit" id="btnSonlandir" name="btnSonlandir" class="btn btn-primary" value="OTURUMU KAPAT">
                    </form>
            </div>

            <div class="col-xs-12">
                <br>
            </div>

            <div id="dv" class="col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item text-center"><a href="icerikEkle.php">İÇERİK EKLEME</a></li>
                    <li class="list-group-item text-center"><a href="temelSevProgDuz.php">TEMEL SEVİYE PROGRAMLAMA İÇERİK DÜZENLEME</a></li>
                    <li class="list-group-item text-center"><a href="ileriSevProgDuz.php">İLERİ SEVİYE PROGRAMLAMA İÇERİK DÜZENLEME</a></li>
                </ul>
            </div>

        </div>
    </div>

</body>

</html>

<?php

session_start();

if(!isset($_SESSION["ad"]))
    header("Location:adminLogin.php");


if(@$_POST["btnSonlandir"]){
    session_destroy();
    header("Location:adminLogin.php");
}

?>