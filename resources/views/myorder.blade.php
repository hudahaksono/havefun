@section('title', 'My Order')
@include('navbar')
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th colspan="2">Produk</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/savana/savana1.jpg);"></div>
                                </td>
                                <td class="product-name">
                                    <h3>Engagement - Lite</h3>
                                </td>
                                <td class="price">Rp. 5.000.000</td>
                                <td style="color:green;font-weight:bold" class="price">Sudah Dibayarkan</td>
                            </tr>
                            <tr class="text-center">
                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/savana/savana2.jpg);"></div>
                                </td>
                                <td class="product-name">
                                    <h3>Engagement - Lite</h3>
                                </td>
                                <td class="price">Rp. 5.000.000</td>
                                <td style="color:yellow;font-weight:bold" class="price">Menunggu Konfirmasi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('footbar')