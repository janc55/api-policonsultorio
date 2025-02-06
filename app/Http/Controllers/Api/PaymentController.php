<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with(['appointment', 'paymentMethod'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'status' => 'required|in:pending,completed,failed',
            'transaction_id' => 'nullable|string',
        ]);

        $payment = Payment::create($validated);
        return response()->json(['message' => 'Pago registrado correctamente', 'payment' => $payment], 201);
    }

    public function show($id)
    {
        return Payment::with(['appointment', 'paymentMethod'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|in:pending,completed,failed',
            'transaction_id' => 'nullable|string',
        ]);

        $payment->update($validated);
        return response()->json(['message' => 'Pago actualizado correctamente', 'payment' => $payment]);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Pago eliminado correctamente'], 204);
    }
}
