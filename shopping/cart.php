<?php
    session_start();

    require_once('connection.php');
    require_once('./function/components.php');

    
    $select ="SELECT * FROM cart";
    $selected = $connect->query($select);

    if(isset($_POST["remove"])){
        if($_GET['action'] =='remove'){
            foreach($_SESSION['cart'] as $key=>$value){
                if($value["product_id"] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    echo "<script> alert('Product has been removeds ...!')</script>";
                    echo "<script> window.loaction='cart.php'</script>";
                }
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- css  link  -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- font awesome  cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- bootstarp cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-light">
    <?php
        require_once('header.php')

    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My cart</h6>
                    <hr>
                <?php
                $total = 0;
                if(isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'],'product_id');

                    if(mysqli_num_rows($selected)>0){
                        while($row = mysqli_fetch_assoc($selected)){
                        foreach($product_id as $id){
                            if($row['id'] == $id){
                                cartElement($row['product_image'], $row['product_name'] , $row['product_price'], $row['id']);
                                $total = $total + (int)$row ['product_price'];
                            }
                        }
                    }
                    }
                }
                else{
                    echo "<h5>Cart is empty.</h5>";
                }

                ?>

                </div>

            </div>
            <div class="col-md-5">
                <div class="pt-4 offset-md-1 border rounded mt-5 bg-white h-20">
                    <h6>Price details</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                                if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    echo "<h6>Price ($count items)</h6>";
                                }
                                else{
                                    echo "<h6>Price (0 items)</h6>";
                                }
                            ?>

                            <h6>Delivery charges</h6>
                            <hr>
                            <h6>Amount payable</h6>
                        </div>

                        <div class="col-md-6">
                            <h6>$<?php echo $total;?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php echo $total;?></h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>