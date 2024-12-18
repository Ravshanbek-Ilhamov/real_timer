<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite('resources/js/app.js')
</head>
  <body>



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Messages</h1>

                <nav>
                    <ul>
                        <li><a href="{{ route('messages.index') }}">Messages</a></li>
                        <li><a href="{{ route('workers.index') }}">Workers</a></li>
                    </ul>
                </nav>

                <form action="{{route('messages.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="message">Message</label>
                        <input type="text" name="message" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image_path" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <ul id="messages">
                    @foreach($messages as $message)
                        <li>{{ $message->message }}</li>
                        <img width="150px" src="{{ asset('storage/' . $message->image_path) }}" alt="">
                    @endforeach
                </ul>
            </div>
        </div>
    </div>








    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>