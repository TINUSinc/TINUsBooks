<?php include('sources/header.php');
  if(isset($_SESSION["usuario"]) && isset($_POST["Id_Prod"])){
    agregarCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"],1);
  }
  if(isset($_POST["Suscripcion"])){
    $mensaje = '
      <h1 style="text-align: center;">TIINU´S BOOKS</h1>
      <h5 style="text-align: center;">Bienvendio a nuestro boletín, recibirás las últimas noticias y ofertas de nuestra página</h5>
      <p style="text-align: center;">Para que inicies tu viaje en la lectura utiliza el sigueinte cupón en tu compra: </p>
      <h4 style="text-align: center;">Cupón: SUS10</h4>
      <p style="text-align: center;">-Gracias por tu preferenca, TinusBooks.</p>
    ';
    $enviado=0;
    if(crearEmailNoOutput("Suscripción TINUSBOOKS", $mensaje, $_POST["correoSuscripcion"])){
      $enviado = 1;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    
    <!-- Controles del carrusel de inicio -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald:500" rel="stylesheet">
    <script>!function(e){"undefined"==typeof module?this.charming=e:module.exports=e}(function(e,n){"use strict";n=n||{};var t=n.tagName||"span",o=null!=n.classPrefix?n.classPrefix:"char",r=1,a=function(e){for(var n=e.parentNode,a=e.nodeValue,c=a.length,l=-1;++l<c;){var d=document.createElement(t);o&&(d.className=o+r,r++),d.appendChild(document.createTextNode(a[l])),n.insertBefore(d,e)}n.removeChild(e)};return function c(e){for(var n=[].slice.call(e.childNodes),t=n.length,o=-1;++o<t;)c(n[o]);e.nodeType===Node.TEXT_NODE&&a(e)}(e),e});</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    
    <!-- Controles del carrusel de productos  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/estilos.css">

</head> 
<body>
<section id="swiper1">
  <div class="swiper-container slideshow">
    <div class="swiper-wrapper">
      <div class="swiper-slide slide">
        <div class="slide-image" style="background-image: url(media/indexmedia/libro.jpg)"></div>
        <span class="slide-title">TINU´s Books</span>
      </div>

      <div class="swiper-slide slide">
        <div class="slide-image" style="background-image: url(media/indexmedia/libro1.jpeg)"></div>
        <span class="slide-title">La magia, hecha libros</span>
      </div>

      <div class="swiper-slide slide">
        <div class="slide-image" style="background-image: url(media/indexmedia/libro3.jpeg)"></div>
        <span class="slide-title">Conócenos</span>
      </div>
    </div>

    <div class="slideshow-pagination"></div>

    <div class="slideshow-navigation">
      <div class="slideshow-navigation-button prev"><span class="fas fa-chevron-left"></span></div>
      <div class="slideshow-navigation-button next"><span class="fas fa-chevron-right"></span></div>
    </div>
  </div>

</section>
<script>
class Slideshow {
    constructor(el) {
        this.DOM = {el: el};
        this.config = {
          slideshow: {
            delay: 5000,
            pagination: {
              duration: 5,
            }
          }
        };
        this.init();
    }
    init() {
      var self = this;
      this.DOM.slideTitle = this.DOM.el.querySelectorAll('.slide-title');
      this.DOM.slideTitle.forEach((slideTitle) => {
        charming(slideTitle);
      });
      this.slideshow = new Swiper (this.DOM.el, {
          
          loop: true,
          autoplay: {
            delay: this.config.slideshow.delay,
            disableOnInteraction: false,
          },
          speed: 500,
          preloadImages: true,
          updateOnImagesReady: true,
          pagination: {
            el: '.slideshow-pagination',
            clickable: true,
            bulletClass: 'slideshow-pagination-item',
            bulletActiveClass: 'active',
            clickableClass: 'slideshow-pagination-clickable',
            modifierClass: 'slideshow-pagination-',
            renderBullet: function (index, className) {
              
              var slideIndex = index,
                  number = (index <= 8) ? '0' + (slideIndex + 1) : (slideIndex + 1);
              
              var paginationItem = '<span class="slideshow-pagination-item">';
              paginationItem += '<span class="pagination-number">' + number + '</span>';
              paginationItem = (index <= 8) ? paginationItem + '<span class="pagination-separator"><span class="pagination-separator-loader"></span></span>' : paginationItem;
              paginationItem += '</span>';
            
              return paginationItem;
              
            },
          },//navegacion
          navigation: {
            nextEl: '.slideshow-navigation-button.next',
            prevEl: '.slideshow-navigation-button.prev',
          },//scrollbar
          scrollbar: {
            el: '.swiper-scrollbar',
          },
          on: {
            init: function() {
              self.animate('next');
            },
          }
        });//eventos init
        this.initEvents(); 
    }
    initEvents() {
        this.slideshow.on('paginationUpdate', (swiper, paginationEl) => this.animatePagination(swiper, paginationEl));
        //this.slideshow.on('paginationRender', (swiper, paginationEl) => this.animatePagination());
        this.slideshow.on('slideNextTransitionStart', () => this.animate('next'));
        this.slideshow.on('slidePrevTransitionStart', () => this.animate('prev'));
    }
    animate(direction = 'next') {
        this.DOM.activeSlide = this.DOM.el.querySelector('.swiper-slide-active'),
        this.DOM.activeSlideImg = this.DOM.activeSlide.querySelector('.slide-image'),
        this.DOM.activeSlideTitle = this.DOM.activeSlide.querySelector('.slide-title'),
        this.DOM.activeSlideTitleLetters = this.DOM.activeSlideTitle.querySelectorAll('span');
        this.DOM.activeSlideTitleLetters = direction === "next" ? this.DOM.activeSlideTitleLetters : [].slice.call(this.DOM.activeSlideTitleLetters).reverse();
        this.DOM.oldSlide = direction === "next" ? this.DOM.el.querySelector('.swiper-slide-prev') : this.DOM.el.querySelector('.swiper-slide-next');
        if (this.DOM.oldSlide) {
          this.DOM.oldSlideTitle = this.DOM.oldSlide.querySelector('.slide-title'),
          this.DOM.oldSlideTitleLetters = this.DOM.oldSlideTitle.querySelectorAll('span'); 
          this.DOM.oldSlideTitleLetters.forEach((letter,pos) => {
            TweenMax.to(letter, .3, {
              ease: Quart.easeIn,
              delay: (this.DOM.oldSlideTitleLetters.length-pos-1)*.04,
              y: '50%',
              opacity: 0
            });
          });
        }
        this.DOM.activeSlideTitleLetters.forEach((letter,pos) => {
					TweenMax.to(letter, .6, {
						ease: Back.easeOut,
						delay: pos*.05,
						startAt: {y: '50%', opacity: 0},
						y: '0%',
						opacity: 1
					});
				});
        //animacion de la img de fondo
        TweenMax.to(this.DOM.activeSlideImg, 1.5, {
            ease: Expo.easeOut,
            startAt: {x: direction === 'next' ? 200 : -200},
            x: 0,
        });
    }
    animatePagination(swiper, paginationEl) {//inicio de las letras animadas 
      this.DOM.paginationItemsLoader = paginationEl.querySelectorAll('.pagination-separator-loader');
      this.DOM.activePaginationItem = paginationEl.querySelector('.slideshow-pagination-item.active');
      this.DOM.activePaginationItemLoader = this.DOM.activePaginationItem.querySelector('.pagination-separator-loader');
      console.log(swiper.pagination);
        TweenMax.set(this.DOM.paginationItemsLoader, {scaleX: 0});
        TweenMax.to(this.DOM.activePaginationItemLoader, this.config.slideshow.pagination.duration, {
          startAt: {scaleX: 0},
          scaleX: 1,
        });
    }    
}
const slideshow = new Slideshow(document.querySelector('.slideshow'));
</script>
 
  
<!-- Carrusel de productos  --> 
<div class="container2">
	<div class="row">
		<div class="col-md-12">
			<h2>Productos <b>Recomendados</b> </h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
				<!-- Carrusel -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>   
				<!-- Items del carrusel  -->
				<div class="carousel-inner">
					<?php 
						$productos = getProductos();
						$leng = count($productos);
						$cont = 0;
						shuffle($productos);
						foreach($productos as $producto):
							if($cont == 8) break;
							if($cont%4 == 0):
					?>
					<div class="carousel-item <?php if($cont==0) echo "active"; ?>">
						<div class="row">
							<?php 
								endif;
								$cont++; 
							?>
							<div class="col-12 col-sm-6 col-md-3">
								<div class="thumb-wrapper">
									<div class="img-box">
                    <a href="/sources/Paginas/productosIndivual.php?id=<?php echo $producto["ID_Prod"]?>">
                      <img src="/media/productos/<?php echo $producto["Imagenes"][1]?>" alt="<?php echo $producto["Imagenes"][1]?>">
                    </a>
									</div>
									<div class="thumb-content">
                    <a style="text-decoration: none; color: white;" href="/sources/Paginas/productosIndivual.php?id=<?php echo $producto["ID_Prod"]?>">
                      <h4> <?php echo $producto["Nombre_Prod"]?> </h4>
                    </a>
										<p class="item-price"><?php if($producto["Descuento_Prod"]>0):?><strike>$<?php echo $producto["Precio_Prod"]?></strike><?php endif; ?><span>$<?php echo number_format($producto["Precio_Prod"]-($producto["Precio_Prod"]*$producto["Descuento_Prod"]*0.01),2)?></span></p>
										<?php if(isset($_SESSION["usuario"])){
											$disponibilidad = "";
											$texto=" Agregar al carrito";
											if($producto["Existencias_Prod"] == 0){
												$disponibilidad = "disabled";
												$texto = " Sin inventario";
											}
											echo '
												<form method="POST" action="'.$_SERVER["PHP_SELF"].'">
													<input type="hidden" name="Id_Prod" value="'.$producto["ID_Prod"].'">
													<button '.$disponibilidad.' class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i>'.$texto.'</button>
												</form>
												';
											}else{
											echo '
												<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalIniciar"><i class="fas fa-shopping-cart"></i> Inicie sesión</button>
											';
											}
										?> 
									</div>						
								</div>
							</div>
						<?php if($cont%4 == 0): ?>
						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<?php if($cont < 8 && $cont != 4): ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<!-- Controles del carrusel -->
				<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control-next" href="#myCarousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<!-- Termina arrusel de productos  --> 
<section class="descuento">
    <img class="zoom"src="media/indexmedia/linear1.jpg" alt="">
    <h2 class="explora">Explora</h2>
</section>
<section class="descuento">
    <img class="zoom" src="media/indexmedia/linear2.jpg" alt="">
    <h2 class="generos">Tus nuevos generos favoritos</h2>
</section>
<!-- Cuadro de texto e imagen  --> 
<section class="cuadro">
	<img src="media/indexmedia/lector1.jpg" style="float:left;" alt="Foto de Ejemplo"/>
	<div id="cuadrotexto">
		<h3> Nuestros origenes </h3>
		<p> Nuestro nombre es TINU's Books y somos una tienda online que marca tendencias, ofreciendo productos de primer nivel y un servicio al cliente excepcional que los compradores podrán obtener desde la comodidad de su hogar. Somos un negocio compuesto por personas innovadoras que siempre miran a futuro. Tenemos el impulso y los medios para actualizar y mejorar constantemente la experiencia de tu compra en línea. </p>
		<p> Nuestra tienda virtual es sinónimo de calidad, por lo que te garantizamos contar con la mayor variedad de mercancía así como de productos temporales o de edición limitada que se adaptan a cualquier presupuesto. Echa un vistazo y empieza a comprar hoy mismo. </p>
	</div>
</section>

<!-- Animacion 3d de origenes  --> 
<section class="origenes">
    <div class="container">
		<div class="front side">
			<div class="content">
				<h1> Fomentamos la lectura </h1>
				<p>Los libros son un recurso imprescindible para nuestro proceso formativo, les permiten imaginar, descubrir, viajar y conocer sobre el mundo que los rodea.
				 Explora todo tipo de generos, disfrutando de una calidad y un precio accesible.</p>
				<p></p>
			</div>
		</div>
		<div class="back side">
			<div class="content">
				<h1> Nuestra filosofía</h1>
				<p>
					La lectura es una de las piedras angulares para la adquisición de conocimiento. Leer, la lectura, es una de las mejores habilidades que podemos adquirir. Ella nos acompañará a lo largo de nuestras vidas y permitirá que adquiramos conocimiento, y que entendamos el mundo y todo lo que nos rodea.
				</p>
			</div>
		</div>
	</div>
</section>
<!-- Termina animacion 3d de origenes  --> 

<!-- Barra descuento  --> 
<section class="newsletter">
  <div class="container7">
    <div class="row7">
      <div class="col-sm-12">
        <div class="content">
          <h2> SUSCRIBETE AQUÍ </h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="input-group">
              <input required type="email" class="form-control" name="correoSuscripcion" placeholder="Ingresa tu email">
              <span class="input-group-btn">
                <button class="btn" name="Suscripcion" type="submit"> Suscribirse </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Termina barra descuento  --> 

<!-- Mapa --> 
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3702.233231530003!2d-102.29467398539583!3d21.887092785539757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429ee6733bab0cb%3A0x64f5f203073c9e2a!2sCalle%20Gral.%20Ignacio%20Zaragoza%2C%20Zona%20Centro%2C%20Aguascalientes%2C%20Ags.!5e0!3m2!1ses-419!2smx!4v1670296660311!5m2!1ses-419!2smx" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Termina mapa -->
  <?php if(isset($_SESSION["usuario"])): ?>
    <script>
        document.getElementById("carritoCant").innerText = <?php echo getTotalProdCarrito($_SESSION["usuario"]["ID_Usr"]) ?>;
    </script>
  <?php endif ?>
  <?php if(isset($_POST["Suscripcion"])): ?>
    <?php if($enviado): ?>
      <script>swal("Suscripción", "Te hemos enviado un correo de confirmación","success");</script>
      <?php else: ?>
      <script>swal("Suscripción", "Ha ocurrido un error al enviar la confirmación","error");</script>
    <?php endif ?>
  <?php endif ?>
</body>
</html>
<?php
    include_once("sources/PHP/footer.php");
?>
