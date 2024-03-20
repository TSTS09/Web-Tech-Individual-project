<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Chore Management System</title>
    <link rel="stylesheet" href="../css/style_add_chores.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="/home(admin)/home.html" class="logo">
                        <img src="../images/Chorus.png">
                        <span class="nav-item">Admin 1</span>
                    </a></li>
                <li><a href="/home(admin)/home.html">
                        <i class="fas fa-menorah"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="/home(admin)/Chores-management/page.html">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Chores Management</span>
                    </a></li>
                <li><a href="/home(admin)/Chores-Assignment/page.html">
                        <i class="fas fa-database"></i>
                        <span class="nav-item">Chores Assignment</span>
                    </a></li>
                <li><a href="#">
                        <i class="fas fa-cog"></i>
                        <span class="nav-item">Setting</span>
                    </a></li>
                <li><a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a></li>
            </ul>
        </nav>
        <section class="chores">
            <div class="chores-list">
                <h1>Chore Management</h1>
                <button class="add-chore-btn" id="add-chore-btn">Add Chore</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Chore ID</th>
                            <th>Chore Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="chores-list">
                        <?php include '../functions/chore_fxn.php'; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal" id="add-chore-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Add a New Chore</h2>
                    <form action="../actions/add_chore_action.php" method="post" id="chore-form">
                        <label for="chore-name">Chore Name:</label>
                        <input type="text" name="chore-name" id="chore-name" placeholder="Enter chore name" required>
                        <button type="submit" name="submit" class="add-chore-btn" id="add-chore-btn">Add Chore</button>
                    </form>
                </div>
            </div>
            
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addChoreBtn = document.getElementById("add-chore-btn");
            const modal = document.getElementById("add-chore-modal");
            const closeModalBtn = document.querySelector(".modal .close");

            // Add event listener to the add chore button
            addChoreBtn.addEventListener("click", () => {
                modal.style.display = "block";
            });

            // Add event listener to the close button of add chore modal
            closeModalBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });
        });
    </script>
</body>

</html>
