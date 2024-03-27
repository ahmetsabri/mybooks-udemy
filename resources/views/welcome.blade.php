<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Books</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class=" justify-end  selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
        <div class=" p-6 text-right z-10">
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 ">Dashboard</a>
            @else
            <a href=" {{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 ">Log
                in</a>

            @if (Route::has('register'))
            <a href=" {{ route('register') }}"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 ">Register</a>
            @endif
            @endauth
        </div>
    </div>
    @endif
    <div class="flex justify-center">
        <h2 class="text-4xl font-bold text-indigo-600">
            My Books
        </h2>
    </div>

<form class="max-w-md mx-auto mt-10" method="GET">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input value="{{request()->query('term')}}" type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search books.." name="term" />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Search</button>
    </div>
</form>

    <div class=" flex flex-wrap w-full justify-evenly items-center px-10">
        @foreach($books as $book)
        <div
            class="max-w-xs h-1/6 my-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    @if($book->image_url)
                <img class="rounded-t-lg w-full h-60"  src="{{$book->full_image_url}}" alt="{{$book->title}}" />
    @endif
            <div class="p-5">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{$book->title}}
                </h5>
                <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400 truncate capitalize">
                    Uploaded by : <span class="capitalize text-green-500">
                        {{$book->user->name}}
                    </span>
                </p>
                <a href="{{route('books.show',$book)}}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    show
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-center">
        {{$books->links()}}
    </div>
</body>

</html>
