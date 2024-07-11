 <div class="product-wrap ">
        <div class="product-list ">
            <ul class="row">
                @forelse ($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-12  p-2">
                    <div class="product-box">
                        <div class="producct-img">
                            <img src="{{$product->product_image  }}" alt="">
                        </div>
                        <div class="product-caption">
                            <h4><a href="#">{{ $product->name }}</a></h4>
                            <div class="price">
                                @if ($product->compare_price)
                                <del>${{ $product->compare_price }}</del>
                                @endif
                                <ins>${{ $product->price }}</ins>
                                </div>
                                <div class="btn-group">
                                    <a href="" class="btn btn-outline-primary btn-sm">Edit</a>
                                    <a href="" class="btn btn-outline-danger btn-sm">Delete</a>
                                </div>
                        </div>
                    </div>
                </li>
                @empty

                @endforelse
            </ul>
        </div>
        <div class="blog-pagination mb-30">
            <div class="btn-toolbar justify-content-center mb-15">
                <div class="btn-group">
                    {{ $products->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
    </div>
