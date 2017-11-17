@server(['web' => ])

@task('deploy')
    cd /var/www/master
    git pull origin master
    php artisan migrate:refresh
@endtask