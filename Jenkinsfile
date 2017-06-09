pipeline {
  agent any
  stages {
    stage('Test unitaires') {
      steps {
        echo 'Je suis test'
        sh '''docker run -v $PWD:/app --rm -it composer/composer install
docker run -v $PWD:/app --rm -it phpunit/phpunit -c phpunit.xml'''
      }
    }
    stage('Send notify') {
      steps {
        echo 'Cool sa marche'
      }
    }
  }
}