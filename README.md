# FYP Forge

FYP Forge is a comprehensive management system designed for academic institutions to streamline the process of handling Final Year Projects (FYPs). The system bridges the gap between students, advisors, and administrative staff, offering tools to manage projects, evaluations, and communication within a single platform.

## Features

- **User Management:**
  - Role-based access control for Students, Advisors, and Staff.
  - Bulk import of students via CSV.
  - Automated notification of account creation.

- **Project Management:**
  - Create, edit, and manage FYPs with ease.
  - Invite and assign advisors and students to projects.
  - Track project progress and status through the system.

- **Advisor Coordination:**
  - Manage advisor profiles and assign them to projects.
  - Form and manage evaluation panels.
  - Handle advisor-student interactions and project queries.

- **Student Interface:**
  - Dashboard for students to view and manage their projects.
  - Tools to find and request advisors.
  - Track project milestones and receive notifications.

- **Project Evaluation:**
  - Create and manage evaluation panels.
  - Schedule and conduct project evaluations.
  - Record and manage evaluation outcomes.

- **Communication:**
  - Integrated query system for project-related questions.
  - Notifications for important events such as invites, evaluations, and project updates.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/fyp-forge.git
    cd fyp-forge
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment:
    - Copy `.env.example` to `.env` and update the environment variables accordingly.
    ```bash
    cp .env.example .env
    ```
    - Generate an application key:
    ```bash
    php artisan key:generate
    ```

4. Run the migrations:
    ```bash
    php artisan migrate
    ```

5. Seed the database (optional):
    ```bash
    php artisan db:seed
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

- **Admin (Staff/Coordinator):**
  - Log in and manage advisors, students, projects, and evaluators from the dashboard.
  - Import students in bulk, create projects, assign advisors, and set up evaluation panels.

- **Advisor:**
  - Log in to view and manage assigned projects.
  - Communicate with students and participate in project evaluations.

- **Student:**
  - Log in to view and manage your project.
  - Find and request advisors, track project milestones, and receive evaluation feedback.

- **Evaluator:**
  - Log in to access the list of students and projects assigned for evaluation.
  - Provide marks and feedback for the projects you evaluate.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request or open an Issue for any bugs or feature requests.

1. Fork the repository.
2. Create a new branch:
    ```bash
    git checkout -b feature/your-feature-name
    ```
3. Make your changes and commit them:
    ```bash
    git commit -m "Add some feature"
    ```
4. Push to the branch:
    ```bash
    git push origin feature/your-feature-name
    ```
5. Open a Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or feedback, please create an issue in this repository.
