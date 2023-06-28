pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                // Checkout your Laravel application code from version control
                git 'https://github.com/teguh2910/simada.git'
            }
        }
        
        stage('Install Dependencies') {
            steps {
                // Install Laravel dependencies using Composer
                sh 'composer install'
            }
        }        
    }
}
