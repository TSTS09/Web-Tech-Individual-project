<?php
require_once "../settings/core.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Chore Management System</title>
    <link rel="stylesheet" href="../css/style_assign_chore.css" />
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
                <li><a href="#">
                        <i class="fas fa-menorah"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="../view/chore_control_view.php">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Chores Management</span>
                    </a></li>
                <li><a href="assign_chore_view.php">
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
                <h1>Chore Assignment</h1>
                <button class="assign-chore-btn" id="assign-chore-btn">Assign Chore</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Chore Name</th>
                            <th>Assigned by</th>
                            <th>Date Assigned</th>
                            <th>Due Date</th>
                            <th>Chore Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="chores-list"><?php include '../functions/assignment_fxn.php'; ?></tbody>
                </table>
            </div>
            <div class="modal" id="assign-chore-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Assign a Chore</h2>
                    <form action="../actions/assign_a_chore_action.php" method="post">
                        <label for="chore-name">Assign Chore:</label>
                        <select class="assign-chore-btn" name="chore-name" id="chore-name" required>
                            <option value="" selected disabled>Select a chore</option>
                        </select>

                        <label for="assigned-to">Assign Person:</label>
                        <select class="assign-chore-btn" name="assigned-to" id="assigned-to" required>
                            <option value="" selected disabled>Select a person</option>
                        </select>
                        <!-- 
                        <label for="date-assigned">Date Assigned:</label>
                        <input type="date" name="date-assigned" id="date-assigned" required> -->

                        <label for="due-date">Due Date:</label>
                        <input type="date" name="due-date" id="due-date" required>

                        <!-- <label for="chore-status">Chore Status:</label>
                        <select class="assign-chore-btn" name="chore-status" id="chore-status" required>
                            <option value="" selected disabled>Select a chore status</option>
                        </select> -->

                        <button type="submit" name="submit" class="assign-chore-btn" id="assign-chore-btn">Assign Chore</button>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $.ajax({
                                url: "../functions/get_dropdown_options.php",
                                method: "GET",
                                dataType: "json",
                                success: function(data) {
                                    // Populate chore-name dropdown
                                    $.each(data.choreOptions, function(key, value) {
                                        $('#chore-name').append('<option value="' + key + '">' + value + '</option>');
                                    });

                                    // Populate assigned-to dropdown
                                    $.each(data.personOptions, function(key, value) {
                                        $('#assigned-to').append('<option value="' + key + '">' + value + '</option>');
                                    });

                                    // // Populate chore-status dropdown
                                    // $.each(data.statusOptions, function(key, value) {
                                    //     $('#chore-status').append('<option value="' + key + '">' + value + '</option>');
                                    // });
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    </script>


                </div>
            </div>
            <div class="modal" id="edit-chore-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Chore</h2>
                    <form action="" method="post" id="edit-chore-form">
                        <label for="edit-chore-name">Chore Name:</label>
                        <input type="text" name="edit-chore-name" id="edit-chore-name" required>
                        <label for="edit-assigned-to">Assigned To:</label>
                        <input type="text" name="edit-assigned-to" id="edit-assigned-to" required>
                        <label for="edit-due-date">Due Date:</label>
                        <input type="date" name="edit-due-date" id="edit-due-date" required>
                        <button type="submit" name="submit" class="assign-chore-btn" id="edit-chore-btn">Save Changes</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const assignChoreBtn = document.getElementById("assign-chore-btn");
            const modal = document.getElementById("assign-chore-modal");
            const closeModalBtn = document.querySelector("#assign-chore-modal .close");

            // Add event listener to the assign chore button
            assignChoreBtn.addEventListener("click", () => {
                modal.style.display = "block";
            });

            // Add event listener to the close button of assign chore modal
            closeModalBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Optional: Close modal when clicking outside of it
            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });

            // Handle form submission
            const assignChoreForm = document.getElementById("assign-chore-form");
            assignChoreForm.addEventListener("submit", (event) => {
                event.preventDefault(); // Prevent default form submission
                // Perform your form submission logic here, e.g., using fetch or XMLHttpRequest
                console.log("Form submitted");
                // Close the modal after successful submission
                modal.style.display = "none";
            });
        });

        function updateDueDateMin() {
            const dueDateInput = document.getElementById("due-date");

            // Get the current date
            const currentDate = new Date();

            // Format the current date as "YYYY-MM-DD" for the input value
            const currentDateFormatted = currentDate.toISOString().split('T')[0];

            // Set the minimum value of the due date input to the current date
            dueDateInput.min = currentDateFormatted;

            // If the current value of due date is before the minimum date, reset it
            if (new Date(dueDateInput.value) < currentDate) {
                dueDateInput.value = currentDateFormatted;
            }
        }

        // Call the function whenever the due date input changes
        document.getElementById("due-date").addEventListener("change", updateDueDateMin);
    </script>
</body>

</html>