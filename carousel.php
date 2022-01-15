
<div class="container text-center px-0" style="max-width:97%; min-width:97%;">
    <div class="row mx-auto my-auto justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            
        <div class="carousel-inner" role="listbox"><!--carousel inner starts-->     
            <div class="carousel-item active">
                 <div class="card">
               
<img src="assets/img/welcome.png" alt=".">

<div class="messageAdvertisement"> <p>The platform is here to let you market yourself. what are you waiting for?</p>
<p>You are the next big thing!. Terms and Conditions apply</p>

<a href="login.php"><i class="fa fa-sign-out"> Go to Myaccount</i></a>
</div>

                </div>
                </div>

                <div class="carousel-item">
                 <div class="card">
                <h1>This is my slide 2</h1>
                </div>
                </div>


                <div class="carousel-item">
                 <div class="card">
                <h1>This is my slide 3</h1>
                </div>
                </div>


              <div class="carousel-item">
                 <div class="card">
                <h1>This is my slide 4</h1>
                </div>
                </div>


              <div class="carousel-item">
                 <div class="card">
                <h1>This is my slide 5</h1>
                </div>
                </div>


                <div class="carousel-item">
                <div class="card">
                <h1>This is my slide 6</h1>         
                </div>
                </div>

            </div><!--carouse;l inner ends-->

  <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
  <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span>
  </a>
  
  <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
  <span class="fa fa-arrow-circle-o-right" aria-hidden="true"></span>
  </a>
</div>
</div>
</div>

<script>
  let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
    const minPerSlide = 3
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
        	next = items[0]
      	}
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})
</script>






/*-------------------------------------------------------
the carousel on index page
--------------------------------------------------------*/
  .carousel-inner .carousel-item.active,
  .carousel-inner .carousel-item-next,
  .carousel-inner .carousel-item-prev {
      display: flex;
}


.carousel span{
  color: #27AE60 !important;
  font-size: 30px;
  }
  .carousel span:hover{
    color: black !important;
    font-size: 32px;
  }

.carousel-item h1{
  color: red !important;
}

.card img{
  height:80px;
  width: 80px;
  border: 1px solid gainsboro;
  border-radius: 50%;
  background: url(../img/defaultimage.jpg);
  background-size: contain;
  margin-left: 60px;
}

.messageAdvertisement{
  padding: 5px;
  width: 95%;
  margin: auto;
}
.messageAdvertisement p{
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.carousel-item>div{
  width:410px;
  background-color: ghostwhite !important;
  height: 210px;
  margin-right: 20px;
  border-radius: 15px !important;
  border: 1px solid whitesmoke;
}



/*on tabs */
  @media (max-width: 767px) {
    .carousel-inner .carousel-item > div {
        display: none;
    }
    .carousel-inner .carousel-item > div:first-child {
        display: block;
    }
}

/*on mobiles*/
@media (max-width: 500px){
  .carousel-inner .carousel-item > div:first-child {
 max-width: 100% !important;  
}
}

@media (max-width: 320px){
  .carousel-item {
    width: 100%;
    min-width:295px !important;
  }
}