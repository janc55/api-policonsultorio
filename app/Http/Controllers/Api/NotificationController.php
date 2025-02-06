<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'status' => 'required|in:sent,read',
            'type_id' => 'required|exists:notification_types,id',
        ]);

        $notification = Notification::create($validated);
        return response()->json(['message' => 'Notificación creada correctamente', 'notification' => $notification], 201);
    }

    public function show($id)
    {
        return Notification::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|in:sent,read',
        ]);

        $notification->update($validated);
        return response()->json(['message' => 'Notificación actualizada correctamente', 'notification' => $notification]);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Notificación eliminada correctamente'], 204);
    }
}
