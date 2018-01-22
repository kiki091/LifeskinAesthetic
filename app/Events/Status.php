<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Status implements ShouldBroadcast
{
	use InteractsWithSockets, SerializesModels;
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    private $channelId;
    private $data;


    public function __construct($channelId)
	{
        $this->doExecThings();
        $this->channelId = $channelId;
	}


	public function doExecThings()
	{
        $start = microtime(true);
        //if(file_exists(public_path('Test.class')))
        if(file_exists(public_path('testReflection.jar')))
        {
            //$output = exec('java Test',$ret);

            $output = exec('java -jar '. public_path('testReflection.jar').' amdocs.amsp.services.CustomerFacade getCustomerDetail "[{\"name\": \"custAcct\",\"type\": \"java.lang.String\",\"value\": \"20037734\"},{\"name\": \"siteId\",\"type\": \"java.lang.String\",\"value\": \"<AMSPSiteId>\"},{\"name\": \"skipPayCard\", \"type\": \"java.lang.Boolean\", \"value\": \"true\"},{\"name\": \"corp\", \"type\": \"java.lang.String\", \"value\": \"<AMSPCorp>\"},{\"name\": \"ticket\", \"type\": \"java.lang.String\", \"value\": \"<AMSPTicket>\"}]" 2>&1', $ret);

            $end = microtime(true);
            $execution_time =  ($end - $start);
            $data['java_output'] = $output;
            $data['php_output'] = $execution_time;
            $this->data = $data;
        }
	}

	public function broadcastWith()
	{
		return $this->data;
	}

    public function broadcastOn()
    {
    	return new Channel($this->channelId);
        //return new PrivateChannel('order.'.$this->update->order_id);
    }

    public function broadcastAs() {
        return 'myevent';
    }
}