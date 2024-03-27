<x-app-layout>


    <div class="flex justify-center py-10">
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="{{route('my_books.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Add Book</h5>
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        title</label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required />
                    @error('title')
                    <p class="text-red-600">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                        image (optional)</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="image">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help"> PNG, JPG or GIF.</p>
                    @error('image')
                    <p class="text-red-600">
                        {{$message}}
                    </p>
                    @enderror
                </div>


                <div class="space-y-2">
                    <label for="message" class="block text-sm font-medium text-gray-900 dark:text-white">Summary</label>
                    <textarea id="message" rows="4"
                        class="block  w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Summary..." name="summary" required></textarea>
                    @error('summary')
                    <p class="text-red-600">
                        {{$message}}
                    </p>
                    @enderror

                    <div class="flex items-center mb-4">
    <input  name="is_public" id="default-checkbox" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">mark as public</label>
</div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
