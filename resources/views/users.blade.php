@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

            <tr>

                <td >{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['surname'] }}</td>
                <td>{{ $user['email'] }}</td>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>


@endsection
