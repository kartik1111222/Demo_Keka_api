<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function saveToken(Request $request){
       $token = $request->input('token');
        $user = auth()->user();
        
        if($user != null){
            $user->device_token = $token;
            $user->save();

            return response()->json([
             'message' => 'token saved successfully!'
            ]);
        }
    }

    public function sendNotification(Request $request){
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAQJBteeY:APA91bHDpTpBeVzZgdpRW5WVSHTbjyQxeIcxgrJgoyOD71BGgYFHBzQQNEQTemg5_4Rz0Ltgcp97spmG5RNEop7XysxmcXptD7jGah_q7fPTDRYDKqTC743V2uGH9dPShIpA-sI5S245';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);

      
        dd($response);

    }
}
