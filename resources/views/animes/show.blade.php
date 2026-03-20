<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Anime Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Anime ID</th>
                                <td>{{ $anime->mal_id }}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>{{ $anime->image_url }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $anime->title }}</td>
                            </tr>
                            <tr>
                                <th>Score</th>
                                <td>{{ $anime->score }}</td>
                            </tr>
                            <tr>
                                <th>Episodes</th>
                                <td>{{ $anime->episodes }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $anime->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $anime->updated_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('animes.index') }}" class="btn btn-secondary">Back to List</a>
                            <div>
                                <a href="{{ route('animes.edit', $anime->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('animes.destroy', $anime->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this anime?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
