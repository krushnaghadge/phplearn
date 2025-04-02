<?php
//print_r($_GET);
$conn = mysqli_connect('localhost', 'root', '', 'Learning');
$sql="SELECT *FROM product WHERE product_id='".$_GET['id']."' ";
$res=mysqli_query($conn,$sql);
//echo"<pre>";
//$data=mysqli_fetch_assoc($res);
//print_r($data);

foreach($res as $key => $data)
{
    ?>
<form action="update_product.php" method="POST">
product id: <input type="text" name="product_id" value="<?=$data['product_id']?>"><br><br>
Edit Product name: <input type="text" name="product_name" value="<?=$data['product_name']?>"> <br><br>
Edit Product price : <input type="number" name="product_price" value="<?=$data['product_price']?>"> <br><br>
Edit Product quqntity: <input type="number" name="product_qty" value="<?=$data['product_qty']?>"> <br><br>
Edit Product description: <textarea name="product_description"> <?=$data['product_exp_date']?></textarea> <br><br>
Edit Product expiry date: <input type="date" name="product_exp_date" value="<?=$data['product_exp_date']?>"> <br><br>
Edit Company: <input type="text" name="product_company" value="<?=$data['product_company']?>"> <br><br>
<button> Save update</button>

  <?php  
}
?>