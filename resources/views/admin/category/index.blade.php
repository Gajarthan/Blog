@extends('admin.layouts.app')

@section('title', 'Categories')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Categories</h1>
        <div class="grid grid-cols-1 md:grid-cols-5  gap-4">
            <div class=" md:col-span-2">
                <form action="/categories" method="POST" enctype="multipart/form-data" >
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
                        <th class="px-4 py-3">Firstname</th>
                        <th class="px-4 py-3">Lastname</th>
                        <th class="px-4 py-3">Age</th>
                        <th class="px-4 py-3">Sex</th>
                    </tr>

                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-4 py-3">Jill</td>
                        <td class="px-4 py-3">Smith</td>
                        <td class="px-4 py-3">50</td>
                        <td class="px-4 py-3">Male</td>
                    </tr>
                    <!-- each row -->
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-4 py-3">Jill</td>
                        <td class="px-4 py-3">Smith</td>
                        <td class="px-4 py-3">50</td>
                        <td class="px-4 py-3">Male</td>
                    </tr>
                    <!-- each row -->
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-4 py-3">Jill</td>
                        <td class="px-4 py-3">Smith</td>
                        <td class="px-4 py-3">50</td>
                        <td class="px-4 py-3">Male</td>
                    </tr>
                    <!-- each row -->

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
