<?php
ob_start();
define('API_KEY','347749942:AAGAVZBPb2h6Q0Se9_0Us2SMXqPY7-J3QwY');
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
mkdir("data");
mkdir("data/$fadmin");
$step= file_get_contents("data/$fadmin/one.txt","a+");
if($text1=="/help@Protect_Robot"){
 file_put_contents("data/$fadmin/one.txt","null");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"لطفا یکی از موارد زیر را انتخاب کنید.",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'مشاوره رایگان','url'=>'https://telegram.me/dr_srd'],['text'=>'ثبت سفارش','url'=>'https://telegram.me/user_shopping']],
[['text'=>"💥قوانین💥",'callback_data'=>"about"]]
]]),
 ]);
 }elseif($data=="about"){
bot('editmessagetext',[
'chat_id'=>$chatid,
'text'=>"💥قوانین💥

🚫 ارسال یا فوروارد لینک در گروه ممنوع است

🚫 ارسال یا فوروارد کپشن یا زیرنویس در گروه ممنوع است

🚫 ارسال یا فوروارد هر گونه اطلاعات تماس در گروه ممنوع است

🚫 طرح مسائل غیر مرتبط یا سیاسی و غیر اخلاقی در گروه ممنوع است

🚫 هرگونه مزاحمت ، رفتن به pv افراد یا چت در گروه ممنوع است

از همکاری شما متشکریم 👮",
'message_id'=>$messageid,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"↩برگشت",'callback_data'=>"back"]]
]]),
]);
}elseif($data=="start"){
file_put_contents("data/$chatid/one.txt","start");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"لطفا یکی از موارد زیر را انتخاب کنید.",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'مشاوره رایگان','url'=>'https://telegram.me/dr_srd'],['text'=>'ثبت سفارش','url'=>'https://telegram.me/user_shopping']],
[['text'=>"💥قوانین💥",'callback_data'=>"about"]]
]]),
 ]);

}elseif($data=="back"){
file_put_contents("data/$chatid/one.txt","null");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"لطفا یکی از موارد زیر را انتخاب کنید.",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'مشاوره رایگان','url'=>'https://telegram.me/dr_srd'],['text'=>'ثبت سفارش','url'=>'https://telegram.me/user_shopping']],
[['text'=>"💥قوانین💥",'callback_data'=>"about"]]
]]),
 ]);
}
?>