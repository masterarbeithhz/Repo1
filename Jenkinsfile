pipeline {

  environment {
    registryCredential = 'dockerhub'
  }
  
  agent any

  stages {

    stage('Checkout Source') {
      steps {
        git url:'https://github.com/masterarbeithhz/Repo1.git', branch:'main'
      }
    }
    
      stage("Build image") {
            steps {
                script {
                    myapp = docker.build("masterarbeithhz/pipelinetest2:${env.BUILD_ID}")
                }
            }
        }
    
      stage("Push image") {
            steps {
                script {
                    docker.withRegistry('https://registry.hub.docker.com', registryCredential) {
                            myapp.push("latest")
                            myapp.push("${env.BUILD_ID}")
                    }
                }
            }
        }

    
    stage('Deploy App') {
      steps {
        script {
          kubernetesDeploy(configs: "landingpage.yaml", kubeconfigId: "mykubeconfig1")
        }
      }
    }

  }

}
