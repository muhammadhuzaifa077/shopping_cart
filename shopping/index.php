<?php

// start sessions
session_start();

// end sessions
require_once('./function/components.php');
require_once('connection.php');

    $select ="SELECT * FROM cart";
    $selected = $connect->query($select);


    if(isset($_POST["add"])){
        // print_r($_POST['product_id']);

        if(isset($_SESSION['cart'])){
            $item_array_id=array_column($_SESSION['cart'],"product_id");
            if(in_array($_POST["product_id"],$item_array_id)){
                echo "<script>alert('Product is already added in the cart...!')</script>";
                echo "<script>eindow.location = 'index.php'</script>";
            }
            else{
                $count =count($_SESSION['cart']);
                $item_array =array(
                    'product_id' =>$_POST['product_id']
                );

                $_SESSION['cart'][$count] = $item_array;
                // print_r($_SESSION['cart']);
            }

        }else{
            $item_array = array(
                'product_id' =>$_POST['product_id']
            );
            
                    // created new session variable
                    $_SESSION['cart'][0] =$item_array;
                    print_r($_SESSION['cart']);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>

    <!-- css  link  -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- font awesome  cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- bootstarp cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

    <?php
        require_once('header.php')
    ?>

 <div class="container">
    <div class="row text-center py-5">

    <?php

if(mysqli_num_rows($selected)>0){
    while ($row = mysqli_fetch_assoc($selected)){
            component($row['product_name'], $row['product_price'] , $row ['product_image'] , $row['id']);
        }
}

    ?>

    </div>
 </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>



<!-- 
    INSERT INTO `cart`( `product_name`, `product_price`, `product_image`) VALUES
('Apple Mac book Pro','599','./uploads/product1.png'),
('Apple Mac book Pro','290','./uploads/product1.png'),
('Apple Mac book Pro','350','./uploads/product1.png'),
('Apple Mac book Pro','400','./uploads/product1.png')
 -->