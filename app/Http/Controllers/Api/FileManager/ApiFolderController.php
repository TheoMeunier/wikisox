<?php

namespace App\Http\Controllers\Api\FileManager;

use App\Http\Requests\FolderCreateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ApiFolderController extends AbstractFileManagerController
{
    /**
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(string $folder)
    {
        $this->filesysteme()->deleteDirectory($folder);

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function index(Request $request): Collection
    {
        $parent = (string) $request->query->get('parent', null);

        if (in_array(trim($parent), ['', 'null'])) {
            $parent = null;
        }

        $directories = $this->filesysteme()->directories($parent);

        return collect($directories)->map([$this, 'toArray']);
    }

    public function store(FolderCreateRequest $request): array
    {
        /** @var array $data */
        $data = $request->validated();
        $path = ($data['parent'] ?? '').'/'.$data['name'];
        $this->filesysteme()->makeDirectory($path);

        return $this->toArray(trim($path, '/'));
    }

    public function toArray(string $folders): array
    {
        $pathinfo = pathinfo($folders);

        return [
            'id'     => $folders,
            'name'   => $pathinfo['filename'],
            'parent' => pathinfo_dirname($pathinfo),
        ];
    }
}
