<?php

namespace Database\Seeders;

use App\Models\file_uploads;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/image');


        for($j = 0; $j < 50; $j++) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $picture = rand(1,14);
            $path = "http://127.0.0.1:8000/images/seeds/{$picture}.jpg";
            $img = Image::make($path)->resize(300,200)->encode('jpg');

            $now = Carbon::now()->toDateTimeString();   

            $hash = md5($img->__toString().$now);

            Storage::put("/public/image/{$hash}.jpg",$img);

            $file = file_uploads::create([
                'name' => $picture,
                'extension' => 'jpg',
                'path' => "/storage/image/{$hash}.jpg",
                'real_path' => "/public/image/{$hash}.jpg"
            ]);
            $date = rand(2020,2021);
            $user = rand(1,2);
            $approved = rand(0,1);
            $price = rand(100,1000);
            $discount= rand(0,100);
            DB::table('books')->insert([
                'title' => $randomString,
                'description' =>  $randomString . $randomString . $randomString,
                'created_at' => date($date . '-m-d H:i:s'),
                'user_id' => $user,
                'Approved' => $approved,
                'price' => $price,
                'discount' => $discount,
                'file_upload_id' => $file->id
            ]);
            $times = rand(1,5);
            for ($i = 0; $i < $times; $i++) {
                $id = rand(1,10);
                db::table('book_authors')->insert([
                    'book_id' => $j+1,
                    'author_id' => $id
                ]);
                db::table('book_genres')->insert([
                    'book_id' => $j+1,
                    'genre_id' => $id
                ]);
            }
        }
    }
}
