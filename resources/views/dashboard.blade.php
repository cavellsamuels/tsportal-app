<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </head>

    {{-- @auth('admin')

        <head>
            <title>Admin Dashboard</title>
            <style></style>
        </head>

        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center m-5">Admin Dashboard</h1>
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    @endif

                    <form method="POST" action="">
                        <div class="form-control"> ADMIN CONTENT </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth --}}

    @auth('teacher')

        <head>
            <title> Teacher Dashboard </title>
            <style></style>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3">
                        <h1 class="text-center m-5">Teacher Dashboard</h1>

                        @if (\Session::has('error'))
                            <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                            @csrf

                            <select class="form-control" name="studentname" id="">
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ ucwords($student->first_name) }}
                                        {{ ucwords($student->last_name) }}</option>
                                @endforeach
                            </select>

                            <br><br>

                            <input class="form-control mb-5" value="{{ $file->id }}" type="file" name="file" class="file">

                            <button class="assignButton" type="submit"> Assign </button>
                        </form>

                    </div>
                </div>
            </div>
        </body>
    @endauth

    @auth('student')

        <head>
            <title>Student Dashboard</title>
            <style></style>
        </head>


        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center m-5">Student Dashboard</h1>

                    @if (\Session::has('error'))
                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    @endif


                    <table>
                        <tr>
                            <th class="underline">File</th>
                            <th class="underline">Assigned By</th>
                            <th></th>
                        </tr>

                        @foreach (auth()->user()->files as $file)
                            @csrf

                            <form action="{{ route('file.download', [$file->id]) }}">
                                <tr>
                                    <td>{{ $file->name }} </td>
                                    <td>{{ $file->uploaded_by }}</td>
                                    <td> <button> Download </button> </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endauth

</x-app-layout>
