@extends('admin.layouts.app')

@section('title', 'Posts')


@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Posts</h1>

        @foreach($posts as $post)
        <div class="pt-2  ">
            <article class="sm:grid grid-cols-12 bg-white shadow-sm  relative  sm:p-4 rounded-lg justify-items-stretch hover:shadow-md ">
                <img src="https://images.unsplash.com/photo-1502977249166-824b3a8a4d6d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTd8fGZsb3dlcnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-20 w-20 h-auto rounded-lg" alt="Just a flower">
                <div class="sm:pt-0 sm:pl-5 col-start-2 col-span-8">

                    <h2 class="text-gray-800 capitalize text-xl py-2 font-bold">{{ $post->title }}</h2>
                    <span>{{ $post->published === 1 ? "Published":"Draft"}}</span>
                    .<span> {{ date('M j', strtotime($post->created_at))}}</span>
                    <a class="border border-gray-300 opacity-75 hover:opacity-100 hover:border-gray-900 text-blue-900 hover:text-gray-900 rounded-full px-2 py-1 text-sm	">{{ $post->categories->name }}</a>

                </div>
                <div class=" col-start-10 col-span-3 justify-self-end ">
                    <div class=" flex  items-end ">

                        <div class="p-1">
                        <button class="uppercase p-1 flex items-center  border border-blue-600 text-blue-600 max-w-max shadow-sm hover:shadow-lg rounded-md w-8 h-8 opacity-50 hover:opacity-100">
                            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 512 512"  xml:space="preserve">
	<path fill="currentColor" d="M505.752,241.915l-89.088-89.088c-88.737-88.737-232.591-88.737-321.327,0L6.248,241.915
				c-8.331,8.331-8.331,21.839,0,30.17l89.088,89.088c88.737,88.737,232.591,88.737,321.327,0l89.088-89.088
				C514.083,263.754,514.083,250.246,505.752,241.915z M386.494,331.003c-72.074,72.074-188.913,72.074-260.987,0L51.503,257
				l74.003-74.003c72.074-72.074,188.913-72.074,260.987,0L460.497,257L386.494,331.003z"/>
                                <path fill="currentColor" d="M256,150.333c-58.907,0-106.667,47.759-106.667,106.667S197.093,363.667,256,363.667S362.667,315.907,362.667,257
				S314.907,150.333,256,150.333z M256,321c-35.343,0-64-28.657-64-64s28.657-64,64-64s64,28.657,64,64S291.343,321,256,321z"/>
</svg>                        </button>
                        </div>
                        <div class="p-1">
                            <button class="uppercase p-1 flex items-center  border border-red-600 text-red-600 max-w-max shadow-sm hover:shadow-lg rounded-md w-8 h-8 opacity-50 hover:opacity-100">
                                <svg width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" style="transform: rotate(360deg);"><path d="M12 12h2v12h-2z" fill="currentColor"></path><path d="M18 12h2v12h-2z" fill="currentColor"></path><path d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20z" fill="currentColor"></path><path d="M12 2h8v2h-8z" fill="currentColor"></path></svg>
                            </button>
                        </div>
                    </div>

                </div>
            </article>
        </div>
        @endforeach

    </main>
@endsection
