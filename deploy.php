<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'ShineBoard');

// Project repository
set('repository', 'https://github.com/ShineBoard/shineboard.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);
// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('shineboard.io')
    ->set('user', 'deploy')
    ->set('deploy_path', '/var/www/shineboard.io');

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

task('reload:php-fpm', function () {
    run('sudo /usr/sbin/service php7.3-fpm reload');
});

after('deploy', 'reload:php-fpm');
