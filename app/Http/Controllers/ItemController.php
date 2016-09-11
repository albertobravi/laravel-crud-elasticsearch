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
        $items = Item::all();

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
            'title'     => 'required|unique:items|max:255',
            'content'   => 'required',
        ]);

        $item = new Item;
        $item->title    = $request->get('title');
        $item->content  = $request->get('content');
        $item->save();
        $item->addToIndex();

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
            'title'     => 'required|max:255',
            'content'   => 'required',
        ]);

        $item = Item::find($id);
        $item->title    = $request->get('title');
        $item->content  = $request->get('content');
        $item->save();
        $item->addToIndex();

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
        $results = [];

        if ($request->has('title')) {
            $this->validate($request, [
                'title' => 'required|max:255'
            ]);

            //$results = Item::searchByQuery(array('match' => array('title' => $request->input('title'))));
            $results = Item::search($request->input('title'));
        }

        return view('item.search', [
            'results' => $results
        ]);
    }
}
