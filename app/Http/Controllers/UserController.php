<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Get list of unapproved users
    public function pendingUsers()
{
    \Log::info('pendingUsers endpoint accessed by user ID: ' . auth()->id());

    $pending = \App\Models\User::where('is_approved', false)->get();

    \Log::info('Fetched pending users count: ' . $pending->count());

    return response()->json($pending);
}


    // Approve a user
    public function approveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;

        // Set role if provided and valid
        if ($request->has('role') && in_array($request->role, ['admin', 'user'])) {
            $user->role = $request->role;
        }

        $user->save();

        return response()->json([
            'message' => 'User approved successfully',
            'user' => $user
        ]);
    }

    // ✅ Get all approved users
    // Get list of approved users
public function approvedUsers()
{
    \Log::info('approvedUsers endpoint accessed by user ID: ' . auth()->id());

    $approved = \App\Models\User::where('is_approved', true)->get();

    \Log::info('Fetched approved users count: ' . $approved->count());

    return response()->json($approved);
}

}
