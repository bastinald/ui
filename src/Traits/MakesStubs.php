<?php

namespace Bastinald\Ui\Traits;

use Illuminate\Filesystem\Filesystem;

trait MakesStubs
{
    public $stubReplaces = [];

    public function makeStub($path, $stub)
    {
        $filesystem = new Filesystem;
        $contents = $filesystem->get(config('ui.stub_path') . $stub);

        foreach ($this->stubReplaces as $search => $replace) {
            $contents = str_replace($search, $replace, $contents);
        }

        $filesystem->ensureDirectoryExists(dirname($path));
        $filesystem->put($path, $contents);
    }
}
