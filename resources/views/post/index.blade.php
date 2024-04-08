<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Date picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        .action-btns {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-sm-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <form action="{{ route('post.index') }}" method="GET" class="d-flex">
                                <input type="text" name="date" id="datepicker" class="form-control" placeholder="Select date">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h2 class="text-center mb-4">View Posts</h2>
                    </div>
                    <div class="col-sm-3 text-right">
                        <a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>
                    </div>
                </div>
            

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Categories</th>
                        <th>Created At</th>
                        <th class="action-btns">Actions</th>
                    </tr>
                </thead>
                <tbody id="postTableBody">
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            @foreach($post->categories as $category)
                            <span class="badge badge-primary">{{ $category->title }}</span>
                            @endforeach
                        </td>
                        <td>{{ $post->created_at->format('M d, Y h:i A') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-primary mr-1">Edit</a>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4 clear-fix">
                {{ $posts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        
    });
</script>


</html>