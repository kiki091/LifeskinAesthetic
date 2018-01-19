<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Mail;
use App\Models\Mail\MailJobs as MailModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\SendEmail;

use Log;
use DB;

class MailSender
{
    use DispatchesJobs;

    protected $mail_job_count = 50;

    protected $default_sender;
    const DEFAULT_SENDER = ['from'=> 'no-reply@thelifskynclinic.com', 'name' => 'Admin'];


    public function __construct()
    {
        $this->default_sender = self::DEFAULT_SENDER;
    }

    public static function send($view, $data)
    {
        Mail::send(['mail' =>  $view], ['data' => $data['body']], function ($message) use ($data) {
            try {
                if(!array_key_exists('from', $data))
                    $data['from'] = $this->default_sender;

                $message->subject($data['subject'])
                    ->to($data['to'])
                    ->from($data['from']->address , $data['from']->name)
                    ->replyTo($data['from']->address);

                if(isset($data['bcc']) && !empty($data['bcc'])) {
                    $message->bcc($data['bcc']);
                }

                // if(array_key_exists('attachment', $data))
                // {
                //     if(is_array($data['attachment']) &&  count($data['attachment']))
                //     {
                //         foreach($data['attachment'] as $obj_data)
                //         {
                //             $file = public_path().$obj_data;
                //             $mimetypes = \GuzzleHttp\Psr7\mimetype_from_filename($file);

                //             $message->attach($file, ['as' => basename($file), 'mime' => $mimetypes ]);
                //         }
                //     }
                //     else
                //     {
                        
                //         $file = public_path().$data['attachment'];
                //         $mimetypes = \GuzzleHttp\Psr7\mimetype_from_filename($file);
                //         $message->attach($file, ['as' => basename($file), 'mime' => $mimetypes ]);
                //     }
                // }
            } catch (\Exception $e) {
                Log::info('[MAIL] '. $e->getMessage());
                return false;
            }
        });


        if(count(Mail::failures()) > 0 ) {

           return json_encode(array(
                    'status'    => false,
                    'message'   => 'Sent Failed',
                    ));
        } else {
            return json_encode(array(
                    'status'    => true,
                    'message'   => 'Sent Success',
                    ));
        }


    }

    public static function queue($view, $data)
    {
        $keys = array('to','body','subject', 'bcc');
        $flag_keys = true;
        foreach($keys as $key)
        {
            if(!in_array($key, array_keys($data))) {
                $flag_keys = false;
            }
        }

        if(!is_array($data) || !$flag_keys || !$view)

            return false;
        
        $mail = new MailModel();
        $mail->view = $view;
        $mail->data = json_encode($data);

        $mail->save();

        return $mail;
    }

    /**
     * Send Queue Mail And Write Log
     * @param string $to
     * @param string $from
     * @param string $subject
     * @param string $blade
     * @param array $data
     * @return bool
     */
    public function sendQueueMailWithLog($to = "", $from = 'default', $subject = "", $blade = "welcome", $data = array(), $bcc = "")
    {
        try{
            $dataObj['to'] = $to;
            $dataObj['from'] = $from == 'default' ? $this->default_sender : $from;
            $dataObj['subject'] = $subject;
            $dataObj['body']   = $data;
            $dataObj['bcc']     = $bcc;

            // to add to queue
            $mail = $this->send($blade, $dataObj);

            if($mail !== false) {
                
                return true;
            } else {
                Log::info('[MAIL] mail variable = false');
                return false;
            }

        }catch (\Exception $e){
            Log::info('[MAIL] '. $e->getMessage());
            return false;
        }
    }

}
