
pipeline {
    agent {
        node {
            label forum-node
            customWorkspace '/home/ruzaik/custom/'
        }
    }
    stages {
        stage('Hello') {
            steps {
                sh ls -a 
            }
        }
    }
}
