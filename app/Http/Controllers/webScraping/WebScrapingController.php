<?php

namespace App\Http\Controllers\webScraping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Storage;

class WebScrapingController extends Controller
{
    public function scraping(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://eg.opensooq.com/ar/find?PostSearch[categoryId]=1253&PostSearch[term]=');
        $data = [];

        $crawler->filter('#listing_posts > .relative a')->each(function($q) use(&$data) {
            $data[] = ['titel' => $q->text()];
        });

        $result = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // conviert data to json
        file_put_contents(public_path('Data.json') , $result); // if you want to put data  on public file
        Storage::disk('public')->append('Data.json',$result); // if you want to put data  on storage file

        return 'data submited';

    }

    public function getDataFromJsonFile() {
        $handle = fopen(public_path('Data.json'), 'r');
        $object;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $object = json_decode($line);
            }
            fclose($handle);
            return $object;
        } else {
            return 'something wrong';
        }
    }

}
