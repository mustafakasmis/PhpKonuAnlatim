<?php

// BU KISIMDA TEMEL SEVİYE PROGRAMLAMANIN BÜTÜN İÇERİKLERİ ÇEKİLİYOR

$Ticeriklerid=array();
$TicerikBasliklar=array();
$Ticerikler=array();

$TicerikFotoYol1=array();
$TicerikFotoYol2=array();

$id=1;

$x=$con->prepare("SELECT id,icerikBaslik,icerik FROM baslikicerik WHERE kat_id=? ");
$x->bind_param("i",$id);
$x->execute();

$veriler=$x->get_result();

if($veriler->num_rows>0){
    while (($oku=$veriler->fetch_assoc())!=null){
        array_push($Ticeriklerid,$oku['id']);
        array_push($TicerikBasliklar,$oku['icerikBaslik']);
        array_push($Ticerikler,$oku['icerik']);
    }
}

$x->close();

$y=$con->query("SELECT resim1,resim2 FROM icerikfoto WHERE kate_id='$id'");

if($y->num_rows>0){
    while (($oku= $y->fetch_assoc())!=null){
        array_push($TicerikFotoYol1,$oku['resim1']);
        array_push($TicerikFotoYol2,$oku['resim2']);
    }
}

?>


<?php

// BU KISIMDA İLERİ SEVİYE PROGRAMLAMANIN BÜTÜN İÇERİKLERİ ÇEKİLİYOR

$ISiceriklerid=array();
$ISicerikBasliklar=array();
$ISicerikler=array();

$ISicerikFotoYol1=array();
$ISicerikFotoYol2=array();


$id=2;

$x=$con->prepare("SELECT id,icerikBaslik,icerik FROM baslikicerik WHERE kat_id=? ");
$x->bind_param("i",$id);
$x->execute();

$veriler=$x->get_result();

if($veriler->num_rows>0){
    while (($oku=$veriler->fetch_assoc())!=null){
        array_push($ISiceriklerid,$oku['id']);
        array_push($ISicerikBasliklar,$oku['icerikBaslik']);
        array_push($ISicerikler,$oku['icerik']);
    }
}

$x->close();

$y=$con->query("SELECT resim1,resim2 FROM icerikfoto WHERE kate_id='$id'");

if($y->num_rows>0){
    while (($oku=$y->fetch_assoc())!=null){

        array_push($ISicerikFotoYol1,$oku['resim1']);
        array_push($ISicerikFotoYol2,$oku['resim2']);
    }
}


?>