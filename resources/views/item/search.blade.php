@extends('layouts.app')

@section('title', 'Items List')

@section('content')
    <h1>Search Items</h1>

    <!-- if there are creation errors, they will show here -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    {{ Form::open(array('url' => 'search', 'method' => 'get')) }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}



    @if (count($results) > 0)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Content</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->content }}</td>
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL::to('items/' . $value->id) }}">Show this Item</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection