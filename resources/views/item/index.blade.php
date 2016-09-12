@extends('layouts.app')

@section('title', 'Items List')

@section('content')
    <h1>Items list</h1>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Content</td>
                <td>Published</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->content }}</td>
                    <td>{{ $value->published_at }}</td>
                    <td>
                        <ul>
                            <li><a class="btn btn-small btn-success" href="{{ URL::to('items/' . $value->id) }}">Show this Item</a></li>
                            <li><a class="btn btn-small btn-info" href="{{ URL::to('items/' . $value->id . '/edit') }}">Edit this Item</a></li>
                            <li>
                                {{ Form::open(array('url' => 'items/' . $value->id, 'class' => 'pull-right')) }}
                                {{ method_field('DELETE') }}
                                {{ Form::submit('Delete this Item', array('class' => 'btn btn-warning')) }}
                                {{ Form::close() }}
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection