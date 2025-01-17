@extends('Back.layouts.pages-layouts.back-master', ['title_page' => 'Categories'])
@section('title')
    Admin Categories Page
@endsection
@section('categories-active')
    active
@endsection
@section('content')
    @include('Flash-messages.flash', ['type' => 'success'])
    @include('Flash-messages.flash', ['type' => 'error'])
    @livewire('admin.categories.category-list')
    <!-- Add Category Modal -->
    @include('Back.pages.Admin.Categories.add-category')
@endsection
@push('scripts')
    <script>
        $('table tbody#sortable_categories').sortable({
           cursor: "move",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr("data-ordering") != (index + 1)) {
                        $(this).attr("data-ordering", (index + 1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function() {
                    positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                Livewire.dispatch("updateCategoriesOrdering", [positions]);
            }
        });
        $('table tbody#sortable_sub_categories').sortable({
            cursor: "move",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr("data-ordering") != (index + 1)) {
                        $(this).attr("data-ordering", (index + 1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function() {
                    positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                Livewire.dispatch("updateSubCategoriesOrdering", [positions]);
            }
        });
         $('ul#sortable_child_subcategories').sortable({
            cursor:"move",
            update:function(event, ui){
                $(this).children().each(function(index){
                    if( $(this).attr("data-ordering") != (index+1) ){
                        $(this).attr("data-ordering",(index+1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function(){
                    positions.push([$(this).attr("data-index"),$(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                //   alert(positions);
                Livewire.dispatch("updateChildSubCategoriesOrdering",[positions]);
            }
        });
          $(document).on('click','.deleteCategoryBtn', function(e){
            e.preventDefault();
            var categoryId = $(this).data('id');
            swal.fire({
                title:'Are you sure?',
                html:'You want to delete this category',
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                confirmButtonText:'Yes, Delete',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false
            }).then(function(result){
                if(result.value){
                    Livewire.dispatch('deleteCategory',[categoryId]);
                }
            });
        });
          $(document).on('click','.deleteSubCategoryBtn,.deleteChildSubCategoryBtn', function(e){
             e.preventDefault();
             var subcategory_id = $(this).data("id");
             var title = $(this).data("title");
             swal.fire({
                title:'Are you sure?',
                html:'You want to delete this <b>'+title+'</b>',
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                confirmButtonText:'Yes, Delete',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false
             }).then(function(result){
                 if( result.value ){
                    Livewire.dispatch("deleteSubCategory",[subcategory_id]);
                 }
             });
        });
    </script>
@endpush
