<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="style.css">

<style>
    /*styles de efecto hover la card*/
    body {
      background: #232321;
    }

    h1 {
      color: #fff;
      padding: 10px 0;
    }
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      transition: 0.3s;
      border: none;
    }
    .card:hover {
      box-shadow: 0 8px 16px 0 rgb(172, 18, 18);
    }
    .card a {
      color: initial;
    }
    .card a:hover {
      text-decoration: initial;
    }
    .card .text-muted i {
      margin: 0 10px;
    }

    /*styles de efecto hover en imagen*/
    figure{
	margin: 0;
	padding: 0;
	box-sizing:border-box;
	}
	figure{
	width: 350px;
	height: 250px;
	overflow: hidden;
	cursor: pointer;
	border-radius: 5px;
	box-shadow: 1px 5px 25px rgba(0,0,0,0.5);
	margin: none;
	}
	figure img{
	width: auto;
	height: 100%;
	transition:1.0s;
	will-change: transform;
	}
	figure img:hover{
	transform: translateX(-30%);
	filter: brightness(80%);
	}
</style>

</head>
<body>
<div class="container">
  <div class="text-center">
    <h1>Productos</h1>
  </div>
  
  <div class="container">
    <div class="card-columns">
     
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla bla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla bla</p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla bla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla bla </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla  </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla  </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla  </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla  </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
      <div class="card">
        <figure><img class="card-img-top" src="shrek.jpeg" alt="image"></figure>
        <div class="card-body">
          <h5 class="card-title"> Nombre del producto </h5>
          <p class="card-text"> bla bla bla blabla blabla blabla blabla blabla bla  </p>
          
          <a href="#"><p class="card-text" style="color:#900202"><i class="fas fa-shopping-cart"> </i>    Agregar al carrito</p></a><br> 
          
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>Existencia<i class="fa fa-tags"></i>Precio<i class="fa fa-bolt"></i>Oferta</small></p>
        </div>
      </div>
      
    </div>
  </div>
</div>

  
</body>
</html>
