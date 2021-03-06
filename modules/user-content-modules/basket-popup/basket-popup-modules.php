<?php
    include('modules/connect.php');
    session_start();
    $u_id = $_SESSION['user_id'];
    $select="select * FROM orders_at_the_moment INNER JOIN books ON orders_at_the_moment._BooksID =  books.idBooks  where _UserID = '$u_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    
    $select_two="select sum(_PriceO*_AmountO) FROM orders_at_the_moment WHERE _UserID = '$u_id'";
    $query_two=mysqli_query($link,$select_two);
    $num_two=mysqli_num_rows($query_two);
    $row_two = mysqli_fetch_array($query_two);

    if($num == 0){
    ?>
<li class="product-none">
    <a href="#" class="image"><img src="img/icobook.svg" alt="Cart product Image"></a>
    <div class="content">
        <a href="single-product.html" class="title">В Вашей корзине нет товаров</a>
    </div>
</li>
<div class="foot">
    <div class="sub-total">
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-left">Цена :</td>
                    <td class="text-right theme-color"><a class="price">0</a> руб.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="buttons">
        <a href="#" class="btn btn-outline-dark current-btn go-to-basket">Перейти в корзину</a>
    </div>
</div>
<?php }else{
     for($i=0; $i<$num; $i++){
        $row=mysqli_fetch_array($query);
        ?>
<li class='product<?php echo $row['_BooksID']; ?>'>
    <a href="#" class="image"><img src="img/img_books/<?php echo $row['_Photo']; ?>"
            alt="Cart product Image"></a>
    <div class="content">
        <a href="single-product.html" class="title"><?php echo $row['_NameBook']; ?></a>
        <span class="quantity-price"><a class="am<?php echo $row['_BooksID']; ?>"><?php echo $row['_AmountO']; ?></a> x <span class="amount"><a class="pr"><?php echo $row['_Price'];?></a> руб.</span></span>
        <a href="<?php echo $row['_BooksID']; ?>" class="remove remove-basket">×</a>
    </div>
</li>
<?php } ?>
<div class="foot">
    <div class="sub-total">
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-left">Цена :</td>
                    <td class="text-right theme-color"><a class="price"><?php echo $row_two[0] ?></a> руб.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="buttons">
        <a href="#" class="btn btn-outline-dark current-btn go-to-basket">Перейти в корзину/a>
    </div>
</div>
<?php } ?>