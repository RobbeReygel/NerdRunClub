@servers(['web' => 'deployrobot@172.104.132.227'])

@task('deploy', ['on' => 'web'])
    exec ssh-agent bash
    ssh-add ~/.ssh/git
    cd /home/nerdrunners
    git pull origin master
    php artisan migrate:refresh
@endtask