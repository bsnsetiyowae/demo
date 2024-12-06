@servers(['localhost' => '127.0.0.1'])

@story('build')
    update-code
    install-dependencies
    clean_up
    optimize
@endstory

@task('clean_up')
    {{-- php artisan cache:table --}}
    {{-- php artisan event:clear --}}
    {{-- php artisan queue:clear --}}
    php artisan clear-compiled
    php artisan optimize:clear
    php artisan cache:clear
    php artisan route:trans:clear
    php artisan config:clear
    php artisan view:clear

    {{-- php artisan auth:clear-resets --}}
    {{-- php artisan media-library:clean article --dry-run --force --}}

    {{-- php artisan octane:reload --}}
@endtask

@task('optimize')
    php artisan optimize
    php artisan route:trans:cache
    php artisan config:cache
    php artisan view:cache
@endtask

@task('update-code')
    git pull origin main || echo "-- Git pull failed --"
    echo "-- Done --"
@endtask

@task('install-dependencies')
    npm run prod --silent

    {{-- composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --}}

    {{-- php artisan migrate --force --}}
@endtask
