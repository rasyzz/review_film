<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trailler</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-900">
    @include('navbar-subscriber.navbar')
    <div class="flex items-center justify-between mt-50 bg-gray-900">
        <!-- Judul Movies -->
        <h2 class="text-2xl text-left ml-8 text-white font-bold inline-block bg-blue-950 rounded-lg p-2">
            Trailler
        </h2>
    </div>
    <div class="container-2 bg-gray-900 p-8 grid grid-cols-3 gap-5 justify-center">
        @foreach ($films as $item)
            <div class="bg-blue-950 rounded-lg p-4 shadow-lg">
                <div class="relative bg-black rounded-lg overflow-hidden">
                    <video id="trailerVideo-{{ $item->id }}" controls class="w-full h-60 object-cover rounded-lg"
                        poster="{{ asset('storage/' . $item->poster) }}">
                        <source src="{{ asset('storage/' . $item->trailer) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <p class="mt-2 text-center font-semibold text-white">{{ $item->title }}</p>
            </div>
        @endforeach
    </div>
    @include('footer-all.footer')
</body>

</html>
