<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function show(Request $request, string $path)
    {
        SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());
        $driver = Storage::disk(config('filesystems.default'))->getDriver();

        $server = ServerFactory::create([
            'source' => $driver,
            'cache' => Storage::disk('local')->getDriver(),
            'driver' => 'imagick',
            'cache_path_prefix' => '.cache',
            'response' => new LaravelResponseFactory(),
            'base_url' => 'images',
        ]);

        return $server->getImageResponse($path, $request->all());
    }
}
