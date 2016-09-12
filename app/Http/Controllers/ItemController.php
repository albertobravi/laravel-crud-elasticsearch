<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->get();

        return view('item.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|unique:items|max:255',
            'content'       => 'required',
            'published_at'  => 'date'
        ]);

        $item = new Item;
        $item->title        = $request->input('title');
        $item->content      = $request->input('content');
        $item->published_at = $request->has('published_at') ? new \Carbon\Carbon($request->input('published_at')) : null;
        $item->save();

        $request->session()->flash('message', "Successfully created item!");

        return redirect('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        return view('item.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        return view('item.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         => 'required|max:255',
            'content'       => 'required',
            'published_at'  => 'date'
        ]);

        $item = Item::find($id);
        $item->title        = $request->input('title');
        $item->content      = $request->input('content');
        $item->published_at = $request->has('published_at') ? new \Carbon\Carbon($request->input('published_at')) : null;
        $item->save();

        $request->session()->flash('message', "Successfully updated item!");

        return redirect('items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        session()->flash('message', "Successfully deleted the item!");

        return redirect('items');
    }

    /**
     * search Items in the Elasticsearch index.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'title'     => 'max:255',
            'published' => 'in:true,false',
            'date_from' => 'date',
            'date_to'   => 'date'
        ]);

        $results = Item::customSearch(
            $request->input('title'),
            $request->input('published'),
            $request->input('date_from'),
            $request->input('date_to')
        );

        return view('item.search', [
            'results' => $results
        ]);
    }
}
