{{-- php vendor/bin/envoy run deploy --env=prod  --}}

@servers(['local' => '127.0.0.1', 'prod' => 'bdgt'])

@setup
    $env ??= 'local';
    $root = [
        'local' => '.',
        'prod' => '/var/www/bdgt',
    ][$env];

    function output($message) {
        return "echo '\033[32m" . $message . "\033[0m';";
    }
@endsetup

@story('setup')
    composer
    database
@endstory

@story('deploy')
    git
    composer
    artisan
@endstory

@task('git', ['on' => $env])
    {{ output('🌀 Updating code...') }}
    cd {{ $root }}
    git pull
@endtask

@task('composer', ['on' => $env])
    {{ output('🚚 Installing dependencies...') }}
    cd {{ $root }}
    composer install --no-interaction --prefer-dist {{ $env === 'prod' ? ' --optimize-autoloader --no-dev' : '' }}
@endtask

@task('database', ['on' => 'local'])
    {{ output('🔨 Migrating and seeding the DB...') }}
    php artisan migrate --seed
@endtask

@task('artisan', ['on' => 'prod', 'confirm' => true])
    {{ output('✨ Migrating and optimizing...') }}
    cd {{ $root }}
    php artisan migrate --force

    php artisan config:cache
    php artisan route:trans:cache
    php artisan view:cache
@endtask
