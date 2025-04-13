<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtRequest;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

class DebtController extends Controller
{
    use Controller;

    public function sendDebtRequest(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
        ]);

        DebtRequest::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return $this->Success();
    }

    public function respondToDebtRequest(Request $request, $id)
    {
        //checking user
        $debtRequest = DebtRequest::where('id', $id)
            ->where('to_user_id', auth()->id())
            ->first();

        if (!$debtRequest) {
            return response()->json(['message' => 'درخواست بدهی یافت نشد یا مجاز نیستید.'], 403);
        }

        // creating the debt
        if ($request->status === 'accepted') {
            Debt::create([
                'from_user_id' => $debtRequest->from_user_id,
                'to_user_id' => $debtRequest->to_user_id,
                'amount' => $debtRequest->amount,
                'description' => $debtRequest->description,
                'status' => 'accepted',
                'is_paid' => false,
            ]);
        }


        $debtRequest->update(['status' => $request->status]);

        return $this->Success();
    }





    public function payDebt(Request $request, $id)
    {
        $debt = Debt::where('id', $id)
            ->where('from_user_id', auth()->id())
            ->where('is_paid', false)
            ->where('status', 'accepted')
            ->first();

        if (!$debt) {
            return response()->json(['message' => 'بدهی یافت نشد، پرداخت مجاز نیست یا هنوز تأیید نشده.'], 404);
        }

        $debt->update(['is_paid' => true]);

        return $this->Success();
    }
}
