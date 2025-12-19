import java.util.List;

public class Library {
    private int libraryId;
    private String name;
    private String address;
    private List<Book> books;
    private List<Librarian> librarians;

    public void addBook(Book book) {
        System.out.println("addBook() called successfully");
    }

    public void removeBook(int bookId) {
        System.out.println("removeBook() called successfully");
    }

    public Book searchBookByTitle(String title) {
        System.out.println("searchBookByTitle() called successfully");
        return null;
    }

    public List<Book> searchBookByAuthor(String author) {
        System.out.println("searchBookByAuthor() called successfully");
        return null;
    }
}
