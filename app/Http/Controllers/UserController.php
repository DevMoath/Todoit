<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Exception;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * UserController constructor.
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
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param UserRequest $request
     * @param User        $user
     *
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $isUpdated = $user->update(array_filter($request->validated()));
        return $isUpdated ? back()->with('success', 'Updated successfully') : back()->withErrors('Update failed, Try again');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int         $id
     *
     * @return RedirectResponse
     */
    public function updatePassword(UserRequest $request, int $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);
        if (Hash::check($data['password'], $user->password)) {
            $user->password = Hash::make($data['new_password']);
            return $user->save() ? back()->with('success', 'Updated successfully') : back()->withErrors('Update failed, Try again');
        } else {
            return back()->withErrors('Update failed, The password is incorrect');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return string
     * @throws Exception
     */
    public function destroy(User $user)
    {
        return $user->delete() ?
            redirect()->route('home')->with('success', 'Account Deleted Successfully') :
            back()->withErrors("Can't be deleted");
    }
}
