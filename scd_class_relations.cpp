// scd_class_relations.cpp
// Simple example for Student Management System showing:
// - Inheritance: Person -> Student, Teacher
// - Association: Course -> Teacher (Course refers to Teacher but does not own it)
// - Composition: Student owns a Transcript (lifetime tied to Student)
// - Aggregation: Department aggregates Course pointers (courses exist independently)
//
// This is a minimal, self-contained illustration intended for review and education.

#include <iostream>
#include <string>
#include <vector>

class Teacher; // forward
class Course;  // forward

// Base class: Inheritance example
class Person {
protected:
    std::string name;
    int id;
public:
    Person(const std::string &n = "", int i = 0) : name(n), id(i) {}
    virtual ~Person() = default;
    std::string getName() const { return name; }
    int getId() const { return id; }
};

// Inheritance: Teacher is-a Person
class Teacher : public Person {
public:
    Teacher(const std::string &n = "", int i = 0) : Person(n, i) {}
    void teach() const { std::cout << "Teacher " << name << " is teaching.\n"; }
};

// Course has an association to Teacher (pointer reference only)
class Course {
    std::string title;
    Teacher *assignedTeacher; // association: Course refers to Teacher but doesn't own it
public:
    Course(const std::string &t = "") : title(t), assignedTeacher(nullptr) {}
    void setTeacher(Teacher *t) { assignedTeacher = t; }
    std::string getTitle() const { return title; }
    void info() const {
        std::cout << "Course: " << title;
        if (assignedTeacher) std::cout << ", Teacher: " << assignedTeacher->getName();
        else std::cout << ", Teacher: (none)";
        std::cout << "\n";
    }
};

// Aggregation: Department holds pointers to Course but does not own them
class Department {
    std::string name;
    std::vector<Course*> courses; // aggregation: department aggregates courses
public:
    Department(const std::string &n = "") : name(n) {}
    void addCourse(Course *c) { courses.push_back(c); }
    void listCourses() const {
        std::cout << "Department " << name << " courses:\n";
        for (auto c : courses) {
            if (c) c->info();
        }
    }
};

// Composition: Student owns a Transcript; transcript lifetime tied to Student
class Student : public Person {
public:
    // Nested class to emphasize composition: Transcript cannot exist without Student in this design
    class Transcript {
        std::vector<std::pair<std::string, char>> records; // pair<course title, grade>
    public:
        void addRecord(const std::string &courseTitle, char grade) {
            records.emplace_back(courseTitle, grade);
        }
        void print() const {
            std::cout << " Transcript:\n";
            for (const auto &r : records) {
                std::cout << "  - " << r.first << ": " << r.second << "\n";
            }
        }
    } transcript; // composition: owned by Student

    std::vector<Course*> enrolled; // association: student knows courses

    Student(const std::string &n = "", int i = 0) : Person(n, i), transcript() {}
    void enroll(Course *c) {
        if (!c) return;
        enrolled.push_back(c);
        transcript.addRecord(c->getTitle(), 'U'); // 'U' = ungraded initially
    }
    void printInfo() const {
        std::cout << "Student: " << name << " (id=" << id << ")\n";
        std::cout << " Enrolled courses:\n";
        for (auto c : enrolled) {
            if (c) std::cout << "  - " << c->getTitle() << "\n";
        }
        transcript.print();
    }
};

int main() {
    // Create teachers (inheritance)
    Teacher *teacherAli = new Teacher("Ali Khan", 101);
    Teacher *teacherSara = new Teacher("Sara Noor", 102);

    // Create courses (exist independently)
    Course *prog = new Course("Programming 101");
    Course *math = new Course("Discrete Math");

    // Association: assign teachers to courses (Course refers to Teacher)
    prog->setTeacher(teacherAli);
    math->setTeacher(teacherSara);

    // Aggregation: department aggregates course pointers (does not own them)
    Department compSci("Computer Science");
    compSci.addCourse(prog);
    compSci.addCourse(math);

    // Composition & Inheritance: student owns a Transcript
    Student studentA("Aisha", 201);
    studentA.enroll(prog);
    studentA.enroll(math);

    // Show relationships
    compSci.listCourses();
    std::cout << "\n";
    studentA.printInfo();
    std::cout << "\n";
    teacherAli->teach();
    teacherSara->teach();

    // Clean up: courses and teachers were created independently (aggregation semantics)
    delete prog;
    delete math;
    delete teacherAli;
    delete teacherSara;

    return 0;
}
