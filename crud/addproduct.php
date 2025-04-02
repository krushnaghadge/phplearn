<h1> Add new product</h1>
<form action="save_product.php" method="POST">

    Product name: <input type="text" name="product_name"> <br><br>
    Product price : <input type="number" name="product_price"> <br><br>
    Product quqntity: <input type="number" name="product_qty"> <br><br>
    Product description: <textarea name="product_description"> </textarea> <br><br>
    Product expiry date: <input type="date" name="product_exp_date"> <br><br>
    Company: <input type="text" name="product_company"> <br><br>
    <button> Add Button</button>


</form>

<?php
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Learning";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn, 'SELECT * FROM product');
?>

<table border="1" cellspacing="11" cellpadding="11">
    <tr>


        <th></th>
        <th>Sr No</th>
        <th>Product name</th>
        <th>Product price</th>
        <th>Product qty</th>
        <th>Product description</th>
        <th>Product expire date</th>
        <th>Product company</th>
    </tr>
    <?php
    $i = 0;
    foreach ($res as $key => $value) {
    ?>
        <tr>
            <th>
                <a href="editproduct.php?id=<?= $value['product_id'] ?>"><button>Edit</button></a>
                <a href="deleteproduct.php?id=<?= $value['product_id'] ?>"><button>Delete</button></a>
            </th>

            <td><?= ++$i ?> </td>

            <th><?= $value['product_name'] ?></th>
            <th><?= $value['product_price'] ?></th>
            <th><?= $value['product_qty'] ?></th>
            <th><?= $value['product_description'] ?></th>
            <th><?= $value['product_exp_date'] ?></th>
            <th><?= $value['product_company'] ?></th>
        </tr>
    <?php
    }

    ?>

</table>