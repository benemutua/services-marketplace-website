<?php
//the database connection wizard
$link= mysqli_connect("127.0.0.1", "benedictAdmin", "Mutisya1996!", "benesoftkedb");
if($link==true){

}
else{
    echo "Database connection failed. Credentials mismatch Contact Systems admin for help";
}

?>