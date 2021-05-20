<?php

namespace Bastinald\UI\Traits;

use Illuminate\Filesystem\Filesystem;

trait MakesStubs
{
    public function makeStub($path, $stub, $replaces)
    {
        $filesystem = new Filesystem;
        $contents = $filesystem->get(__DIR__ . '/../../resources/stubs/' . $stub);

        foreach ($replaces as $search => $replace) {
            $contents = str_replace($search, $replace, $contents);
        }

        $filesystem->ensureDirectoryExists(dirname($path));
        $filesystem->put($path, $contents);
    }
}
