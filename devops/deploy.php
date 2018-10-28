<?php

namespace Deployer;

require 'recipe/common.php';
require 'slack.php';

// Laravel shared dirs
set('shared_dirs', [
    'storage',
]);
// Laravel shared file
set('shared_files', [
    '.env',
]);
// Laravel writable dirs
set('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);
set('laravel_version', function () {
    $result = run('{{bin/php}} {{release_path}}/backend/artisan --version');
    preg_match_all('/(\d+\.?)+/', $result, $matches);
    $version = $matches[0][0] ?? 5.5;
    return $version;
});
/**
 * Helper tasks
 */
desc('Disable maintenance mode');
task('artisan:up', function () {
    $output = run('if [ -f {{deploy_path}}/current/backend/artisan ]; then {{bin/php}} {{deploy_path}}/current/backend/artisan up; fi');
    writeln('<info>' . $output . '</info>');
});
desc('Enable maintenance mode');
task('artisan:down', function () {
    $output = run('if [ -f {{deploy_path}}/current/backend/artisan ]; then {{bin/php}} {{deploy_path}}/current/artisan down; fi');
    writeln('<info>' . $output . '</info>');
});
desc('Execute artisan migrate');
task('artisan:migrate', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan migrate --force');
})->once();
desc('Execute artisan migrate:fresh');
task('artisan:migrate:fresh', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan migrate:fresh --force');
});
desc('Execute artisan migrate:rollback');
task('artisan:migrate:rollback', function () {
    $output = run('{{bin/php}} {{release_path}}/backend/artisan migrate:rollback --force');
    writeln('<info>' . $output . '</info>');
});
desc('Execute artisan migrate:status');
task('artisan:migrate:status', function () {
    $output = run('{{bin/php}} {{release_path}}/backend/artisan migrate:status');
    writeln('<info>' . $output . '</info>');
});
desc('Execute artisan db:seed');
task('artisan:db:seed', function () {
    $output = run('{{bin/php}} {{release_path}}/backend/artisan db:seed --force');
    writeln('<info>' . $output . '</info>');
});
desc('Execute artisan cache:clear');
task('artisan:cache:clear', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan cache:clear');
});
desc('Execute artisan config:cache');
task('artisan:config:cache', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan config:cache');
});
desc('Execute artisan route:cache');
task('artisan:route:cache', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan route:cache');
});
desc('Execute artisan view:clear');
task('artisan:view:clear', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan view:clear');
});
desc('Execute artisan optimize');
task('artisan:optimize', function () {
    $deprecatedVersion = 5.5;
    $currentVersion = get('laravel_version');
    if (version_compare($currentVersion, $deprecatedVersion, '<')) {
        run('{{bin/php}} {{release_path}}/backend/artisan optimize');
    }
});
desc('Execute artisan queue:restart');
task('artisan:queue:restart', function () {
    run('{{bin/php}} {{release_path}}/backend/artisan queue:restart');
});
desc('Execute artisan storage:link');
task('artisan:storage:link', function () {
    $needsVersion = 5.3;
    $currentVersion = get('laravel_version');
    if (version_compare($currentVersion, $needsVersion, '>=')) {
        run('{{bin/php}} {{release_path}}/backend/artisan storage:link');
    }
});
/**
 * Task deploy:public_disk support the public disk.
 * To run this task automatically, please add below line to your deploy.php file
 *
 *     before('deploy:symlink', 'deploy:public_disk');
 *
 * @see https://laravel.com/docs/5.2/filesystem#configuration
 */
desc('Make symlink for public disk');
task('deploy:public_disk', function () {
    // Remove from source.
    run('if [ -d $(echo {{release_path}}/backend/public/storage) ]; then rm -rf {{release_path}}/backend/public/storage; fi');
    // Create shared dir if it does not exist.
    run('mkdir -p {{deploy_path}}/shared/storage/app/public');
    // Symlink shared dir to release dir
    run('{{bin/symlink}} {{deploy_path}}/shared/storage/app/public {{release_path}}/backend/public/storage');
});

/**
 * Main task
 */
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared:backend',
    'deploy:vendors:backend',
    'deploy:writable:backend',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:update:hook',
    'deploy:build:frontent',
    'deploy:passport:install',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);
after('deploy', 'success');

set('slack_webhook', 'https://hooks.slack.com/services/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');

set('slack_text', 'Starting Homolog Deploy...');

set('slack_success_text', 'Homolog Deploy Done!');

set('slack_failure_text', 'Homolog Deploy Failed!');

before('deploy', 'slack:notify');

after('success', 'slack:notify:success');

after('deploy:failed', 'slack:notify:failure');

// Project name
set('application', 'e-DefPR');

// Project repository
set('repository', 'git@github.com:C3DSU/e-DefPR.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', true);

// Deploy Path
set('deploy_path', '/var/www/html/{{application}}');
    
// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

// Restart PHP FPM
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    run('sudo systemctl restart php7.2-fpm.service');
});

// Build frontend
desc('Build frontent');
task('deploy:build:frontent', function () {
    run('cd {{release_path}}/frontend/ && yarn install && sudo rm -rf build/ && yarn build');
});

// Passport install
desc('Passport install');
task('deploy:passport:install', function () {
    run('cd {{release_path}}/backend/ && php artisan passport:install');
});

// Update hook
desc('Update hook');
task('deploy:update:hook', function () {
    run('cd {{release_path}}/devops/hook/ && yarn install');
});

// Restart PHP FPM after deploy
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

// Common Refactored
desc('Installing vendors');
task('deploy:vendors:backend', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}}/backend/ && {{bin/composer}} {{composer_options}}');
});

desc('Make writable dirs');
task('deploy:writable:backend', function () {
    $dirs = join(' ', get('writable_dirs'));
    $mode = get('writable_mode');
    $sudo = get('writable_use_sudo') ? 'sudo' : '';
    $httpUser = get('http_user', false);
    $runOpts = [];
    if ($sudo) {
        $runOpts['tty'] = get('writable_tty', false);
    }
    if (empty($dirs)) {
        return;
    }
    if ($httpUser === false && ! in_array($mode, ['chgrp', 'chmod'], true)) {
        // Detect http user in process list.
        $httpUser = run("ps axo comm,user | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | awk '{print $2}'");
        if (empty($httpUser)) {
            throw new \RuntimeException(
                "Can't detect http user name.\n" .
                "Please setup `http_user` config parameter."
            );
        }
    }
    try {
        cd('{{release_path}}/backend/');
        // Create directories if they don't exist
        run("mkdir -p $dirs");
        if ($mode === 'chown') {
            // Change owner.
            // -R   operate on files and directories recursively
            // -L   traverse every symbolic link to a directory encountered
            run("$sudo chown -RL $httpUser $dirs", $runOpts);
        } elseif ($mode === 'chgrp') {
            // Change group ownership.
            // -R   operate on files and directories recursively
            // -L   if a command line argument is a symbolic link to a directory, traverse it
            $httpGroup = get('http_group', false);
            if ($httpGroup === false) {
                throw new \RuntimeException("Please setup `http_group` config parameter.");
            }
            run("$sudo chgrp -RH $httpGroup $dirs", $runOpts);
        } elseif ($mode === 'chmod') {
            $recursive = get('writable_chmod_recursive') ? '-R' : '';
            run("$sudo chmod $recursive {{writable_chmod_mode}} $dirs", $runOpts);
        } elseif ($mode === 'acl') {
            if (strpos(run("chmod 2>&1; true"), '+a') !== false) {
                // Try OS-X specific setting of access-rights
                run("$sudo chmod +a \"$httpUser allow delete,write,append,file_inherit,directory_inherit\" $dirs", $runOpts);
                run("$sudo chmod +a \"`whoami` allow delete,write,append,file_inherit,directory_inherit\" $dirs", $runOpts);
            } elseif (commandExist('setfacl')) {
                if (!empty($sudo)) {
                    run("$sudo setfacl -RL -m u:\"$httpUser\":rwX -m u:`whoami`:rwX $dirs", $runOpts);
                    run("$sudo setfacl -dRL -m u:\"$httpUser\":rwX -m u:`whoami`:rwX $dirs", $runOpts);
                } else {
                    // When running without sudo, exception may be thrown
                    // if executing setfacl on files created by http user (in directory that has been setfacl before).
                    // These directories/files should be skipped.
                    // Now, we will check each directory for ACL and only setfacl for which has not been set before.
                    $writeableDirs = get('writable_dirs');
                    foreach ($writeableDirs as $dir) {
                        // Check if ACL has been set or not
                        $hasfacl = run("getfacl -p $dir | grep \"^user:$httpUser:.*w\" | wc -l");
                        // Set ACL for directory if it has not been set before
                        if (!$hasfacl) {
                            run("setfacl -RL -m u:\"$httpUser\":rwX -m u:`whoami`:rwX $dir");
                            run("setfacl -dRL -m u:\"$httpUser\":rwX -m u:`whoami`:rwX $dir");
                        }
                    }
                }
            } else {
                throw new \RuntimeException("Can't set writable dirs with ACL.");
            }
        } else {
            throw new \RuntimeException("Unknown writable_mode `$mode`.");
        }
    } catch (\RuntimeException $e) {
        $formatter = Deployer::get()->getHelper('formatter');
        $errorMessage = [
            "Unable to setup correct permissions for writable dirs.                  ",
            "You need to configure sudo's sudoers files to not prompt for password,",
            "or setup correct permissions manually.                                  ",
        ];
        write($formatter->formatBlock($errorMessage, 'error', true));
        throw $e;
    }
});

desc('Creating symlinks for shared files and dirs');
task('deploy:shared:backend', function () {
    $sharedPath = "{{deploy_path}}/shared";
    // Validate shared_dir, find duplicates
    foreach (get('shared_dirs') as $a) {
        foreach (get('shared_dirs') as $b) {
            if ($a !== $b && strpos(rtrim($a, '/') . '/', rtrim($b, '/') . '/') === 0) {
                throw new Exception("Can not share same dirs `$a` and `$b`.");
            }
        }
    }
    foreach (get('shared_dirs') as $dir) {
        // Check if shared dir does not exist.
        if (!test("[ -d $sharedPath/$dir ]")) {
            // Create shared dir if it does not exist.
            run("mkdir -p $sharedPath/$dir");
            // If release contains shared dir, copy that dir from release to shared.
            if (test("[ -d $(echo {{release_path}}/backend/$dir) ]")) {
                run("cp -rv {{release_path}}/backend/$dir $sharedPath/" . dirname(parse($dir)));
            }
        }
        // Remove from source.
        run("rm -rf {{release_path}}/backend/$dir");
        // Create path to shared dir in release dir if it does not exist.
        // Symlink will not create the path and will fail otherwise.
        run("mkdir -p `dirname {{release_path}}/backend/$dir`");
        // Symlink shared dir to release dir
        run("{{bin/symlink}} $sharedPath/$dir {{release_path}}/backend/$dir");
    }
    foreach (get('shared_files') as $file) {
        $dirname = dirname(parse($file));
        // Create dir of shared file
        run("mkdir -p $sharedPath/" . $dirname);
        // Check if shared file does not exist in shared.
        // and file exist in release
        if (!test("[ -f $sharedPath/$file ]") && test("[ -f {{release_path}}/backend/$file ]")) {
            // Copy file in shared dir if not present
            run("cp -rv {{release_path}}/backend/$file $sharedPath/$file");
        }
        // Remove from source.
        run("if [ -f $(echo {{release_path}}/backend/$file) ]; then rm -rf {{release_path}}/backend/$file; fi");
        // Ensure dir is available in release
        run("if [ ! -d $(echo {{release_path}}/backend/$dirname) ]; then mkdir -p {{release_path}}/backend/$dirname;fi");
        // Touch shared
        run("touch $sharedPath/$file");
        // Symlink shared dir to release dir
        run("{{bin/symlink}} $sharedPath/$file {{release_path}}/backend/$file");
    }
});
