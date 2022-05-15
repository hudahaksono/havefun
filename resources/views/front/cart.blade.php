@section('title', 'Cart')
@include('layouts.navbar')
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form id="form_chart">
                    <input type="hidden" id="detail_sess_nama" name="detail_sess_nama" value="{{Session('sess_nama')}}">
                    <input type="hidden" id="detail_sess_id" name="detail_sess_id" value="{{Session('sess_id')}}">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Checkout</th>
                                    <th colspan="2">Produk</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $produk)
                                    <tr class="text-center">
                                        <td class="product-remove">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="" name="check_id[]" value="{{$produk->id}}">
                                                <label class="form-check-label" for="flexCheckDefault1"></label>
                                            </div>
                                        </td>

                                        <td class="image-prod">
                                            <div class="img" style="background-image:url(produk/{{$produk->file_name}});"></div>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{$produk->nama}}</h3>
                                        </td>

                                        <td class="price">Rp. {{number_format($produk->harga,0,",",".")}}</td>

                                        <td class="price">{{$produk->qty}}</td>

                                        <td class="total">Rp. {{number_format($produk->qty * $produk->harga,0,",",".")}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="container pt-4">
            <div class="row justify-content-end">
                <p class="text-center"><a href="javascript:void(0)" id="btn_payment" class="btn btn-primary py-3 px-4"><i class="fa-solid fa-dollar-sign"></i> Checkout To Payment</a></p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')
<script>
    $('.total_chart').html('{{$total_chart}}');
    $(document).ready(function() {
        $('#btn_payment').click(function(event) {
            $.ajax({
                type: "post",
                url: "{{route('api.fr.payment.store.order')}}",
                data: $("#form_chart").serialize(),
                success: function(response) {
                    for (var key in response) {
                        var flag = response["success"];
                        var message = response["message"];
                        var no_order = response["no_order"];
                    }
                    
                    // url = "{{route('f-payment', ['no_order' => '" + no_order + "'])}}";
                    url = "/payment?no_order=" + no_order;
                    if ($.trim(flag) == "true") {
                        window.location = url;
                    }else{
                        swal('Peringatan!', message, {
                            icon: 'warning',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-info'
                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>