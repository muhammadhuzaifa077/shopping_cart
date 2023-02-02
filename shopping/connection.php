<?php
    $server  = "localhost";
    $username  ="root";
    $password = "";
    $db_name = "shopping_cart";

    $connect = mysqli_connect($server ,$username ,$password , $db_name);

?>

<!-- 
    create table cart (
	id int(11) AUTO_INCREMENT primary key  not null,
    product_name varchar(25) not null,
    product_price float,
    product_image varchar(100)
);
 -->