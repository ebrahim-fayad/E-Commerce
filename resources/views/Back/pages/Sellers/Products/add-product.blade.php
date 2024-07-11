@extends('Back.layouts.pages-layouts.back-master',['title_page' => 'Seller Add NewProduct'])
@section('title')Seller Add NewProduct @endsection
{{-- @section('home-active')active @endsection --}}
@section('content')
<form action="{{ route('seller.product.create-product') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
    @csrf
    <div class="row pd-10">
        <div class="col-md-8 mb-20">
            <div class="card-box height-100-p pd-20" style="position: relative">
                <div class="form-group">
                    <label for=""><b>Product name:</b></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter product name">
                    @error('name')
                    <span class="text-danger error-text name_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""><b>Product summary:</b></label>
                    <textarea id="summary" name="summary" class="form-control summernote" cols="30" rows="10"></textarea>
                    <span class="text-danger error-text summary_error"></span>
                </div>
                <div class="form-group">
                    <label for=""><b>Product image:</b><small>Must be square and maximum dimension of (1080x1080)</small></label>
                    <input type="file" name="product_image" class="form-control" id="productImageInput">
                    <span class="text-danger error-text product_image_error"></span>
                </div>
                <div class="d-block mb-3" style="max-width: 250px;">
                  <img src="" class="img-thumbnail" id="image-preview" data-ijabo-default-img="">
                </div>
                <b>NB</b>:<small class="text-danger">You will be able to add more images related to this product when you are on edit product page.</small>
            </div>
        </div>
        <div class="col-md-4 mb-20">
            <div class="card-box min-height-200px pd-20 mb-20">
                <div class="form-group">
                    <label for=""><b>Category:</b></label>
                    <select name="category" id="category" class="form-control">
                        <option value="" selected>Not Set</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text category_error"></span>
                </div>

                <div class="form-group">
                    <label for=""><b>Sub Category:</b></label>
                    <select name="subcategory" id="subcategory" class="form-control">
                        <option value="" selected>Not Set</option>
                    </select>
                    <span class="text-danger error-text subcategory_error"></span>
                </div>

            </div>
            <div class="card-box min-height-200px pd-20 mb-20">
                <div class="form-group">
                    <label for=""><b>Price:</b><small>In Dollar Currency ($)</small></label>
                    <input type="text" name="price" class="form-control" placeholder="Eg: 23.99">
                    <span class="text-danger error-text price_error"></span>
                </div>
                <div class="form-group">
                    <label for=""><b>Compare Price:</b><small>Optional</small></label>
                    <input type="text" name="compare_price" class="form-control" placeholder="Eg: 77.99">
                    <span class="text-danger error-text compare_price_error"></span>
                </div>
            </div>
            <div class="card-box min-height-120px pd-20">
               <div class="form-group">
                 <label for=""><b>Visibilty:</b></label>
                 <select name="visibility" id="" class="form-control">
                    <option value="1" selected>Public</option>
                    <option value="0">Private</option>
                 </select>
               </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create product</button>
    </div>
</form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.summernote').summernote({
                height: 300,
                minHeight: 300,
                maxHeight: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            })
        });

        // List sub categories according to the selected category
        $(document).on('change','select#category', function(e){
            e.preventDefault();
            var category_id = $(this).val();
            var url = "{{ route('seller.product.get-product-category') }}";
            if( category_id == '' ){
                $("select#subcategory").find("option").not(":first").remove();
            }else{
                $.get(url,{ category_id:category_id }, function(response){
                   $("select#subcategory").find("option").not(":first").remove();
                   $("select#subcategory").append(response.data);
                },'JSON');
            }
        });

        // Preview selected product image
        document.getElementById('productImageInput').addEventListener('change', function(){
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('image-preview').setAttribute('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Submit product form
        $('#addProductForm').on('submit', function(e){
           e.preventDefault();
           var summary = $('textarea.summernote').summernote('code');
           var form = this;
           var formdata = new FormData(form);
               formdata.append('summary',summary);

           $.ajax({
              url:$(form).attr('action'),
              method:$(form).attr('method'),
              data:formdata,
              processData:false,
              dataType:'json',
              contentType:false,
              beforeSend:function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
              },
              success:function(response){
                  toastr.remove();
                  Livewire.dispatch('refresh');
                  if( response.status == 1 ){
                    $(form)[0].reset();
                    $('textarea.summernote').summernote('code','');
                    $('select#subcategory').find('option').not(':first').remove();
                    $('img#image-preview').attr('src','');
                    toastr.success(response.msg);
                  }else{
                    toastr.error(response.msg);
                  }
              },
              error:function(response){
                toastr.remove();
                $.each( response.responseJSON.errors, function(prefix,val){
                    $(form).find('span.'+prefix+'_error').text(val[0]);
                } );
              }
           });
        });
    </script>
@endpush
