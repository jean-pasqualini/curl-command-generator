pipeline {
  agent any
  stages {
    stage('Test unitaires') {
      steps {
        echo 'Je suis test'
        sh '''docker run -v $PWD:/app --rm -i composer/composer install
docker run -v $PWD:/app --rm -i phpunit/phpunit:5.0.3 -c phpunit.xml'''
      }
    }
    stage('Send notify') {
      steps {
        echo 'Cool sa marche'
      }
    }
  }
}
