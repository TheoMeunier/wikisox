<?php

namespace App\Http\Controllers;

use App\Services\Glide\GlideImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function show(Request $request, string $path): mixed
    {
        try {
            SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());
            $driver = GlideImageService::getDriver();

            $server = ServerFactory::create([
                'source'            => $driver,
                'cache'             => Storage::disk('local')->getDriver(),
                'driver'            => 'imagick',
                'cache_path_prefix' => '.cache',
                'response'          => new LaravelResponseFactory(),
                'base_url'          => 'images',
            ]);

            return $server->getImageResponse($path, $request->all());
        } catch (SignatureException $e) {
            abort(403);
        }
    }
}
