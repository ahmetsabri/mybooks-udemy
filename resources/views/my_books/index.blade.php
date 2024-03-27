<x-app-layout>

<form class="max-w-md mx-auto mt-5" method="GET" action="{{route('dashboard')}}">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input value="{{request()->query('term')}}" type="search" name="term" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ..."  />

        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
  <div class="p-12">

        <div class="flex">
        <a href="{{route('my_books.create')}}" class="text-white capitalize hover:cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        create book
        </a>


        </div>

        @if($books->count() > 0)
        <table class="w-full text-sm text-left rtl:text-right text-gray-500" x-data="{
            deleteBook(url){
                const conifrmation = confirm('Are you sure?')
                if(!conifrmation){
                    return;
                }
                axios.delete(url).
                then(function(res){
                    if(res.status == 204){
                        location.reload()
                    }
                }).catch(function(err){
                    alert('Error')
                    console.log(err)
                })
            }
        }">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        actions
                    </th>

                </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                 <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex space-x-3">
                        @if($book->full_image_url)
                        <img src="{{$book->full_image_url}}" class="w-10 h-10">
                        @endif
                        <h1 class="my-2 text-center font-semibold">
                            <a href="#" class="font-medium   hover:underline text-blue-600">
                               {{$book->title}}
                            </a>

                        </h1>
                    </th>

                    <td class="px-6 py-4">
                        {{$book->created_at->diffForHumans()}}
                    </td>

                    <td class="px-6 py-4 space-x-2">
                        <a href="{{route('my_books.edit',$book)}}" class="font-medium text-blue-600  hover:underline">Edit</a>
                        <button class="font-medium text-red-600  hover:underline" @click="deleteBook(`{{route('my_books.delete', $book)}}`)">Remove</button>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
        @else
        <div class="flex justify-center">
        <h1 class="text-5xl font-bold text-gray-400">
            No Books!
        </h1>
        </div>
        @endif

    </div>
    <div class="flex justify-center pb-10">
        {{$books->links()}}
    </div>

</x-app-layout>
