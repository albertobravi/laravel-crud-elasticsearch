@extends('layouts.app')

@section('title', 'Items List')

@section('content')
    <h1>Create an Item</h1>

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

    {{ Form::open(array('url' => 'items')) }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', old('content'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('published_at', 'Published At') }}
        {{ Form::date('published_at', \Carbon\Carbon::now()) }}
    </div>

    {{ Form::submit('Create the Item!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
