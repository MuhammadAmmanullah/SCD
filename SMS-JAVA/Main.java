


public class Main {
    public static void main(String[] args) {
        Student student = new Student();
        Teacher teacher = new Teacher();
        Admin admin = new Admin();
        Parent parent = new Parent();
        AcademicRecord record = new AcademicRecord();
        Book book = new Book();
        Library library = new Library();
        Librarian librarian = new Librarian();

        student.viewAcademicRecord();
        student.viewAttendance();
        student.viewGrade();

        teacher.manageStudentProfile();
        teacher.manageStudentRecord();
        teacher.enterGrade();
        teacher.generateReport();
        teacher.manageAttendance();

        admin.manageRegistration();
        admin.manageAttendance();
        admin.generateReports();
        admin.notifyStudent();

        parent.viewChildAttendance();
        parent.viewChildPerformance();

        record.calculateGPA();
        record.addSubjectGrade("Math", "A");
        record.getAttendance();

        book.checkAvailability();
        book.issue();
        book.returnBook();

        library.addBook(book);
        library.removeBook(1);
        library.searchBookByTitle("Java");
        library.searchBookByAuthor("Smith");

        librarian.issueBook(book, student);
        librarian.manageBook(book);
        librarian.returnBook(book, student);
    }
}
