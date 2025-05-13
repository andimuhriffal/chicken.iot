pipeline {
    agent any

    environment {
        DEPLOY_DIR = '/var/www/chicken.io'
    }

    stages {
        stage('Deploy to Production Folder') {
            steps {
                sh '''
                    sudo rsync -av --delete --exclude=".env" --exclude="vendor" --exclude="node_modules" ./ ${DEPLOY_DIR}/
                '''
            }
        }

        stage('Set Permissions') {
            steps {
                sh '''
                    sudo chown -R www-data:www-data ${DEPLOY_DIR}
                    sudo chmod -R 775 ${DEPLOY_DIR}/storage ${DEPLOY_DIR}/bootstrap/cache
                '''
            }
        }

        stage('Laravel Artisan Commands') {
            steps {
                sh '''
                    cd ${DEPLOY_DIR}
                    php artisan config:cache
                    php artisan route:cache
                    php artisan view:cache
                '''
            }
        }
    }
}
