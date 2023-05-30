<?php

namespace App\Handler;
use \Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Auth;
use DB;
use Carbon\Carbon;

class WebhookOrderHandler extends ProcessWebhookJob{

    public function handle(){ 
        logger($this->webhookCall);
    }
}