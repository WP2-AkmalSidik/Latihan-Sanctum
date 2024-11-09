<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date',
        ]);

        $transaction = auth()->user()->transactions()->create($data);
        return response()->json($transaction, 201);
    }

    public function show($id)
    {
        $transaction = auth()->user()->transactions()->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return response()->json($transaction);
    }

    public function update(Request $request, $id)
    {
        $transaction = auth()->user()->transactions()->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'sometimes|required|numeric',
            'type' => 'sometimes|required|in:income,expense',
            'transaction_date' => 'sometimes|required|date',
        ]);

        $transaction->update($data);
        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $transaction = auth()->user()->transactions()->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        $transaction->delete();
        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
