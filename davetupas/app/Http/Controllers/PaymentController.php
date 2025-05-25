<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Project;

class PaymentController extends Controller
{
    // Get all payments
    public function getPayments()
    {
        $payments = Payment::with('project')->get();
        return response()->json(['payments' => $payments]);
    }

    // Add a new payment
    public function addPayment(Request $request)
    {
        $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:50'],
            'payment_date' => ['required', 'date'],
            'reference' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:pending,completed,failed'],
        ]);

        $payment = Payment::create([
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'reference' => $request->reference,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Payment added successfully',
            'payment' => $payment
        ]);
    }

    // Edit an existing payment
    public function editPayment(Request $request, $id)
    {
        $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:50'],
            'payment_date' => ['required', 'date'],
            'reference' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:pending,completed,failed'],
        ]);

        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update([
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'reference' => $request->reference,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment
        ]);
    }

    // Delete a payment
    public function deletePayment($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
