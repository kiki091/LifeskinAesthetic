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
    /*
    TO USE:
        use App\Services\Mail\QDHMail as MailService;
        use App\Jobs\SendEmail;

        $data['to'] = 'richard.william@qeon.co.id';
        $data['subject'] = 'Subject';
        $data['body'][] = array();
        // add attachment 
        $data['attachment'] = 'path/to/file';
        // or for multiple attachments
        $data['attachment'][] = 'path/to/file1';
        $data['attachment'][] = 'path/to/file2';

        $view = 'ayana.pages.view';
        // to add to queue
        $mail = MailService::queue($blade, $data);
        if($mail !== false)
            $this->dispatch(new SendEmail($mail));

        // just send it anyway
        $mail = MailService::send($blade, $data);

        
    */
    protected $mail_job_count = 50;

    protected $default_sender;
    const DEFAULT_SENDER = ['from'=> 'default@email.com', 'name' => 'default'];


    public function __construct()
    {
        $this->default_sender =  !is_null(config('mail.from')['address']) &&  !is_null(config('mail.from')['name']) ? config('mail.from') : self::DEFAULT_SENDER;
        //$this->mail_job_count = Config::has('mail_job.count') ? config('mail_job.count') : 50;
    }

    /** 
    SEND MAIL
    params : 

    $view : string - view attached to
    $data : array
        from    => email's from ( not mandatory, will set to default from email if not set)
        to      => email's to
        subject => email's title


    return : json
        status : bool 
        message : string
    **/
    public static function send($view, $data)
    {
        Mail::send(['html' => 'mail/' . $view], ['data' => $data['body']], function ($message) use ($data) {
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

                if(array_key_exists('attachment', $data))
                {
                    if(is_array($data['attachment']) &&  count($data['attachment']))
                    {
                        foreach($data['attachment'] as $obj_data)
                        {
                            $file = public_path().$obj_data;
                            $mimetypes = \GuzzleHttp\Psr7\mimetype_from_filename($file);

                            $message->attach($file, ['as' => basename($file), 'mime' => $mimetypes ]);
                        }
                    }
                    else
                    {
                        
                        $file = public_path().$data['attachment'];
                        $mimetypes = \GuzzleHttp\Psr7\mimetype_from_filename($file);
                        $message->attach($file, ['as' => basename($file), 'mime' => $mimetypes ]);
                    }
                }
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
           /*
           foreach(Mail::failures as $email_address) {
               echo " - $email_address <br />";
           }*/
        } else {
            return json_encode(array(
                    'status'    => true,
                    'message'   => 'Sent Success',
                    ));
            /*return back()
            ->withSuccess("Thank you for your message. It has been sent.");*/
        }


    }

    public static function queue($view, $data)
    {
        $keys = array('to','body','subject', 'bcc');
        $flag_keys = true;
        foreach($keys as $key)
        {
            if(!in_array($key, array_keys($data)))
                $flag_keys = false;
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
            $data['to'] = $to;
            $data['from'] = $from == 'default' ? $this->default_sender : $from;
            $data['subject'] = $subject;
            $data['body']   = $data;
            $data['bcc']     = $bcc;

            // to add to queue
            $mail = $this->queue($blade, $data);

            if($mail !== false) {
                $this->dispatch(new SendEmail($mail));
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


/*
    public function getlist()
    {
        $mailObj = MailModel::where('status',0)->limit($this->mail_job_count)->get()->toArray();
        if(count($mailObj))
        {
            $ids = array();
            $failed = array();
            foreach ($mailObj as $obj) 
            {
                $data = (array) json_decode($obj['data']);
                $return = json_decode($this->send($obj['view'], $data));
                if($return->status)
                    array_push($ids, $obj['id']);   
                else {
                    $temp['id'] = $obj['id'];
                    $temp['error'] = $return->message;
                    array_push($failed, $temp);
                }
            }

            // Update status of successfull sent mail
            if(count($ids))
            {
                $mailTable = (new MailModel())->getTable();
                DB::connection('auth')->table($mailTable)->whereIn('id', $ids)->update(array('status' => 1));
            }

            // Update status of failed sent mail
            if(count($failed))
            {
                foreach ($failed as $obj) {
                    $mail = MailModel::find($obj['id']);
                    $mail->error = $obj['error'];
                    $mail->save();
                }
            }
        }
        
    }
 */
}
