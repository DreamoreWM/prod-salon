<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyCardController extends Controller
{
    public function show(User $user = null)
    {
        // Utiliser l'utilisateur authentifié si aucun utilisateur n'est spécifié
        $user = $user ?? Auth::user();

        $loyaltyCards = $user->loyaltyCards()->get();

        return view('loyalty.card', compact('loyaltyCards', 'user'));
    }

    public function addStamp(LoyaltyCard $card)
    {
        $card->stamps++;

        if ($card->stamps >= 6) {
            LoyaltyCard::create([
                'user_id' => $card->user_id,
                'stamps' => 0,
                'card_number' => $card->card_number + 1,
            ]);
            $card->stamps = 6;
        }

        $card->save();

        return response()->json(['success' => true]);
    }

    public function store(User $user)
    {
        $latestCard = $user->loyaltyCards()->latest('card_number')->first();

        $newCardNumber = $latestCard ? $latestCard->card_number + 1 : 1;

        LoyaltyCard::create([
            'user_id' => $user->id,
            'stamps' => 0,
            'card_number' => $newCardNumber,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(LoyaltyCard $card)
    {
        $card->delete();

        return response()->json(['success' => true]);
    }
}
