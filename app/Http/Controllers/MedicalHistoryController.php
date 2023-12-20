<?php

namespace App\Http\Controllers;

use App\Models\Medical_history;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    //obtain medical records based on a specific user
    public function getUserMedicalHistories($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->type == 'professional') {
            $histories = Medical_history::where('professional_id', $userId)->get();
        } else {
            $histories = Medical_history::where('patient_id', $userId)->get();
        }

        return response(["status" => 200, 'histories' => $histories]);
    }

    //Create medical histories
    public function createHistory(Request $request, $professionalId)
    {
        try {
            $request->validate([
                'patient_id' => 'required|string',
                'history_consecutive' => 'required|integer',
                'current_patient_state' => 'required|string',
                'medical_history' => 'nullable|string',
                'final_evolution' => 'nullable|string',
                'professional_opinion' => 'nullable|string',
                'recommendations' => 'nullable|string'
            ]);

            //Validates if the user does not exist or does not have permission to make such a request.
            $professional = User::find($professionalId);
            if (!$professional || $professional->type !== 'professional') {
                $status = !$professional ? 404 : 401;
                $message = !$professional ? 'Non-existent professional' : 'Unauthorized user';

                return response(['status' => $status, 'message' => $message]);
            }

            //Validates if the patient user does not exist
            $patient = User::find($request->input('patient_id'));
            if (!$patient) {
                return response(['status' => 404, 'message' => 'Non-existent patient']);
            }

            $history = Medical_history::create([
                'professional_id' => $professionalId,
                'patient_id' => $request->input('patient_id'),
                'date_time' => now(),
                'history_consecutive' => $request->input('history_consecutive'),
                'current_patient_state' => $request->input('current_patient_state'),
                'medical_history' => $request->input('medical_history'),
                'final_evolution' => $request->input('final_evolution'),
                'professional_opinion' => $request->input('professional_opinion'),
                'recommendations' => $request->input('recommendations'),
            ]);

            return response(['status' => 201, 'message' => 'History has been created', 'history' => $history]);
        } catch (\Exception  $e) {
            return response(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    //Obtain all medical histories
    public function getAllHistories()
    {
        return Medical_history::all();
    }

    //acceptHistoryCreated
    public function acceptHistory(Request $request, $userId, $historyId)
    {
        $patient = User::find($userId);
        if (!$patient || $patient->type !== 'patient') {
            $status = !$patient ? 404 : 401;
            $message = !$patient ? 'Non-existent patient' : 'Unauthorized user';

            return response(['status' => $status, 'message' => $message]);
        }

        $history = Medical_history::where('id', $historyId)
            ->where('patient_id', $userId)
            ->first();

        if (!$history) {
            return response(['status' => 404, 'message' => 'Non-existent history']);
        }

        $history->update(['is_accepted' => true]);

        return response(['status' => 202, 'message' => 'History has been updated', 'history' => $history]);
    }
}
