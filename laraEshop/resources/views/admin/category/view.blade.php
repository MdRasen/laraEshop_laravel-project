@extends('layouts.admin')
@section('title', 'laraEshop - View Category')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h4 class="card-title">Categories</h4>
            <p class="card-description">
                Product categories for your store can be managed here.
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Visibility</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td>
                                <img class="table-img" src="{{asset('storage/category_images')}}/{{$item->thumbnail}}"
                                    alt="Category image">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->slug}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->visibility}}</td>
                            <td>
                                <a href="{{route('admin.edit-category', ['category_id'=>$item->id])}}"
                                    class="nav-link btn-inverse-primary">Edit</a>
                            </td>
                            <td>
                                <button type="button" value="{{$item->id}}"
                                    class="nav-link btn-inverse-danger deleteCategoryBtn" data-toggle="modal"
                                    data-target="#deleteCategoryBtn">Delete</button>

                                <!-- Modal -->
                                <div class="modal fade text-center" id="deleteCategoryBtn" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Are you sure you want to delete?</h5>
                                                <form action="{{route('admin.delete-category')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="category_id" name="category_id"
                                                        class="form-control">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.deleteCategoryBtn').click(function (e) {
            e.preventDefault();
            var category_id = $(this).val();
            $('#category_id').val(category_id);
            $('#deleteModal').modal('show');
        });
    });

</script>
@endsection
