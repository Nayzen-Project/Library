@extends('admin.layouts.dashboard')

@section('title', $title)

@section('content')
@vite('resources/css/app.css', 'resources/js/app.js')
    <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">User</h2>
        <div class="space-x-2">
            <button data-modal-target="us-modal" data-modal-toggle="us-modal" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400" type="button">Add new</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600">Import Peminjam</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600">Export Peminjam (Excel)</button>
        </div>
    </div>

    <div class="px-4 py-2 bg-white rounded-b-lg shadow-sm dark:bg-gray-900 border-x-2 border-b-2 border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Operation</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium 
                                    {{ $user->role == 'petugas' ? 'text-blue-600 bg-blue-200' : 
                                        ($user->role == 'user' ? 'text-green-600 bg-green-200' : 
                                        ($user->role == 'admin' ? 'text-red-600 bg-red-200' : 'text-gray-600 bg-gray-200')) }} rounded-lg">
                                    {{ $user->role }}
                                </span>
                            </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:underline">Edit</a> |
                            <form action="" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline dark:text-red-400 dark:hover:underline" onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <button class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-400">Login</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No members found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('admin.layouts.pages.user.crud.tambah-user')
@endsection