import java.util.List;

public class AcademicRecord {
    private int recordId;
    private List<String> subjects;
    private List<String> grades;
    private double GPA;
    private double attendancePercentage;

    public double calculateGPA() {
        System.out.println("calculateGPA() called successfully");
        return 0.0;
    }

    public void addSubjectGrade(String subject, String grade) {
        System.out.println("addSubjectGrade() called successfully");
    }

    public double getAttendance() {
        System.out.println("getAttendance() called successfully");
        return 0.0;
    }
}
