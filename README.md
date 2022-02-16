Story of the Project:

I have registered and logged in to the admin and user dashboard. From the dashboard, users can create a task, view a task, edit a task and delete a task. Users can check their profile information. After creating a task, users can view their created task, manage and sort tasks by drag and drop. Drag and drop tasks will be saved in the database by category name. And in the index page public can select a category and check the category tasks in the next dropdown. 



System requirements:

Php version >= 7.4
Apache version >= 2.4
Mysql = 8.0
MySQL Storage Engines = InnoDB
Composer version >= 2.2.5
Laravel vesion >= 8.0



Technical Overview:

1. I use Laravel in the back-end and bootstrap as UI and UI for the dashboard as Adminlte 3.1.0.
2. I use auth as middleware for login.
3. In every method, I use the try-catch exception to get the error message.
4. For the web route, I use the web.php 
5. For registration route is: /register
6. For Login, the route is:  /login
7. After newly registered users can not log in because I keep active and inactive.
8. Go to database: coalition and go to table name: users
9. And in the user's table changed the status to active
10. Now, you can log in.



Admin Dashboard:

1. As every new registration will be created as a user by default.
2. Go to database: coalition and go to table name: users.
3. And in the user's table changed the role from user to admin.
4. And in the user's table changed the status to active.
5. Admin can see all the users.
6. Admin can activate and inactivate(blocked) the users.
7. Admin can create a task, edit a task and delete a task.
8. Admin can manage the task by dragging and dropping and saving to the database by category.
9. Admin can check their profile.



User Dashboard:

1. As every new registration will be created as a user by default.
2. If admin does not activate. 
3. Users can not log in.
4. Go to database: coalition and go to table name: users.
5. And in the user's table changed the status to active.
6. Now, the user can log in.
7. If the admin activate the user then
8. Skip 4-5.
9. Users can create a task, edit a task and delete a task.
10. Users can manage the task by drag and drop
11. Users can save the task by category name in the database.
12. Users can check their profiles.



Index page:

1. On the index page: we can select a category.
2. After we select a category, we can see the task list.
3. The Task List will be shown by category name.