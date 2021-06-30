@extends('admin.layouts.app')

@section('title', 'Categories')


@section('content')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Categories</h1>
        <div class="grid grid-cols-1 lg:grid-cols-5  gap-4">
            <div class=" lg:col-span-2">
                @if($data['ec']!="")
{{--                    edit form start--}}
                    <form action="/admin/categories/{{ $data['ec']->id }}" method="POST" enctype="multipart/form-data" >
                        @method('PUT')
                        @else
{{--                            create form start --}}
                            <form action="/admin/categories" method="POST" enctype="multipart/form-data" >
                                @endif
                        @csrf
{{--                                name--}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        Name
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name"
                                        type="text"
                                        placeholder="Category Name"
                                        name="title"
                                        @if($data['ec']!="")
                                        value="{{ $data['ec']->name }}"
                                        @endif
                                        required>
                                </div>
{{--                                Slug--}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                                        Slug
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="slug"
                                        type="text"
                                        placeholder="Category Slug"
                                        name="slug"
                                        @if($data['ec']!="")
                                        value="{{ $data['ec']->slug }}"
                                        @endif
                                        required>
                                </div>
{{--                                description--}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Description">
                                        Category Description
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="Description"
                                        placeholder="Category Name"
                                        name="description"
                                        required>@if($data['ec']!=""){{ $data['ec']->description }}@endif</textarea>
                                </div>
{{--                                thumnail--}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Description">
                                        Category Thumbnail
                                    </label>

                                    <div class=" grid grid-cols-2">
                                    <img id="output" class="col-span-1" width="200" src="https://via.placeholder.com/200" alt=""/>

                                    <div class="border border-dashed border-gray-500 relative">
                                        <input
                                            type="file"
                                            class="cursor-pointer relative block opacity-0 col-span-1 p-20 z-50"
                                            accept="image/*"
                                            name="image"
                                            id="file"
                                            onchange="loadFile(event)"
                                            required>
                                        <div class="text-center p-10 absolute top-0 left-0 ">
                                            <h4>
                                                Drop files anywhere to upload
                                                <br/>or
                                            </h4>
                                            <p class="">Select Files</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
{{--                                submit--}}
                                <div class="mb-4">
                                    <input
                                        type="submit"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                </div>
                            </form>
{{--                    form end--}}
            </div>
            <div class="lg:col-span-3">
                <style>
                    body{background:white!important;}
                </style>
{{--                table start--}}
                <table class="rounded-lg w-full bg-gray-200 text-gray-800">
                    <tr class="text-left border-b-2 border-gray-300">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Description</th>
                    </tr>
                    @foreach($data['ca'] as $category)
                        <tr class="bg-gray-100 border-b border-gray-200">
{{--                            table Name section--}}
                            <td class="px-4 py-3">
                                <div class="flex items-center">
{{--                                    table image--}}
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 " src="http://127.0.0.1:8000/storage/image/{{ $category->imagePath }}" alt="">
                                    </div>
                                    <div class="ml-4">
{{--                                        table name--}}
                                        <div class="text-sm font-medium text-gray-900">
                                           {{ $category->name }}
                                        </div>
{{--                                        table slug--}}
                                        <div class="text-sm text-gray-500">
                                            slug: {{ $category->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>
{{--                            description--}}
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $category->description }}</td>
{{--                            action--}}
                            <td class="px-4 py-3">
{{--                                edit delete drop down--}}
                                <div x-data="{ dropdownOpen: false }" class="relative float-right">
                                    <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded p-2">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                                    <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
{{--                                        edit button--}}
                                        <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" onclick="return confirm('Are you sure you want to delete this comment?')" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200 text-center" >Edit</a>
{{--                                        delete button--}}
                                        <form action="/admin/categories/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200 w-full"  onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-left border-b-2 border-gray-300">
                        <th class="px-4 py-3 text-right" colspan="4">
                            @if ($data['ca']->onFirstPage())
                                <span class="bg-gray-400 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 isDisabled rounded">
                                    &lt;
                                </span>
                            @else
                                <a class="bg-gray-400 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded" href="{{ $data['ca']->previousPageUrl() }}">
                                    &lt;
                                </a>
                            @endif
                                &nbsp;	&nbsp;	{!! $data['ca']->currentPage() !!} of {!! $data['ca']->lastItem() !!} &nbsp;	&nbsp;

                                @if (!$data['ca']->hasMorePages())
                                    <span class="bg-gray-400 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded isDisabled">
                                        &gt;
                                    </span>
                                @else
                                    <a class="bg-gray-400 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded" href="{{ $data['ca']->nextPageUrl() }}">
                                        &gt;
                                    </a>
                                @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </main>
{{--    image out put when upload--}}
    <script>
        const loadFile = function (event) {
            const image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

@endsection
