<x-app-layout>

    <div class="py-12" x-data="{

        isAlreadyLiked:`{{$isAlreadyLiked}}`,
        loggedIn:`{{auth()->check()}}`,
        likesCount: `{{$book->formatted_likes_count}}`,
        toggleLike(url){
            if(!this.loggedIn){
                alert('You should login first');
                return
            }
            const self = this;
            axios.post(url)
            .then(function(res){
                self.isAlreadyLiked = res.data.newLike
                self.likesCount = res.data.likesCount
            })
            .catch(function(err){
                console.log(err)
            })
        }

    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-center flex-col">
                        @if($book->full_image_url)
                        <img src="{{$book->full_image_url}}" class="w-52">
                        @endif

                        <h1 class="text-3xl font-semibold font-mono mt-5">
                            {{$book->title}}
                        </h1>

                        <p class="text-base font-normal font-mono my-5 text-center mx-10">
                            {{$book->summary}}
                        </p>
                        <h3 class="text-sm font-normal font-mono text-indigo-700">
                            Uploaded By: <span class="capitalize font-bold">
                                {{$book->user->name}},
                            </span>
                            {{$book->created_at->diffForHumans()}}.
                        </h3>

                        <svg @click="toggleLike(`{{route('my_books.toggle_like',$book)}}`)" class="w-10 h-10 text-red-800 cursor-pointer mt-5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            :fill="isAlreadyLiked ? 'currentColor':'none'" viewBox="0 0 24 24" >

                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg>

                        <p class="text-base font-bold text-gray-500 dark:text-white my-2" x-text="likesCount">

                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
