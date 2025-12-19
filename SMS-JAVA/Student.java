import java.util.List;

public class Student extends Users {
    private String grade;
    private String attendance;
    private List<AcademicRecord> academicRecords;
    private Teacher teacher;
    private Admin admin;

    public void viewAcademicRecord() {
        System.out.println("viewAcademicRecord() called successfully");
    }

    public void viewAttendance() {
        System.out.println("viewAttendance() called successfully");
    }

    public void viewGrade() {
        System.out.println("viewGrade() called successfully");
    }
}
