import java.util.List;

public class Teacher extends Users {
    private String specialization;
    private String department;
    private List<Student> students;
    private List<Parent> parents;

    public void manageStudentProfile() {
        System.out.println("manageStudentProfile() called successfully");
    }

    public void manageStudentRecord() {
        System.out.println("manageStudentRecord() called successfully");
    }

    public void enterGrade() {
        System.out.println("enterGrade() called successfully");
    }

    public void generateReport() {
        System.out.println("generateReport() called successfully");
    }

    public void manageAttendance() {
        System.out.println("manageAttendance() called successfully");
    }
}
