import java.util.List;

public class Parent extends Users {
    private List<Student> children;
    private Teacher teacher;
    private Admin admin;

    public void viewChildAttendance() {
        System.out.println("viewChildAttendance() called successfully");
    }

    public void viewChildPerformance() {
        System.out.println("viewChildPerformance() called successfully");
    }
}
