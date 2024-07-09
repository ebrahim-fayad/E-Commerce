<div>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">

                <div class="pull-left">
                    <h4 class="h4 text-blue">Categories</h4>
                </div><!-- pull-left -->
                <div class="pull-right mb-15">
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategory"
                        type="button">
                        <i class="fa fa-plus"></i> Add Category
                    </a>
                </div><!-- pull-right -->
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">

                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Category Image</th>
                                <th>Category Name</th>
                                <th>N. of sub Categories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-bordered-botom-0" id="sortable_categories">
                            @foreach ($categories as $category)
                                <tr data-index="{{ $category->id }}" data-ordering="{{ $category->ordering }}">
                                    <td>
                                        <div class="avatar mr-2">
                                            <img src="{{ asset("images/categories/$category->category_image") }}"
                                                width="50" height="50" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->subCategories->count() }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" class="text-primary" data-toggle="modal"
                                                data-target="#editCategory{{ $category->id }}" type="button"><i
                                                    class="dw dw-edit-2"></i></a>
                                            <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $category->id }}">
                                            <i class="dw dw-delete-3"></i>
                                        </div>
                                    </td>
                                </tr>
                                @include('Back.pages.Admin.Categories.edite-category')
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table -->
                 <div class="d-block mt-2">
                    {{ $categories->links('livewire::simple-bootstrap') }}
                </div>
            </div><!-- end clearfix -->
        </div><!-- end Category -->
        <div class="col-md-12">
            <div class="clearfix">
                <div class="pd-20 card-box mb-30">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Sub Category</h4>
                    </div><!-- pull-left -->
                    <div class="pull-right mb-15">
                        <a href="{{ route('admin.add-sub-categories') }}" class="btn btn-primary btn-sm"
                           >
                            <i class="fa fa-plus"></i> Add Sub-Category
                        </a>
                    </div><!-- pull-right -->
                    <div class="table-responsive mt-4">
                        <table class="table table-borderless table-striped">

                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Sub-Category Name</th>
                                    <th>Category Name</th>
                                    <th>N. of childs Subs.</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered-botom-0" id=sortable_sub_categories>
                                @foreach ($subCategories as $subCategory)
                                <tr data-index="{{ $subCategory->id }}" data-ordering="{{ $subCategory->ordering }}">
                                    <td>{{ $subCategory->subcategory_name }}</td>
                                    <td>{{ $subCategory->category->category_name }}</td>
                                    <td>
                                         @if ( $subCategory->children->count() > 0 )
                                        <ul class="list-group" id="sortable_child_subcategories">
                                            @foreach ($subCategory->children as $child)
                                                <li data-index="{{ $child->id }}" data-ordering="{{ $child->ordering }}" class="d-flex justify-content-between align-items-center">
                                                    - {{ $child->subcategory_name }}
                                                    <div>
                                                        <a href="{{ route('admin.edit-sub-categories', $child->id) }}" class="text-primary" data-toggle="tooltip" title="Edit child sub category">Edit</a>
                                                        |
                                                        <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn" data-toggle="tooltip" title="Delete child sub category" data-id="{{ $child->id }}" data-title="Child Sub Category">Delete</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        None
                                    @endif
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.edit-sub-categories', $subCategory->id) }}" class="text-primary"><i class="dw dw-edit-2"></i></a>
                                            <a href="javascript:;"  class="text-danger deleteSubCategoryBtn" data-id="{{ $subCategory->id }}" data-title="Sub Category">
                                            <i class="dw dw-delete-3"></i>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table -->
                     <div class="d-block mt-2">
                    {{ $subCategories->links('livewire::simple-bootstrap') }}
                </div>
                </div><!-- pd-20 card-box mb-30 -->
            </div><!-- end clearfix -->
        </div><!-- end  Syb-Category -->
    </div><!-- end row -->
</div>
