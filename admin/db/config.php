<?php
//database connection link


$link=mysqli_connect("127.0.0.1", "benedictAdmin", "Mutisya1996!" , "benesoftkedb");
if($link==false){
    echo "database connection failed";
}

?>