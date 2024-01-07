@extends('layout.homepage')

@section('Content') 



      <!-- Hero Slider -->
      <section class="hero-wrap text-center relative">
        <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
          @foreach ($sliders as $slider)
          <div class="hero-slide overlay" style="background-image:url(/uploads/{{$slider->gambar}})">
            <div class="container">
              <div class="hero-holder">
                <div class="hero-message">
                  <h1 class="hero-title nocaps">{{$slider->nama_slider}}</h1>
                  <h2 class="hero-subtitle lines">{{$slider->deskripsi}}</h2>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </section> <!-- end hero slider -->

      <!-- Promo Banners -->
      <section class="section-wrap promo-banners pb-30">
        <div class="container">
          <div class="row">

            @foreach ($categories as $category)
            <div class="col-xs-4 col-xxs-12 mb-30 promo-banner">
              <a href="#">
                <img src="/uploads/{{$category->gambar}}" alt="">
                <div class="overlay"></div>
                <div class="promo-inner valign">
                  <h2>{{$category->nama_kategori}}</h2>
                  <span>{{$category->deskripsi}}</span>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </section> <!-- end promo banners -->


      <div class="row items-grid">
            @foreach ($products as $barang)
            <div class="col-md-3 col-xs-6">
                <div class="product-item hover-trigger">
                    <div class="product-img">
                        <a href="/front/shop-single.html">
                            <img src="/uploads/{{$barang->gambar}}" alt="">
                        </a>
                        <div class="hover-overlay">
                            <div class="product-actions">
                                <a href="/front/#" class="product-add-to-wishlist">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                            <div class="product-details valign">
                                <span class="category">
                                    <a
                                        href="/barangs/{{$barang->id_subkategori}}">{{$barang->subcategory->nama_subkategori}}</a>
                                </span>
                                <h3 class="product-title">
                                    <a href="/barang/{{$barang->id}}">{{$barang->namabarang}}</a>
                                </h3>
                                <span class="price">
                                    <ins>
                                        <span class="amount">Rp. {{number_format($barang->harga)}}</span>
                                    </ins>
                                </span>
                                <div class="btn-quickview">
                                    <a href="/barang/{{$barang->id}}" class="btn btn-md btn-color">
                                        <span>More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> <!-- end row -->
    </div>
</section> <!-- end trendy products -->


      <!-- Testimonials -->
      <section class="section-wrap relative testimonials bg-parallax overlay" style="background-image:url(/front/img/testimonials/testimonial_bg.jpg);">
        <div class="container relative">

          <div class="row heading-row mb-20">
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="heading white bottom-line">Happy Clients</h2>
            </div>
          </div>

          <div id="owl-testimonials" class="owl-carousel owl-theme text-center">
            @foreach ($testimonis as $testimoni)
            <div class="item">
              <div class="testimonial">
                <p class="testimonial-text">{{$testimoni->deskripsi}}</p>
                <span>{{$testimoni->nama_testimoni}}</span>
              </div>
            </div>
            @endforeach
          </div>
        </div>

      </section> <!-- end testimonials -->


@endsection