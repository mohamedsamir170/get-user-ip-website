# ATW DevOps Task

By: Mohamed Samir

## Table of Contents
1. [Task 1: Linux Base](#task-1-linux-base)
    - [Task 1.1: Creating Directories and Files](#task-11-creating-directories-and-files)
    - [Task 1.2: File Permissions](#task-12-file-permissions)
    - [Task 1.3: Basic Shell Scripting](#task-13-basic-shell-scripting)
    - [Task 1.4: Package Management](#task-14-package-management)
2. [Task 2: Linux Server Simulation](#task-2-linux-server-simulation)
3. [Task 3: Git and GitHub](#task-3-git-and-github)
4. [Task 4: Containerize Your Repository Using Docker Compose](#task-4-containerize-your-repository-using-docker-compose)
5. [Task 5: Networking Basics](#task-5-networking-basics)

## Task 1: Linux Base

### Task 1.1: Creating Directories and Files
1. **Create a directory named `project`:**
    ```bash
    mkdir project
    ```
2. **Inside the `project` directory, create two subdirectories named `src` and `bin`:**
    ```bash
    cd project
    mkdir src bin
    ```
3. **In the `src` directory, create a file named `main.c` and add the following line:**
    ```bash
    echo "// This is the main.c file" > src/main.c
    ```

#### Questions:
1. **What command did you use to create the `project` directory?**
    ```bash
    mkdir project
    ```
2. **How do you navigate into the `src` directory from the `project` directory?**
    ```bash
    cd src
    ```
3. **Which command did you use to create the `main.c` file?**
    - Used standard output forwarding: `echo "// This is the main.c file" > src/main.c`
    - Another method: `touch main.c`

### Task 1.2: File Permissions
1. **Change the permissions of the `main.c` file to read and write for the owner, and read-only for the group and others:**
    ```bash
    chmod 644 src/main.c
    ```
2. **Verify the changes using the `ls` command:**
    ```bash
    ls -l src/main.c
    ```

#### Questions:
1. **What command did you use to change the permissions of `main.c`?**
    ```bash
    chmod 644 src/main.c
    ```
2. **What do the file permissions `rw-r--r--` mean?**
    - The owner can read and write.
    - The group can read only.
    - Others can read only.

### Task 1.3: Basic Shell Scripting
1. **Create a shell script named `hello.sh` that prints "Hello, World!" to the terminal:**
    ```bash
    vim hello.sh
    #!/bin/bash
    echo "Hello, World!"
    ```
2. **Make the script executable and run it:**
    ```bash
    chmod +x hello.sh
    ./hello.sh
    ```

#### Questions:
1. **What command did you use to create the `hello.sh` file?**
    ```bash
    vim hello.sh
    ```
2. **How do you make a script executable?**
    ```bash
    chmod +x hello.sh
    ```
3. **How do you run an executable script from the terminal?**
    ```bash
    ./hello.sh
    ```

### Task 1.4: Package Management
1. **Update the package lists on your Linux system:**
    ```bash
    sudo apt update
    ```
2. **Install the `curl` package:**
    ```bash
    sudo apt install curl
    ```

#### Questions:
1. **What command did you use to update the package lists?**
    ```bash
    sudo apt update
    ```
2. **What command did you use to install the `curl` package?**
    ```bash
    sudo apt install curl
    ```
3. **How do you check if the `curl` package is installed correctly?**
    ```bash
    curl --version
    ```

## Task 2: Linux Server Simulation

1. **Install Apache, MySQL, and PHP on the Linux Ubuntu machine:**
    ```bash
    sudo apt update
    sudo apt install apache2
    sudo apt install mysql-server
    sudo apt install php libapache2-mod-php
    sudo systemctl status apache2
    sudo systemctl status mysql
    sudo systemctl start apache2
    sudo systemctl enable apache2
    sudo systemctl start mysql
    sudo systemctl enable mysql
    ```

2. **Configure Apache to serve the website from the `/var/www/html/` directory:**
    ```bash
    sudo nano /etc/apache2/sites-available/000-default.conf
    # Set the DocumentRoot to /var/www/html
    ```

3. **Create a simple website that displays the message "Hello World!":**
    ```bash
    sudo nano /var/www/html/index.php
    <?php
    echo "Hello, World!";
    ?>
    ```

4. **Configure MySQL to create a new database, user, and password for the website:**
    ```bash
    mysql -u root -p
    CREATE DATABASE demo_website_db;
    CREATE USER 'mohamed'@'localhost' IDENTIFIED BY 'Mohamed@1234';
    GRANT ALL PRIVILEGES ON demo_website_db.* TO 'mohamed'@'localhost';
    CREATE TABLE demo_website_db.users (id INT NOT NULL AUTO_INCREMENT, ip VARCHAR(50) NOT NULL, date DATE NOT NULL, PRIMARY KEY (id));
    ```

5. **Modify the website to use the newly created database to display a message that includes the visitor's IP address and the current time.**

6. **Test the website by accessing it through a web browser and verifying that it displays the expected message.**

## Task 3: Git and GitHub

1. **Initialize a new Git repository on your local machine:**
    ```bash
    git init
    ```

2. **Create a `.gitignore` file to exclude any sensitive files:**
    ```bash
    nano .gitignore
    *.conf
    ```

3. **Commit your Markdown documentation file in the Git repository:**
    ```bash
    touch README.md
    git add .
    git commit -m "README file created"
    ```

4. **Create a new repository on GitHub and push your local repository to GitHub:**
    ```bash
    git remote add origin <your repo link>
    git branch -M main
    git push -u origin main
    ```

## Task 4: Containerize Your Repository Using Docker Compose

1. **Create the `docker-compose.yml` file:**
    ```yaml
    version: '3'
    services:
      db:
        image: mysql
        environment:
          - MYSQL_DATABASE=demo_website_db
          - MYSQL_USER=mohamed
          - MYSQL_PASSWORD=Mohamed@1234
          - MYSQL_ALLOW_EMPTY_PASSWORD=1
        volumes:
          - "./db:/docker-entrypoint-initdb.d"
      php:
        build: .
        volumes:
          - "./:/var/www/html"
        ports:
          - "8000:80"
      phpmyadmin:
        image: phpmyadmin/phpmyadmin
        ports:
          - "8001:80"
        environment:
          - PMA_HOST=db
          - PMA_PORT=3306
    ```

2. **Create the Dockerfile:**
    ```dockerfile
    FROM php:7.4-apache
    COPY . /var/www/html
    RUN docker-php-ext-install mysqli
    EXPOSE 80
    ```

3. **Build and run the containers:**
    ```bash
    docker-compose up --build -d
    ```

4. **Access the services:**
    - PHP Application: `http://localhost:8000`
    - phpMyAdmin: `http://localhost:8001`


## Task 5: Networking Basics

- **Localhost IP Address:** 127.0.0.1
- **Routing Protocols:** Minimal routing in a local setup, handled by the OS networking stack.
- **Connect to the project cloud instance:**
    ```bash
    ssh -i aws.pem ec2-user@13.51.206.117
    ```
- **Access the cloud service:**
-    Remotly: `http://13.51.206.117:8000`

## Challenges Faced
- Volume Mounting: Ensuring correct volume mounts for database initialization and PHP code sync.
- Environment Variables: Correctly setting environment variables, especially for sensitive information.
