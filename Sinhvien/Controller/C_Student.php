<?php
include_once("../Model/M_Student.php");

class Controller_Student {
    private $model;

    public function __construct() {
        $this->model = new Model_Student();
    }

    public function invoke() {   
        $action = $_GET['action'] ?? null;

        switch ($action) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $age = $_POST['age'];
                    $university = $_POST['university'];
                    $this->model->addStudent($name, $age, $university);
                    header("Location: ../index.php");
                } else {
                    include_once("../View/AddStudent.html");
                }
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $age = $_POST['age'];
                    $university = $_POST['university'];
                    $this->model->updateStudent($id, $name, $age, $university);
                    header("Location: ../Controller/C_Student.php?action=update");
                }
                else if(isset($_GET['id']))
                {
                    $student = $this->model->getStudentDetail($_GET['id']);
                    include_once("../View/Update/UpdateForm.html");
                }
                else
                {
                    $studentList = $this->model->getAllStudent();
                    include_once("../View/Update/UpdateList.html");
                }
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $this->model->deleteStudent($_GET['id']);                    
                } 
                $studentList = $this->model->getAllStudent(); 
                include_once("../View/DeleteStudent.html");                
                break;

                case 'search':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $searchType = $_POST['searchType'];
                        $searchQuery = $_POST['searchQuery'];
                        $studentList = $this->model->searchStudent($searchType, $searchQuery);
                        include_once("../View/SearchStudent.html");
                    } else {
                        include_once("../View/SearchStudent.html");
                    }
                    break;
                

            default:
                if (isset($_GET['id'])) {
                    $student = $this->model->getStudentDetail($_GET['id']);
                    include_once("../View/StudentDetail.html");
                } else {
                    $studentList = $this->model->getAllStudent();
                    include_once("../View/StudentList.html");
                }                
                break;
        }        
    }
}

$C_Student = new Controller_Student();
$C_Student->invoke();
?>
