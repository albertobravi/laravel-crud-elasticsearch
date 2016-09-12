@extends('layouts.app')

@section('title', 'Items List')

@section('content')
    <h1>Edit Item</h1>

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

    {{ Form::open(array('route' => array('items.update', $item->id))) }}
    {{ method_field('PUT') }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', old('title', $item->title), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', old('content', $item->content), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('published_at', 'Published At') }}
        {{ Form::date('published_at', old('published_at', $item->published_at ? new \Carbon\Carbon($item->published_at) : null)) }}
    </div>

    {{ Form::submit('Edit this item!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
