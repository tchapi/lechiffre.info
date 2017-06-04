<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

serverList('deploy/servers.yml');

// Configuration
set('default_stage', 'production');
set('repository', 'git@github.com:tchapi/lechiffre.info.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Add clear_paths
set('clear_paths', [
  './README.md',
  './deploy.php',
  './.gitignore',
  './.git',
  './deploy',
]);

// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');