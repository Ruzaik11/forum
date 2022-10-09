
pipeline {
    agent {
        node {
            label forum-node
            customWorkspace '/home/ruzaik/custom/'
        }
    }
    stages {
        stage('Example') {
            steps {
                echo 'Hello World'
            }
        }
    }
}
