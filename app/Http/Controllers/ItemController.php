<?php

namespace App\Http\Controllers;

use App\Models\item;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log("creating item...");

        $newItem = new item();
        $newItem->name = request('name');

        error_log("item ". $newItem->name . " created.");
        $newItem->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        $item = Item::find($request->id);
        error_log("---- EXISTING ITEM: -----------------");
        error_log($item);
        error_log("---- THE REQUEST: -----------------");
        error_log($request);
        error_log("---- THE ITEM: -----------------");
        error_log($item);
        if($item){
            error_log("---- STARTING THE IF -----------------");
            $item->completed = $request->item['completed'];
            if($item->completed) {
                $item->completed_at = Carbon::now();
            } else {$item->completed_at = null;}
            $item->save();
        }
        error_log("---- THE ITEM AFTER UPDATE: -----------------");
        error_log($item);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $existingItem = item::find($item);
        $existingItem->delete();
    }
}
