@extends('layout.app')

@section('title', 'Users')

@section('content')
    <!-- Wrapper -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header">
                        <h3 class="card-title">Users {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                        <form action="{{ route('logout') }}" method="POST" class="absolute top-4 right-4">
                            @csrf
                            <button type="submit" class="text-sm text-blue-500 hover:underline">Logout</button>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body no-pad-left-right">
                        <div class="table-responsive">
                            <table id="user_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $user->id }}</td>
                                            <td class="border px-4 py-2"><img src="{{ asset($user->image) }}" alt="" width="50" height="50"></td>
                                            <td class="border px-4 py-2">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="border px-4 py-2">{{ $user->email }}</td>
                                            <td class="border px-4 py-2">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    
@endsection

@section('scripts')
    <!-- Include DataTables JS -->
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable(); // Initialize DataTables
        });
    </script>
@endsection