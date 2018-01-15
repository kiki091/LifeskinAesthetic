<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Models\Mail\MailJobs as MailModel;
use App\Services\Mail\MailSender as MailService;

class SendEmail extends Job implements ShouldQueue, SelfHandling
{
    use InteractsWithQueue, SerializesModels;

    protected $mail_job_count = 50;
    protected $mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailModel $mail)
    {
        $this->mail = $mail;
        //$this->mail_job_count = Config::has('mail_job.count') ? config('mail_job.count') : 50;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ==
        $mail = $this->mail;

        $view = $mail->view;
        $data = (array) json_decode($mail->data);
        // sending the mail, get the return, flag as success or not by return value of sent mail
        $return = json_decode(MailService::send($view, $data));
        if($return->status)
            $mail->status = 1;
        else
            $mail->error = $return->message;
        $mail->save();
        // ======== END OF =================

        /* ==================== FOR FUTURE REFERENCE, BATCH SEND EMAIL =========================
        $mailObj = MailModel::where('status',0)->limit($this->mail_job_count)->get()->toArray();
        if(count($mailObj))
        {
            foreach ($mailObj as $obj)
            {
                $data = (array) json_decode($obj['data']);
                // sending the mail, get the return, flag as success or not by return value of sent mail
                $return = json_decode(Mail::send($obj['view'], $data));
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
        }*/
    }


    public function failed()
    {
        // Called when the job is failing...

    }
}
