<head>

</head>
<div class="cookie">
<?php
if(!empty($_POST["remember"])){
    setcookie("username",$_POST["username"],time()+ 3600);
    setcookie("password",$_POST["password"],time()+ 3600);
    echo "Cookies guardadas correctamente";
} else{
    setcookie("username","");
    setcookie("password","");
    echo "Cookies no guardadas";
}
?>
</div>