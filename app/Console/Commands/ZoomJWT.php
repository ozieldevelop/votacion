<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ZoomJWT extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
  
  
  private function generateZoomToken()
  {
      $key = env('ZOOM_API_KEY', '');
      $secret = env('ZOOM_API_SECRET', '');
      $payload = [
          'iss' => $key,
          'exp' => strtotime('+1 minute'),
      ];
      return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
  }
  
  
  private function retrieveZoomUrl()
  {
      return env('ZOOM_API_URL', '');
  }
  
  private function zoomRequest()
  {
      $jwt = $this->generateZoomToken();
      return \Illuminate\Support\Facades\Http::withHeaders([
          'authorization' => 'Bearer ' . $jwt,
          'content-type' => 'application/json',
      ]);
  }  
  
 
  public function zoomGet(string $path, array $query = [])
  {
      $url = $this->retrieveZoomUrl();
      $request = $this->zoomRequest();
      return $request->get($url . $path, $query);
  }

  public function zoomPost(string $path, array $body = [])
  {
      $url = $this->retrieveZoomUrl();
      $request = $this->zoomRequest();
      return $request->post($url . $path, $body);
  }

  public function zoomPatch(string $path, array $body = [])
  {
      $url = $this->retrieveZoomUrl();
      $request = $this->zoomRequest();
      return $request->patch($url . $path, $body);
  }

  public function zoomDelete(string $path, array $body = [])
  {
      $url = $this->retrieveZoomUrl();
      $request = $this->zoomRequest();
      return $request->delete($url . $path, $body);
  }
  
   public function toZoomTimeFormat(string $dateTime)
  {
      try {
          $date = new \DateTime($dateTime);
          return $date->format('Y-m-d\TH:i:s');
      } catch(\Exception $e) {
          Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
          return '';
      }
  }

  public function toUnixTimeStamp(string $dateTime, string $timezone)
  {
      try {
          $date = new \DateTime($dateTime, new \DateTimeZone($timezone));
          return $date->getTimestamp();
      } catch (\Exception $e) {
          Log::error('ZoomJWT->toUnixTimeStamp : ' . $e->getMessage());
          return '';
      }
  } 
}
