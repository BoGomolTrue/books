
<div class="container">
<div class="breadcrumb flat">
			<a href="index.php">Книжный магазин</a>
    		<a class='book-breadcrumb active' href="#">Книги</a> 
</div>
<div class="row">
<?php
include("../../modules/connect.php");


$page = isset($_GET['page']) ? $_GET['page']: 1;

$number= $_SESSION['user_log'];

$limit = 8;
$offset = $limit * ($page-1);

$select="select * FROM books LIMIT $limit OFFSET $offset";


$query=mysqli_query($link,$select);
$num=mysqli_num_rows($query);


$select_two="select count(*) FROM books";
$query_two=mysqli_query($link,$select_two);
$num_two=mysqli_num_rows($query_two);
$row_two=mysqli_fetch_array($query_two);

$pagination = ceil($row_two[0] / $limit);

if($num>0){
	for($i=0; $i<$num; $i++){
		$row=mysqli_fetch_array($query);
		if($row['_Amount'] > 1){
			if($row["_Discount"] != 0){
				$disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]);
				echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='amount-old'>$row[_Price]</span> <span style='text-align: center; color:rgba(240, 125, 1, 1); font-size: 20px;'>$disc Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
			}else{
				if($row["_Price"] == 0){
					echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='book-free$row[0]' style='text-align: center; color:wheat; font-size: 20px;'>Бесплатно</span><div class='btn-content'><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
				}else{
					echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[_Price] Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
				}
			} 
		}else if($row['_Amount'] == 1){
			if($row['_Price'] !== 0){
				echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[_Price] Руб.</span> <span style='color: white;'>(нет в наличии)</span><div class='btn-content'><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
			}else{
				echo "ASD";
			}
		}
	}
}
?>
</div>
<div class="center">
					<ul class="pagination">
						<?php
						for($i = 0; $i<$pagination; $i++){ ?>
						<li><a class='pageinfo' href="?page=<?php echo $i+1; ?>"><?php echo $i +1; ?></a></li>
						<?php } ?>
					</ul>
</div>	