pipeline {
    agent {
        docker {
            image 'docker/compose:1.29.2'
            args '--user root'
        }
    }
    stages {
        stage('Build') {
            steps {
                sh 'docker-compose build app'
            }
        }
        // Add more stages as needed
    }
}
