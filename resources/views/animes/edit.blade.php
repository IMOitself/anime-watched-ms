<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Anime</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('animes.update', $anime->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="anime_id" value="{{$anime->anime_id}}">
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
                                <!-- refresh and roll anime :D -->
                                <a href="{{ route('animes.edit', ['anime' => $anime->id, 'roll' => 1]) }}" class="btn btn-primary" onclick="this.classList.add('disabled'); this.innerText='Rolling...';">
                                    Roll Random Anime
                                </a>
                                <button type="submit" class="btn btn-primary">Update Anime</button>
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
