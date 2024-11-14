<?php
include_once("E_Student.php");

class Model_Student {
    private $link;

    public function __construct() {
        $this->link = mysqli_connect("localhost", "root", "", "data") or die("Could not connect to database");
    }

    public function getAllStudent() {
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($this->link, $sql); 

        $students = []; 
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = new Entity_Student($row['id'], $row['name'], $row['age'], $row['university']);
        }         
        return $students;
    }

    public function getStudentDetail($stid) {
        $sql = "SELECT * FROM sinhvien WHERE id=$stid";
        $result = mysqli_query($this->link, $sql);

        $row = mysqli_fetch_assoc($result);
        if ($row) return new Entity_Student($row['id'], $row['name'], $row['age'], $row['university']);
        else return null;
    }

    public function addStudent($id,$name, $age, $university) {
        $sql = "INSERT INTO sinhvien(id,name, age, university) VALUES('$id','$name', $age, '$university')";
        mysqli_query($this->link, $sql);       
    }

    public function updateStudent($id, $name, $age, $university) {
        $sql = "UPDATE sinhvien SET name='$name', age=$age, university='$university' WHERE id=$id";
        mysqli_query($this->link, $sql);
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM sinhvien WHERE id=$id";
        mysqli_query($this->link, $sql);
    }

    public function searchStudent($searchType, $searchQuery) {
        $sql = "SELECT * FROM sinhvien WHERE $searchType LIKE '%$searchQuery%'";        $result = mysqli_query($this->link, $sql); 

        $students = []; 
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = new Entity_Student($row['id'], $row['name'], $row['age'], $row['university']);
        }         
        return $students;
    }
}
?>
