<?php

namespace App\Http\Controllers\Kanban;

use App\Http\Controllers\Controller;
use App\Models\CardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $p = 6000;
        $data = [
            'column_id' => $request->column_id,
            'card_name' => $request->card_name,
            'status' => 1,
            'position' => $p
        ];
        $p += 6000;
        CardModel::create($data);

        return response()->json('success', 200);
    }

    public function delete($id)
    {
        $data = CardModel::find($id);
        $data->delete();

        return response()->json('success', 200);
    }

    public function updateCardPositions(Request $request)
    {
        $cards = $request->input('cards');
        Log::info('Cards data received:', $cards);

        foreach ($cards as $cardData) {
            Log::info('Updating card:', [
                'id' => $cardData['id'],
                'position' => $cardData['position'],
                'column_id' => $cardData['column_id']
            ]);

            // Get the current position of the card
            $currentPosition = DB::table('cards')->where('id', $cardData['id'])->value('position');

            // Increment the position
            $newPosition = $currentPosition + 1; // You can adjust the increment based on your logic

            // Update the card's position
            DB::table('cards')
                ->where('id', $cardData['id'])
                ->update([
                    'position' => $newPosition,
                    'column_id' => $cardData['column_id'],
                ]);
        }

        return response()->json(['message' => 'Card positions updated successfully.']);
    }

    public function updatePositions(Request $request)
    {
        $cards = $request->all();

        try {
            foreach ($cards as $cardData) {
                CardModel::where('id', $cardData['id'])->update([
                    'column_id' => $cardData['column_id'],
                    'position' => $cardData['position'],
                ]);
            }

            return response()->json(['message' => 'Card positions updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update card positions.'], 500);
        }
    }

    public function move(CardModel $card)
    {
        request()->validate([
            'column_id' => ['required', 'exists:card_lists,id'],
            'position' => ['required', 'numeric']
        ]);

        $card->update([
            'column_id' => request('column_id'),
            'position' => round(request('position'), 5)
        ]);

        return redirect()->back();
    }

}
