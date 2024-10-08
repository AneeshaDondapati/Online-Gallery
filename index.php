<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Art Gallery Store</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
		<style>
		.popover
		{
		    width: 100%;
		    max-width: 800px;
		}
		body{
			font-family: 'Playfair Display', serif;
		}
		
		</style>
	</head>
	<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand h1" href="index.php"><i class="fas fa-couch" aria-hidden="true"></i> Art Gallery</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
<h3>Logout</h3>
</a>
      </li>
    </ul>
  </div>
</nav>



		<nav class="navbar navbar-dark bg-dark" style="
		background-color: #2908FD;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-size: 25px; color: white;" href="index.php"> <i class="fas fa-couch"></i> Art Gallery</a>
    </div>

    <div class=" mr-auto" style="padding-left: 60%;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <!-- <a class="navbar-brand" style="font-size: 18px; color: white;" href="adminlogin.php"><i class="fas fa-user-lock"></i>  Admin Panel </a>-->
      <a class="" style="font-size: 18px; color: white;" href="carttry.php"> <i class="fas fa-shopping-bag"></i> Your Bag</a>
    </div>
  </div><!-- /.container-fluid -->
</nav>




		<div class="container" ng-app="shoppingCart" ng-controller="shoppingCartController" ng-init="loadProduct(); fetchCart();">
			<br />
			
			<h3 align="center" ><a href="carttry.php" style="color: #48494B;"><i class="fas fa-shopping-bag"></i> Your bag: {{setTotalqt()}}</a></h3>
			<h3 align="center">Products On Sale</h3>
			<br />
			<form method="post">
				<div class="row">
					<div class="col-md-3 shadow" style="margin-top:12px;" ng-repeat = "product in products">
						<div style="box-shadow: 2px; background-color:#ffffff; border-radius:5px; padding:16px; height:450px;" align="center">
							<img ng-src="images/{{product.image}}" class="img-responsive" style="width: 180px; height: 200px;" /><br />
							<h4 class="text-info">{{product.name}}</h4>
							<h4 class="text-danger">Rs {{product.price}}</h4><br>
							
							<input type="button" name="add_to_cart" style="margin-top:5px;" class="btn btn-dark form-control" value="Add to Cart" ng-click="addtoCart(product)" />

						</div>
					</div>
				</div>
			</form><br>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>

<script>

var app = angular.module('shoppingCart', []);

app.controller('shoppingCartController', function($scope, $http){
	
	$scope.loadProduct = function(){
		$http.get('fetch.php').success(function(data){
            $scope.products = data;
        });
	};
	
	$scope.carts = [];
	
	$scope.fetchCart = function(){
		$http.get('fetch_cart.php').success(function(data){
            $scope.carts = data;
        });
	};
	
	$scope.setTotals = function(){
		var total = 0;
		for(var count = 0; count<$scope.carts.length; count++)
		{
			var item = $scope.carts[count];
			total = total + (item.product_quantity * item.product_price);
		}
		return total;
	};


	$scope.setTotalqt = function(){
		var totalqt = 0;
		for(var count = 0; count<$scope.carts.length; count++)
		{
			var item = $scope.carts[count];
			totalqt = totalqt + (item.product_quantity);
		}
		return totalqt;
	};
	
	$scope.addtoCart = function(product){
		$http({
            method:"POST",
            url:"add_item.php",
            data:product
        }).success(function(data){
			$scope.fetchCart();
        });
	};
	
	$scope.removeItem = function(id){
		$http({
            method:"POST",
            url:"remove_item.php",
            data:id
        }).success(function(data){
			$scope.fetchCart();
        });
	};
	
});

</script>