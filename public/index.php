<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
            <img src="images/logo_Silva.svg" id="logo" style="cursor:pointer;" onclick="showSection('home')">
            <button class="navbarbuttons" onclick="showSection('create')"> Create </button>
            <button class="navbarbuttons" onclick="showSection('read')"> Read </button>
            <button class="navbarbuttons" onclick="showSection('update')"> Update </button>
            <button class="navbarbuttons" onclick="showSection('delete')"> Remove </button>
    </nav>
    <section id="home" class="homecontent"> 
        <h1 class="splash">Student Management System</h1>
        <h2 class="splash">A Project in Integrative Programming Technologies</h2>
        <h2 class="splash">Submitted By:Silva,Florich Joy C.</h2>
        <h2 class="splash">BSIT-2B</h2>

    </section>
    
    <section id="create" class="content">
        <h1 class="contenttitle"> Insert New Student </h1>
        <p class="section-desc">Please provide the required details to register a new student.</p>

    <form action="includes/insert.php" method="POST">
        <label for="surname" class="label">Surname</label>
        <input type="text" name="surname" id="surname" class="field" required><br/>

        <label for="name" class="label">Name</label>
        <input type="text" name="name" id="name" class="field" required><br/>

        <label for="middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="middlename" class="field"><br/>

        <label for="address" class="label">Address</label>
        <input type="text" name="address" id="address" class="field"><br/>

        <label for="contact" class="label">Mobile Number</label>
        <input type="text" name="contact" id="contact" class="field" maxlength="11"><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
            <button type="submit" id="savebtn" class="btns">Save</button>
        </div>


    </form>   
    <p style="margin-top: 25px; color: var(--text-muted); font-size: 0.95rem;">
        Note: Please ensure all information is correct before saving the new student record.
    </p>
    </section>

<br/><br/><br/><br/>

    <section id="read" class="content">
        <h1 class="contenttitle"> View Students </h1>
        <p class="section-desc">Here is the complete list of all registered students.</p>
        <table>
            <tr>
                <th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th><th>Address</th><th>Contact</th>
            </tr>
            <?php
            include 'includes/db.php';
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["surname"]."</td><td>".$row["name"]."</td><td>".$row["middlename"]."</td><td>".$row["address"]."</td><td>".$row["contact_number"]."</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </table>
        <p style="margin-top: 25px; color: var(--text-muted); font-size: 0.95rem;">
            Note: This table displays all currently registered students in the system.
        </p>
    </section>

    <section id="update" class="content">
        <h1 class="contenttitle"> Update Student Records </h1>
        <p class="section-desc">Select a student from the list below to modify their information.</p>
        <form action="includes/update.php" method="POST">
            <label for="update_id" class="label">Select Student</label>
            <select name="update_id" id="update_id" class="field" required>
                <option value="">Select ID - Name</option>
                <?php
                if ($result && $result->num_rows > 0) {
                    $result->data_seek(0);
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["id"]."'>".$row["id"]." - ".$row["surname"].", ".$row["name"]."</option>";
                    }
                }
                ?>
            </select><br/>
            
            <label for="new_surname" class="label">New Surname</label>
            <input type="text" name="new_surname" id="new_surname" class="field" required><br/>

            <label for="new_name" class="label">New Name</label>
            <input type="text" name="new_name" id="new_name" class="field" required><br/>

            <label for="new_middlename" class="label">New Middle name</label>
            <input type="text" name="new_middlename" id="new_middlename" class="field"><br/>

            <label for="new_address" class="label">New Address</label>
            <input type="text" name="new_address" id="new_address" class="field"><br/>

            <label for="new_contact" class="label">New Mobile Number</label>
            <input type="text" name="new_contact" id="new_contact" class="field" maxlength="11"><br/>

            <div id="btncontainer">
                <button type="submit" class="btns">Update</button>
            </div>
        </form>
        <p style="margin-top: 25px; color: var(--text-muted); font-size: 0.95rem;">
            Note: Please double-check all fields. Any blank fields will not overwrite existing data, but modified fields will be permanently updated.
        </p>
    </section>

    <section id="delete" class="content">
        <h1 class="contenttitle"> Remove Student Records </h1>
        <p class="section-desc">Select a student to permanently delete their record from the system.</p>
        <form action="includes/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this record? This action cannot be undone.');">
            <label for="delete_id" class="label">Select Student</label>
            <select name="delete_id" id="delete_id" class="field" required>
                <option value="">Select ID - Name</option>
                <?php
                if ($result && $result->num_rows > 0) {
                    $result->data_seek(0);
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["id"]."'>".$row["id"]." - ".$row["surname"].", ".$row["name"]."</option>";
                    }
                }
                ?>
            </select><br/>
            <div id="btncontainer">
                <button type="submit" class="btns">Delete</button>
            </div>
        </form>
        <p style="margin-top: 25px; color: #dc2626; font-size: 0.95rem; font-weight: 600;">
            Note: Warning! Deleting a student record is permanent and cannot be undone.
        </p>
    </section>



    <div id="success-toast" class="toast-hidden">
        Operation Successful!
    </div>

    <script src="script.js"></script>
</body>
</html>
