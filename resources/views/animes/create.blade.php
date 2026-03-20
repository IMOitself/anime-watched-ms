<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="display: flex; flex-direction: row; align-items: center;">
                        <h3 style="flex: 1">Add New Anime</h3>
                         <!-- refresh to search for anime :D -->
                        <input type="text" id="search" value="{{$anime->title}}">
                        <a href="{{ route('animes.create') }}" class="btn btn-secondary" 
                           onclick="this.href += '?search=' + document.getElementById('search').value; this.classList.add('disabled');">
                            Search
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('animes.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mal_id" value="{{$anime->mal_id}}">
                            <input type="hidden" name="image_url" value="{{$anime->image_url}}">
                            <input type="hidden" name="title" value="{{$anime->title}}">
                            <input type="hidden" name="score" value="{{$anime->score}}">
                            <input type="hidden" name="episodes" value="{{$anime->episodes}}">

                            <div style='align-items: center; text-align: center; font-family: sans-serif; padding: 50px;'>
                                <img src='{{$anime->image_url}}' style='height: 200px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);'>
                                <h3>{{$anime->title}}</h3>
                                <p>⭐{{$anime->score}} | {{$anime->episodes}} episodes</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('animes.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('animes.create') }}" class="btn btn-secondary" onclick="this.classList.add('disabled'); this.innerText='Rolling...';">
                                    Roll Random Anime
                                </a>
                                <button type="submit" class="btn btn-primary">Add Anime</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
