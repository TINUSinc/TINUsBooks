
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <!-- Controles del carrusel de inicio -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald:500" rel="stylesheet">
    <script>!function(e){"undefined"==typeof module?this.charming=e:module.exports=e}(function(e,n){"use strict";n=n||{};var t=n.tagName||"span",o=null!=n.classPrefix?n.classPrefix:"char",r=1,a=function(e){for(var n=e.parentNode,a=e.nodeValue,c=a.length,l=-1;++l<c;){var d=document.createElement(t);o&&(d.className=o+r,r++),d.appendChild(document.createTextNode(a[l])),n.insertBefore(d,e)}n.removeChild(e)};return function c(e){for(var n=[].slice.call(e.childNodes),t=n.length,o=-1;++o<t;)c(n[o]);e.nodeType===Node.TEXT_NODE&&a(e)}(e),e});
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    
    <!-- Controles del carrusel de productos  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<section>
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
            delay: 3000,
            pagination: {
              duration: 3,
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
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Items del carrusel  -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"> <strike>$400.00</strike> <span>$369.00</span></p>
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$25.00</strike> <span>$23.99</span></p>

									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>		
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$899.00</strike> <span>$649.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>								
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$315.00</strike> <span>$250.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-item">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$289.00</strike> <span>$269.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$1099.00</strike> <span>$869.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$109.00</strike> <span>$99.00</span></p>
									
									<a href="#" class="btn btn-primary">Add to Cart</a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$599.00</strike> <span>$569.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>						
					</div>
				</div>
				<div class="carousel-item">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="libro.jpg" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$369.00</strike> <span>$349.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="/examples/images/products/canon.jpg" class="img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$315.00</strike> <span>$250.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="/examples/images/products/pixel.jpg" class="img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$450.00</strike> <span>$418.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>	
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="/examples/images/products/watch.jpg" class="img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4> Producto </h4>
									<p class="item-price"><strike>$350.00</strike> <span>$330.00</span></p>
									
									<a href="#" class="btn btn-primary"> Agregar al carrito </a>
								</div>						
							</div>
						</div>
					</div>
				</div>
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
    <h2 style="font: size 50px;">Explora</h2>
</section>
<section class="descuento">
    <img class="zoom" src="media/indexmedia/linear2.jpg" alt="">
    <h2 style="font-size:50px; text-shadow: 2cm">Tus nuevos generos favoritos</h2>
</section>

<!--  cards stickers -->
<h2 style="color: white;">Fomentemos la lectura</h2>
<div class="containercards bootstrap snippets bootdeys">
<div class="row" style="align-content: center; padding-left: 70px"><div class="col-md-4 col-sm-6 content-cards">
        <div class="cards-big-shadow">
            <div class="cards cards-just-text" data-background="color" data-color="blue" data-radius="none">
                <div class="content">
                    <h6 class="category">Beneficios</h6>
                    <h4 class="title">¿Por qué Leer?</h4>
                    <p class="description">La lectura permite escapar de las tensiones cotidianas, bajar el estrés, desarrollar habilidades cognitivas, activa la memoria a corto y largo plazo y nos ayuda a expandir nuestro vocabulario</p>
                </div>
            </div> <!-- end card -->
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 content-cards">
        <div class="cards-big-shadow">
            <div class="cards cards-just-text" data-background="color" data-color="green" data-radius="none">
                <div class="content">
                    <h6 class="category">Nuestros principios</h6>
                    <h4 class="title">Sobre la calidad de TINU's</h4>
                    <p class="description"> Creemos que ofrecer un servicio de calidad no es algo que debe ser visto solo como una estrategia o área de la empresa, sino como una cultura organizacional.</p>
                </div>
            </div> <!-- end card -->
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 content-cards">
        <div class="cards-big-shadow">
            <div class="cards cards-just-text" data-background="color" data-color="yellow" data-radius="none">
                <div class="content">
                    <h6 class="category">Accesibilidad</h6>
                    <h4 class="title">Libros al alcance de todos</h4>
                    <p class="description">Nuestros precios son forjados en criterios objetivos que no solo atienden al balance de ganancias sino a una proyección mejorable del valor en términos equitativos.</p>
                </div>
            </div> <!-- end card -->
        </div>
    </div>
</div>
</div>

<!-- Animacion 3d de origenes  --> 
<section class="origenes">
    <div class="container">
	<div class="front side">
		<div class="content">
			<h1>Nuestros orígenes</h1>
			<p>Nuestro nombre es TINU's Books y somos una tienda online que marca tendencias, ofreciendo productos de primer nivel y un servicio al cliente excepcional que los compradores podrán obtener desde la comodidad de su hogar. Somos un negocio compuesto por personas innovadoras que siempre miran a futuro. Tenemos el impulso y los medios para actualizar y mejorar constantemente la experiencia de tu compra en línea.
			</p>
		</div>
	</div>
	<div class="back side">
		<div class="content">
			<h1>Sobre nuestros productos</h1>
			<p>Nuestra tienda virtual es sinónimo de calidad, por lo que te garantizamos contar con la mayor variedad de mercancía así como de productos temporales o de edición limitada que se adaptan a cualquier presupuesto. Echa un vistazo y empieza a comprar hoy mismo.
			</p>
		</div>
	</div>
</div>
</section>
<!-- Termina animacion 3d de origenes  --> 

<!-- Barra descuento  --> 
<section class="descuento">
    <img src="media/indexmedia/descuentofondo.jpg" alt="">
    <p>- Aprovecha nuestros descuentos -</p>
    <h2>¡Obten 20% en toda la tienda!</h2>
    <h5>Código: apertura20</h5>
</section>
<!-- Termina barra descuento  --> 

<!-- Mapa --> 
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3702.233231530003!2d-102.29467398539583!3d21.887092785539757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429ee6733bab0cb%3A0x64f5f203073c9e2a!2sCalle%20Gral.%20Ignacio%20Zaragoza%2C%20Zona%20Centro%2C%20Aguascalientes%2C%20Ags.!5e0!3m2!1ses-419!2smx!4v1670296660311!5m2!1ses-419!2smx" width="1500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Termina mapa -->


</body>
</html>