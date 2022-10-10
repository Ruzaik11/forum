
pipeline {
    agent none
    stages {
        stage('Build') {
            agent {
                node {
                    label 'forum-node'
                    customWorkspace '/var/www/html/forum/dev'
                }
            }
            steps {

               sh 'composer update' // updating composer
               sh 'php artisan key:generate' //generating app key
               sh 'chmod -R 777 storage bootstrap/cache' //chaning the storage folder permission

               sh 'mkdir -p database' // creating database folder
               sh 'touch database/database.sqlite' //creating sqllite database

               /* Updating Env File With Testing Database Details */
               sh "sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env"
               sh "sed -i 's|DB_DATABASE=laravel|DB_DATABASE=database/database.sqlite|' .env"

            }
        }
        stage('test'){
            agent {
                node {
                    label 'forum-node'
                    customWorkspace '/var/www/html/forum/dev'
                }
            }
            steps{
                
               sh 'php artisan key:generate' //generating app key
               sh 'vendor/bin/phpunit' //running php unit test
                
            }
        }
        stage('deploy'){
            agent {
                node {
                    label 'forum-node'
                    customWorkspace '/var/www/html/forum/prod'
                }
            }
            steps {

               sh 'composer update' // updating composer
               sh 'php artisan key:generate' //generating app key
               sh 'chmod -R 777 storage bootstrap/cache' //chaning the storage folder permission

               sh 'mkdir -p database' // creating database folder
               sh 'touch database/database.sqlite' //creating sqllite database

               /* Updating Env File With Testing Database Details */
               sh "sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env"
               sh "sed -i 's|DB_DATABASE=laravel|DB_DATABASE=database/database.sqlite|' .env"

            }
        }
    }
}
