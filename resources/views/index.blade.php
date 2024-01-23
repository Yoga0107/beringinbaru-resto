@extends('layout.app')

@section('content')
    {{-- Index page content  --}}

    <!--- Home Section Start ---->
       <section class="home" id="home">

           <div class="swiper home-slider">
               <div class="swiper-wrapper wrapper">
                   <div class="swiper-slide slide">
                       <div class="content">
                           <span>Our Favorite Menu</span>
                           <h3>Sayur Singkong</h3>
                           <p>Sayur singkong dengan rempah pilihan.</p>
                           <a href="#" class="btn">order now</a>
                       </div>
                       <div class="image">
                           <img src="{{asset('images/backgrounds/CouscoBack.png')}}" alt="">
                       </div>
                   </div>

                   <div class="swiper-slide slide">
                        <div class="content">
                            <span>Our Favorite Menu</span>
                            <h3>Rendang</h3>
                            <p> Setiap hidangan Rendang di meja mengundang selera dengan aroma harum dan rasa yang autentik, menjadikannya menu andalan yang selalu dinanti setiap kunjungan.</p>
                            <a href="#" class="btn">order now</a>
                        </div>
                        <div class="image">
                            <img src="{{asset('images/backgrounds/rendang.png')}}" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>Our Favorite Menu</span>
                            <h3>Dendeng</h3>
                            <p>Kita menyajikan dendeng yang gurih dan juga renyah dengan menggunakan rempah pilihan.</p>
                            <a href="#" class="btn">order now</a>
                        </div>
                        <div class="image">
                            <img src="{{asset('images/backgrounds/dendeng.png')}}" alt="">
                        </div>
                    </div>
               </div>

               <div class="swiper-pagination"></div>

           </div>
       </section>


    <!--- Home Section End --->

    @if ($propmenus !== 0)
     @endif


    <!-- About Section Start -->
      <section class="about" id="about">
        <h3 class="sub-heading">about us</h3>
        <h1 class="heading">why choose us?</h1>
        <div class="row">
            <div class="image">
                <img src="{{asset('images/backgrounds/aboutbackk.png')}}" alt="">
            </div>
            <div class="content">
                <h3>Best Restaurant In Town</h3>
                <p>Restoran kami menyediakan berbagai macam menu khas.</p>
                <p>
                    Kami menawarkan pilihan menu yang beragam dan enak.
                </p>
                <div class="icons-container">
                    <div class="icons">
                        <i class="fas fa-dollar-sign"></i>
                        <span>easy payments</span>
                    </div>
                    <div class="icons">
                        <i class="fas fa-headset"></i>
                        <span>24/7 service</span>
                    </div>
                </div>
            </div>
        </div>
      </section>

    <!-- About Section End -->



    <!-- menu Section start-->

     <section class="menu" id="menu">
        <h3 class="sub-heading">our menu</h3>
        <h1 class="heading">today's speciality</h1>
        <div class="box-container">
            @foreach ($menus as $menu)
                 <div class="box">
                    <div class="image">
                        <img src="{{asset('images/menu/'.$menu->image)}}" alt="">
                        <form action="{{route('Jador.store')}}" method="POST">
                            @csrf
                            @if (auth()->user())
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="menu_id" value="{{$menu->id}}">
                            @endif
                            <button type="submit"> <i class="fas fa-heart"></i></button>
                        </form>
                    </div>
                    <div class="content">

                        <h3>{{$menu->title}}</h3>
                        <p>
                            {{$menu->description}}
                        </p>
                        <span class="price">{{$menu->pric}} / Porsi</span>
                        <form action="{{route('cart.add',$menu->id)}}" method="POST">
                            {{--  nsift qte =1 f index  cart --}}
                            <input type="hidden" name="quantity"  value="1">
                            @csrf
                            <button
                            type="submit"
                            class="btn">add to cart</button>
                        </form>

                    </div>
                </div>
            @endforeach


        </div>
     </section>

    <!-- menu section end -->

    <!-- review section start -->
    @if ($reviews->count())
    <section class="review" id="review">
        <h3 class="sub-heading">customer's review</h3>
        <h1 class="heading">what they say</h1>
            <div class="swiper-container review-slider ">
                    <div class="swiper-wrapper">

            @foreach ($reviews as $review)
                     @if ($review->status)
                          <div class="swiper-slide slide">
                                <i class="fas fa-quote-right"></i>
                                <div class="userrev">
                                    @if ($review->user->image === 'image')
                                    <img src="{{asset('images/profile/userImage.png')}}" alt="user-image">
                                    @else
                                    <img src="{{asset('images/profile/'.$review->user->image)}}" alt="user-image">
                                    @endif

                                    <div class="user-info">
                                        <h3>{{$review->user->name}}</h3>
                                    </div>

                                </div>
                                    <p>
                                    {{$review->comment}}
                                    </p>

                            </div>

                     @endif


            @endforeach




           </div>
        </div>
    </section>
     @endif
    <!-- review section end -->

     <!-- Ordre Section start -->
      <div class="review2" id="review2">
        <h3 class="sub-heading">review</h3>
        <h1 class="heading">Add your review about our services</h1>
        <form action="{{route('reviews.store')}}" method="POST">
            @csrf
            <div class="inputBox">
                <div class="input">
                    <span>your review</span>
                    <textarea name="comment" placeholder="entre your review" id="" cols="30" rows="10"></textarea>
                </div>
            </div>

            <input type="submit" value="add your review" class="btn">
        </form>
      </div>

@endsection
