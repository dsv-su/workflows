<?php

namespace App\Listeners;

use App\Mail\DSVNews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDSVInfoNotification
{
    /**
     * Create the event listener.
     */

    protected $file;


    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $news = $event;
        if($news->entry->email_dsv and $news->entry->locale == 'English') {
            Mail::to($this->adress())->send(new DSVNews($news));
        }


    }

    private function adress()
    {
        $this->file = base_path() . '/systemconfig/internt.ini';
        if (!file_exists($this->file)) {
            $this->file = base_path() . '/systemconfig/internt.ini.example';
        }
        $this->system_config = parse_ini_file($this->file, true);

        return $this->system_config['email']['dsv_info'];
    }
}
