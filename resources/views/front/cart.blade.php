@section('title', 'Cart')
@include('layouts.navbar')
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
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
                            <tr class="text-center">
                                <td class="product-remove">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="">
                                        <label class="form-check-label" for="flexCheckDefault1"></label>
                                    </div>
                                </td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/savana/savana2.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Engagement - Lite</h3>
                                </td>

                                <td class="price">Rp. 5.000.000</td>

                                <td class="price">1</td>

                                <td class="total">Rp. 5.000.000</td>
                            </tr>

                            <tr class="text-center">
                                <td class="product-remove">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="">
                                        <label class="form-check-label" for="flexCheckDefault1"></label>
                                    </div>
                                </td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/savana/savana1.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Akad Intimate - Stepa</h3>
                                </td>

                                <td class="price">Rp. 15.000.000</td>

                                <td class="price">1</td>

                                <td class="total">Rp. 15.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container pt-4">
            <div class="row justify-content-end">
                <p class="text-center"><a href="/payment" class="btn btn-primary py-3 px-4"><i class="fa-solid fa-dollar-sign"></i> Checkout To Payment</a></p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')