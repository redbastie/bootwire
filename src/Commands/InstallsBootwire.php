<?php

namespace Redbastie\Bootwire\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class InstallsBootwire extends Command
{
    protected $signature = 'bootwire:install';

    public function handle()
    {
        $filesystem = new Filesystem;

        // create files
        foreach ($filesystem->allFiles(__DIR__ . '/../../stubs/files') as $file) {
            $filesystem->ensureDirectoryExists(base_path($file->getRelativePath()));
            $path = Str::replaceLast('.stub', '', $file->getRelativePathname());
            $filesystem->put($path, $file->getContents());
        }

        // insert routes
        $routePath = base_path('routes/web.php');
        $routeContents = rtrim($filesystem->get($routePath));
        $routeStub = rtrim($filesystem->get(__DIR__ . '/../../stubs/routes.php.stub'));

        if (!Str::contains($routeContents, $routeStub)) {
            $filesystem->put($routePath, $routeContents . PHP_EOL . PHP_EOL . $routeStub . PHP_EOL);
        }

        // add packages
        $packagePath = base_path('package.json');
        $packageArray = json_decode($filesystem->get($packagePath), true);
        $packageArray['devDependencies']['alpinejs'] = '^2.6';
        $packageArray['devDependencies']['bootstrap'] = '^4.0.0';
        $packageArray['devDependencies']['jquery'] = '^3.2';
        $packageArray['devDependencies']['popper.js'] = '^1.12';
        $packageArray['devDependencies']['sass'] = '^1.15.2';
        $packageArray['devDependencies']['sass-loader'] = '^8.0.0';
        ksort($packageArray['devDependencies']);
        $filesystem->put($packagePath, json_encode($packageArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        $this->info('🚀 Bootwire installed!');

        if ($this->confirm('Run <comment>npm install && npm run dev</comment> now?')) {
            exec('npm install && npm run dev');
        }
    }
}
