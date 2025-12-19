#include <iostream>
#include <string>

using namespace std;

// ==================== FUNCTION DECLARATIONS ====================
bool login(string username, string password, string &role);

void adminMenu();
void teacherMenu();
void studentMenu();
void librarianMenu();

// ==================== MAIN FUNCTION ====================
int main() {
    string username, password, role;

    cout << "===== WELCOME TO SCHOOL MANAGEMENT SYSTEM =====\n";

    cout << "Username: ";
    cin >> username;
    cout << "Password: ";
    cin >> password;

    if (login(username, password, role)) {
        if (role == "admin")
            adminMenu();
        else if (role == "teacher")
            teacherMenu();
        else if (role == "student")
            studentMenu();
        else if (role == "librarian")
            librarianMenu();
    } else {
        cout << "Invalid login! Exiting program.\n";
    }

    return 0;
}

// ==================== LOGIN FUNCTION ====================
bool login(string username, string password, string &role) {
    if (username == "admin" && password == "admin123") {
        role = "admin";
        return true;
    } else if (username == "teacher" && password == "teach123") {
        role = "teacher";
        return true;
    } else if (username == "student" && password == "stud123") {
        role = "student";
        return true;
    } else if (username == "librarian" && password == "lib123") {
        role = "librarian";
        return true;
    }
    return false;
}

// ==================== ADMIN MENU ====================
void adminMenu() {
    int choice;
    do {
        cout << "\n====== ADMIN PANEL ======\n";
        cout << "1. Manage Teachers\n";
        cout << "2. Manage Students\n";
        cout << "3. Manage Librarians\n";
        cout << "0. Logout\n";
        cout << "Enter choice: ";
        cin >> choice;

        switch (choice) {
            case 1:
                cout << "Managing teachers...\n";
                break;
            case 2:
                cout << "Managing students...\n";
                break;
            case 3:
                cout << "Managing librarians...\n";
                break;
            case 0:
                cout << "Logging out...\n";
                break;
            default:
                cout << "Invalid choice!\n";
        }
    } while (choice != 0);
}

// ==================== TEACHER MENU ====================
void teacherMenu() {
    int choice;
    do {
        cout << "\n====== TEACHER PANEL ======\n";
        cout << "1. Mark Attendance\n";
        cout << "2. Upload Marks\n";
        cout << "3. Enroll Students\n";
        cout << "0. Logout\n";
        cout << "Enter choice: ";
        cin >> choice;

        switch (choice) {
            case 1:
                cout << "Attendance marked.\n";
                break;
            case 2:
                cout << "Marks uploaded.\n";
                break;
            case 3:
                cout << "Student enrolled successfully.\n";
                break;
            case 0:
                cout << "Logging out...\n";
                break;
            default:
                cout << "Invalid choice!\n";
        }
    } while (choice != 0);
}

// ==================== STUDENT MENU ====================
void studentMenu() {
    int choice;
    do {
        cout << "\n====== STUDENT PANEL ======\n";
        cout << "1. View Marks\n";
        cout << "2. View Attendance\n";
        cout << "3. View Timetable\n";
        cout << "0. Logout\n";
        cout << "Enter choice: ";
        cin >> choice;

        switch (choice) {
            case 1:
                cout << "Displaying marks...\n";
                break;
            case 2:
                cout << "Displaying attendance...\n";
                break;
            case 3:
                cout << "\n--- TIMETABLE ---\n";
                cout << "Mon - Math\nTue - Physics\nWed - Computer Science\nThu - English\nFri - Chemistry\n";
                break;
            case 0:
                cout << "Logging out...\n";
                break;
            default:
                cout << "Invalid choice!\n";
        }
    } while (choice != 0);
}

// ==================== LIBRARIAN MENU ====================
void librarianMenu() {
    int choice;
    do {
        cout << "\n====== LIBRARIAN PANEL ======\n";
        cout << "1. Issue Book\n";
        cout << "2. Return Book\n";
        cout << "0. Logout\n";
        cout << "Enter choice: ";
        cin >> choice;

        switch (choice) {
            case 1:
                cout << "Book issued.\n";
                break;
            case 2:
                cout << "Book returned.\n";
                break;
            case 0:
                cout << "Logging out...\n";
                break;
            default:
                cout << "Invalid choice!\n";
        }
    } while (choice != 0);
}

