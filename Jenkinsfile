pipeline {
  agent any
  stages {
    stage('Test unitaires') {
      steps {
        parallel(
          "Test unitaires": {
            echo 'Je suis test'
            sh '''current_workspace=$(echo $PWD | sed "s|/var/jenkins_home/workspace|$HOST_WORKSPACE|g")
docker run -v $current_workspace:/app --rm -i composer/composer install
docker run -v $current_workspace:/app --rm -i phpunit/phpunit:5.0.3 -c phpunit.xml'''
            
          },
          "aaaaaaa": {
            echo 'aaaaaaaaaa'
            
          },
          "bbb": {
            echo 'bbbbbbbbbb'
            
          }
        )
      }
    }
    stage('Send notify') {
      steps {
        echo 'Cool sa marche'
      }
    }
  }
}