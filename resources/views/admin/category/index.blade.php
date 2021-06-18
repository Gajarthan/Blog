@extends('admin.layouts.app')

@section('title', 'Categories')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Categories</h1>
        <div class="grid grid-cols-1 md:grid-cols-5  gap-4">
            <div class=" md:col-span-2">
                <form action="/admin/categories" method="POST" enctype="multipart/form-data" >
                    @csrf
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
                        required>
                </div>

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
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent">
                        Parent Category
                    </label>
                    <select
                        id="parent"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        name="parent">
                        <option>Really long option that will likely overlap the chevron</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Description">
                        Category Description
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Description"
                        placeholder="Category Name"
                        name="description"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Description">
                        Category Thumbnail
                    </label>
                    <div class="grid grid-cols-2">
                        <img id="output" class="col-span-1" width="200" src="https://www.fillmurray.com/200/200" alt=""/>
                        <input
                            type="file"
                            class="col-span-1"
                            accept="image/*"
                            name="image"
                            id="file"
                            onchange="loadFile(event)"
                            required></p>
                    </div>
                </div>

                <div class="mb-4">
                    <input
                        type="submit"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                </form>
            </div>
            <div class="md:col-span-3">
                <style>
                    body{background:white!important;}
                </style>
                <table class="rounded-t-lg w-full bg-gray-200 text-gray-800">
                    <tr class="text-left border-b-2 border-gray-300">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                    @foreach($categories as $category)
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <td class="px-4 py-3">{{ $category->name }}</td>
                            <td class="px-4 py-3">{{ $category->slug }}</td>
                            <td class="px-4 py-3">{{ $category->description }}</td>
                            <td class="px-4 py-3">

                                <div x-data="{ dropdownOpen: false }" class="relative">
                                    <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block bg-gray-800 rounded p-2 hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>

                                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                                    <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Edit</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Delete</a>
                                    </div>
                                </div></td>
                        </tr>
                    @endforeach

                </table>

                <!-- classic design -->
            </div>
        </div>
    </main>
    <script>
        const loadFile = function (event) {
            const image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

@endsection
