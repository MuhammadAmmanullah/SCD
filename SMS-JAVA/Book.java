public class Book {
    private int bookId;
    private String title;
    private String status;
    private String author;

    public boolean checkAvailability() {
        System.out.println("checkAvailability() called successfully");
        return true;
    }

    public void issue() {
        System.out.println("issue() called successfully");
    }

    public void returnBook() {
        System.out.println("returnBook() called successfully");
    }
}
