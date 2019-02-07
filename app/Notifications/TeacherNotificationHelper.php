<?php 
namespace App\Notifications;

class TeacherNotificationHelper 
{
    protected $teacher_key = "AIzaSyBT5ayeEGBJ68IQDg-RS8LofbiRHW_cwoo";
    protected $student_key = "AIzaSyCFXYYWMYXLrn-U7IlcBIH7Lo1YJO2_Xsg";
    

    public function send_to_specific_user($user_firebase_id, $title, $type)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        if($type == '0'){
            $fcmNotification['registration_ids'] = $user_firebase_id; //multple token array
        } else {
            $fcmNotification['to'] = $user_firebase_id; //single token
        }
            

        $headers = [
            'Authorization: key=' . $this->teacher_key,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function send_to_all($user_firebase_id, $message)
    {
        $user = $this->userRepository->activate($id);
        $this->userRepository->confirm($token);

        $this->mailer->sendWelcomeEmail($user);

        return $user;
    }
}
?>