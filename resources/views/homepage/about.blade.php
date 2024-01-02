@extends('layout.homepage')

@section ('title', 'About')

@section('Content')

<!-- Intro -->
<section class="section-wrap intro pb-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mb-50">
                <h2 class="intro-heading">about our shop</h2>
                <p>{{$about->deskripsi}}</p>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <span class="result">10</span>
                <p>Years on Global Market.</p>
                <span class="result">45</span>
                <p>Partners are Working With Us.</p>
            </div>
        </div>
        <hr class="mb-0">
    </div>
</section> <!-- end intro -->

      <!-- Our Team -->
      <section class="section-wrap pb-40 our-team">
        <div class="container">

          <div class="row heading-row">
            <div class="col-md-12 text-center">
              <span class="subheading">Who We Are</span>
              <h2 class="heading bottom-line">
                meet our team
              </h2>
            </div>
          </div>

          <div class="row">

            <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
              <div class="team-wrap">
                <div class="team-member">
                  <div class="team-img hover-trigger">
                    <img src="/front/img/candra.jpg" alt="">
                  </div>
                  <div class="team-details text-center">                
                    <h4 class="team-title">Candra Arisma</h4>
                    <span>CEO of Gudang Jersey</span>
                    <div class="social-icons rounded">
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div> 
                  </div>                            
                </div>
              </div>
            </div> <!-- end team member -->

            <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
              <div class="team-wrap">
                <div class="team-member">
                  <div class="team-img hover-trigger">
                    <img src="/front/img/riyo.jpeg" alt="">
                  </div>
                  <div class="team-details text-center">
                    <h4 class="team-title">Riyo Andika</h4>
                    <span>Co-founder</span>
                    <div class="social-icons rounded">
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>                                
                </div>
              </div>
            </div> <!-- end team member -->

            <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
              <div class="team-wrap">
                <div class="team-member">
                  <div class="team-img hover-trigger">
                    <img src="/front/img/indra.jpeg" alt="">
                  </div>
                  <div class="team-details text-center">
                    <h4 class="team-title">Indra Pramana</h4>
                    <span>Marketing Officer</span>
                    <div class="social-icons rounded">
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>                               
                </div>
              </div>
            </div> <!-- end team member -->

            <div class="col-sm-3 col-xs-6 col-xxs-12 mb-40">
              <div class="team-wrap">
                <div class="team-member">
                  <div class="team-img hover-trigger">
                    <img src="/front/img/mike.jpeg" alt="">
                  </div>
                  <div class="team-details text-center">
                    <h4 class="team-title">Michael Suputra</h4>
                    <span>Photographer</span>
                    <div class="social-icons rounded">
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>                               
                </div>
              </div>
            </div> <!-- end team member -->

          </div>

        </div>
      </section> <!-- end our team -->

      <!-- Promo Section -->
      <section class="section-wrap promo-bg" style="background-image:url(/front/img/promo_2_bg.jpg);">
        <div class="container text-center">
          <div class="table-box">
            <h2 class="heading-frame white">The best ideas</h2>
          </div>
        </div>
      </section> <!-- end promo section -->

      <!-- Testimonials -->
      <section class="section-wrap testimonials">
        <div class="container">

          <div class="row heading-row mb-20">
            <div class="col-md-6 col-md-offset-3 text-center">
              <span class="subheading">Hot Customers</span>
              <h2 class="heading bottom-line">Happy Clients</h2>
            </div>
          </div>

          <div id="owl-testimonials" class="owl-carousel owl-theme owl-dark-dots text-center">
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