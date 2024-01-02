@extends('layout.homepage')

@section ('title', 'Cart') 

@section('Content')

      <!-- Cart -->
      <section class="section-wrap shopping-cart">
        <div class="container relative">
        <form class="form-keranjang">
        <input type="hidden" name="id_member" value="{{Auth::guard('webmember')->user()->id}}">
          <div class="row">
            <div class="col-md-12">
              <div class="table-wrap mb-30">
                <table class="shop_table cart table">
                  <thead>
                    <tr>
                      <th class="product-name" colspan="2">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th class="product-subtotal" colspan="2">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($keranjangs as $keranjang)
                      <input type="hidden" name="id_produk[]" value="{{$keranjang->barang->id}}">
                      <input type="hidden" name="jumlah[]" value="{{$keranjang->jumlah}}">
                      <input type="hidden" name="size[]" value="{{$keranjang->size}}">
                      <input type="hidden" name="total[]" value="{{$keranjang->total}}">
                      <tr class="cart_item">
                            <td class="product-thumbnail">
                                <a href="#">
                                    <img src="/uploads/{{$keranjang->barang->gambar}}" alt="">
                                </a>
                            </td>
                            <td class="product-name">
                                <a href="#">{{$keranjang->barang->namabarang}}</a>
                                <ul>
                                    <li>Size: {{$keranjang->size}}</li>
                                </ul>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ "Rp. " . number_format($keranjang->barang->harga)}}</span>
                            </td>
                            <td class="product-quantity">
                                <span class="amount">{{ $keranjang->jumlah }}</span>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">{{ "Rp. " . number_format($keranjang->total)}}</span>
                            </td>
                            <td class="product-remove">
                                <a href="/delete_from_keranjang/{{$keranjang->id}}" class="remove"
                                      title="Remove this item">
                                  <i class="ui-close"></i>
                                </a>
                            </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="row mb-50">
                <div class="col-md-5 col-sm-12">
                </div>
                <div class="col-md-7">
                  <div class="actions">
                    <div class="wc-proceed-to-checkout">
                      <a href="/checkout" class="btn btn-lg btn-dark checkout"><span>checkout orders</span></a>
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- end col -->
          </div> <!-- end row -->

          <div class="row">
            <div class="col-md-6 shipping-calculator-form">
              <h2 class="heading relative uppercase bottom-line full-grey mb-30">Calculate Shipping</h2>
              <p class="form-row form-row-wide">
                <select name="provinsi" id="provinsi" class="country_to_state provinsi" rel="calc_shipping_state">
                  <option value="">Provinsi</option>
                      @foreach ($provinsi->rajaongkir->results as $provinsi)
                        <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                      @endforeach
                </select>
              </p>
              <p class="form-row form-row-wide">
                <select name="kota" id="kota" class="country_to_state kota" rel="calc_shipping_state">

                </select>
              </p>

              <div class="row row-10">
                <div class="col-sm-12">
                    <p class="form-row form-row-wide">
                      <input type="text" class="input-text berat" placeholder="Berat (Kilogram)" name="berat" id="Berat">
                    </p>
                </div>
              </div>

              <p>
                <a href="#" name="calc_shipping" class="btn btn-lg btn-stroke mt-10 mb-mdm-40 update-total"style="padding: 20px 40px">
                    Update Total
                </a>
              </p>
            </div> <!-- end col shipping calculator -->

            <div class="col-md-6">
              <div class="cart_totals">
                <h2 class="heading relative bottom-line full-grey uppercase mb-30">Cart Totals</h2>

                <table class="table shop_table">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td>
                                        <span class="amount cart-total">{{$keranjang_total}}</span>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td>
                                        <span class="shipping-cost">0</span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td>
                                        <input type="hidden" name="grand_total" class="grand_total">
                                        <strong><span class="amount grand-total">0</span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end col cart totals -->

            </div> <!-- end row -->
      </form>

    </div> <!-- end container -->
</section> <!-- end cart -->

@endsection

@push('js')
    <script>
        $(function(){
            $('.provinsi').change(function(){
                $.ajax({
                    url : '/get_kota/' + $(this).val(),
                    success : function (data){
                        data = JSON.parse(data)
                        option = ""
                        data.rajaongkir.results.map((kota)=> {
                            option += `<option value=${kota.city_id}>${kota.city_name}</option>`
                        });
                        $('.kota').html(option)
                    }
                });
              });

              $('.update-total').click(function(e){
                e.preventDefault()
                $.ajax({
                    url : '/get_ongkir/' + $('.kota').val() + '/' + $('.berat').val(),
                    success : function (data){
                        data = JSON.parse(data)

                        grandtotal = parseInt(data.rajaongkir.results[0].costs[0].cost[0].value) + parseInt($('.cart-total').text())

                        $('.shipping-cost').text(data.rajaongkir.results[0].costs[0].cost[0].value)
                        $('.grand-total').text(grandtotal)
                        $('.grand_total').val(grandtotal)
                    }
                });
            });

            $('.checkout').click(function(e){
                e.preventDefault()
                $.ajax({
                    url : '/checkout_pesanans',
                    method : 'POST',
                    data : $('.form-keranjang').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success : function(){
                        location.href = '/checkout'
                    }
                })
            })

          });
    </script>
@endpush