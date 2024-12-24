@extends('layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- @if (session('status') == true)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{auth()->user()->name}} saytga hush kelibsiz</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
        {{-- @endif --}}

            
            {{-- @if (auth()->check() && auth()->user()->email_verified_at)
                <!-- "Create User" Button -->
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                        Create User
                    </button>
                </div>
            @endif --}}


            {{-- <!-- User Table -->
            <table class="table table-striped table-bordered" id="userTableBody">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        @if (auth()->check() && auth()->user()->email_verified_at)
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
            
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if (auth()->check() && auth()->user()->email_verified_at)
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}

            <!-- Pagination Links -->
            {{-- {{ $users->links() }} --}}
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

@endsection