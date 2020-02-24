<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Lists;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class ListController extends Controller
{
    /**
     * ListController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ListRequest $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ListRequest $request)
    {
        $list          = Lists::create($request->validated());
        $list->created = $list->created_at->diffForHumans();
        $html          = view('app.parts.list', compact('list'))->render();
        return response()->json(['list' => $list, 'html' => $html]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ListRequest $request
     * @param             $id
     *
     * @return JsonResponse
     */
    public function update(ListRequest $request, $id)
    {
        $list = Lists::findOrFail($id);
        $list->update($request->validated());
        return response()->json($list->save());
    }

    public function destroy(Lists $list)
    {
        return response('', $list->delete() ? 200 : 400);
    }
}
