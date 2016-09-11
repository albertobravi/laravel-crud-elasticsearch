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
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>
                    <ul>
                        <li><a class="btn btn-small btn-info" href="{{ URL::to('items/' . $item->id . '/edit') }}">Edit this Item</a></li>
                        <li>
                            {{ Form::open(array('url' => 'items/' . $item->id, 'class' => 'pull-right')) }}
                            {{ method_field('DELETE') }}
                            {{ Form::submit('Delete this Item', array('class' => 'btn btn-warning')) }}
                            {{ Form::close() }}
                        </li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
@endsection