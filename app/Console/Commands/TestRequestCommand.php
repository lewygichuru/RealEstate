<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestRequestCommand extends Command
{
    protected $signature = 'test:request';
    protected $description = 'Test a request';

    public function handle()
    {
        $user = User::first();
        Auth::login($user);

        try {
            $albums = Album::latest('created_at')->with('files')->get();
            $html = view('admin.galleries.album', [
                'albums' => $albums, 
                'errors' => new \Illuminate\Support\ViewErrorBag()
            ])->render();
            $this->info("RENDERED OK! Length: " . strlen($html));
        } catch (\Throwable $e) {
            $this->error("ERROR: " . $e->getMessage());
            $this->error("File: " . $e->getFile() . ":" . $e->getLine());
        }
    }
}
