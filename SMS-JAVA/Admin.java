import java.util.List;

public class Admin extends Users {
    private String adminLevel;
    private List<Student> students;
    private List<Parent> parents;

    public void manageRegistration() {
        System.out.println("manageRegistration() called successfully");
    }

    public void manageAttendance() {
        System.out.println("manageAttendance() called successfully");
    }

    public void generateReports() {
        System.out.println("generateReports() called successfully");
    }

    public void notifyStudent() {
        System.out.println("notifyStudent() called successfully");
    }
}
