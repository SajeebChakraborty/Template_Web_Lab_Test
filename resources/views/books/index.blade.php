<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Books CRUD</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script src="{{ asset('assets/css/script.js') }}"></script>

</head>
<body>
    <a href="{{ route('/add-book') }}" style="float:left;text-decoration:none;padding:15px;margin-left:300px;margin-top:20px;" class="btn btn-primary"> + Add Books</a>
    <a href="{{ route('/generate-pdf') }}" style="float:left;text-decoration:none;padding:15px;margin-left:10px;margin-top:20px;" class="btn btn-warning">Generate PDF</a>
    <br>
    <br>
    <br>
@if(Session::has('success'))
    <br>
    <div style="text-align:center;background-color:aqua;padding:10px 10px 5px 10px;">
        <p>{{ Session::get('success') }}</p>
    </div>
    <br>
@endif

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Book <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <form method="get" action="{{ route('/search-book')}}">
                            @csrf
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" name="name" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>ISBN</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            <a href="{{ route('/book-details',['id'=> $book->id]) }}"" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="{{ route('/edit-book',['id'=> $book->id]) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="{{ route('/delete-book',['id'=> $book->id]) }}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $books->links() }}
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
