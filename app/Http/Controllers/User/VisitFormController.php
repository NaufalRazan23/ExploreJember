<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VisitForm;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisitFormController extends Controller
{
    /**
     * Store a new visit form or update existing one
     */
    public function store(Request $request, Destination $destination)
    {
        try {
            $request->validate([
                'visit_date' => 'required|date|after_or_equal:today',
                'arrival_time' => 'required|date_format:H:i',
                'departure_time' => 'required|date_format:H:i',
                'visit_type' => 'required|in:sendirian,rombongan',
                'group_size' => 'required_if:visit_type,rombongan|nullable|integer|min:2|max:100',
                'suggestions' => 'nullable|string|max:1000',
                'review' => 'nullable|string|max:1000',
            ]);

            // Additional validation to ensure departure_time is after arrival_time
            $arrivalTime = Carbon::createFromFormat('H:i', $request->arrival_time);
            $departureTime = Carbon::createFromFormat('H:i', $request->departure_time);

            if ($departureTime->lte($arrivalTime)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Waktu pergi harus lebih lambat dari waktu datang!'
                ], 422);
            }

            $visitFormData = [
                'user_id' => Auth::id(),
                'destination_id' => $destination->id,
                'visit_date' => $request->visit_date,
                'arrival_time' => $request->arrival_time,
                'departure_time' => $request->departure_time,
                'visit_type' => $request->visit_type,
                'group_size' => $request->visit_type === 'rombongan' ? $request->group_size : null,
                'suggestions' => $request->suggestions,
                'review' => $request->review,
            ];

            // Use updateOrCreate to handle both create and update
            VisitForm::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'destination_id' => $destination->id
                ],
                $visitFormData
            );

            return response()->json([
                'success' => true,
                'message' => 'Form kunjungan berhasil disimpan!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's visit form for a specific destination
     */
    public function show(Destination $destination)
    {
        $visitForm = VisitForm::where('user_id', Auth::id())
                             ->where('destination_id', $destination->id)
                             ->first();

        return response()->json([
            'visitForm' => $visitForm
        ]);
    }

    /**
     * Delete user's visit form
     */
    public function destroy(Destination $destination)
    {
        $visitForm = VisitForm::where('user_id', Auth::id())
                             ->where('destination_id', $destination->id)
                             ->first();

        if ($visitForm) {
            $visitForm->delete();
            return response()->json([
                'success' => true,
                'message' => 'Form kunjungan berhasil dihapus!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Form kunjungan tidak ditemukan!'
        ], 404);
    }
}
