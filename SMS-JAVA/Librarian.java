public class Librarian extends Users {
    private int librarianId;
    private Library library;

    public void issueBook(Book book, Student student) {
        System.out.println("issueBook() called successfully");
    }

    public void manageBook(Book book) {
        System.out.println("manageBook() called successfully");
    }

    public void returnBook(Book book, Student student) {
        System.out.println("returnBook() called successfully");
    }
}
