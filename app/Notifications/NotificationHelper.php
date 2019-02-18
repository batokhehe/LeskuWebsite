<?php 
namespace App\Notifications;

class NotificationHelper 
{
    protected $teacher_key = "AIzaSyBT5ayeEGBJ68IQDg-RS8LofbiRHW_cwoo";
    protected $student_key = "AIzaSyCFXYYWMYXLrn-U7IlcBIH7Lo1YJO2_Xsg";
    

    public function send_to_specific_user($user_firebase_id, $title, $multiple_type, $type)
    {
        //multiple = 0 :: Single
        //type = = 0 :: Student
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification, "moredata" =>'dd'];

        $fcmNotification = [
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        if($multiple_type == '0'){
            $fcmNotification['to'] = $user_firebase_id; //single token
        } else {
            $fcmNotification['registration_ids'] = $user_firebase_id; //multple token array
        }
        // $fcmNotification['to'] = 'dIqQ_dKwxFU:APA91bG48B2Uw07fFbh-Jdsx62TLzUeI5dt8iAw327jkYlh34PaM8VV0JX2RtBsMRqDfmQZPwSA3qJ94jczRhRN98zhsTUz02TpdsQLao-JET3eb8ftb_SdsuRCCjq2N505qTzth8yv8';

        if($type == '0'){
            $key = $this->student_key;
        } else {
            $key = $this->teacher_key;
        }
            
        $headers = [
            'Authorization: key=' . $key,
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