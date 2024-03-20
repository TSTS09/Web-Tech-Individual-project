<?php
include '../settings/core.php';
include '../functions/chore_fxn.php'
?>

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
                    <tbody id="chores-list"></tbody>
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
            <div class="modal" id="edit-chore-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Chore</h2>
                    <form action="" method="post" id="edit-chore-form">
                        <input type="hidden" name="chore-id" id="edit-chore-id">
                        <label for="edit-chore-name">Chore Name:</label>
                        <input type="text" name="edit-chore-name" id="edit-chore-name" required>
                        <button type="submit" name="submit" class="add-chore-btn" id="add-chore-btn">Save Changes</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const choresList = document.getElementById("chores-list");
            const addChoreBtn = document.getElementById("add-chore-btn");
            const modal = document.getElementById("add-chore-modal");
            const closeModalBtn = document.querySelector(".modal .close");

            const editChoreModal = document.getElementById("edit-chore-modal");
            const closeEditChoreModalBtn = document.querySelector("#edit-chore-modal .close");

            // Add event listener to the add chore button
            addChoreBtn.addEventListener("click", () => {
                modal.style.display = "block";
            });

            // Add event listener to the close button of add chore modal
            closeModalBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Add event listener to the close button of edit chore modal
            closeEditChoreModalBtn.addEventListener("click", () => {
                editChoreModal.style.display = "none";
            });

            // Add event listener to the chore form for adding a new chore
            const choreForm = document.getElementById("chore-form");
            choreForm.addEventListener("submit", (event) => {
                event.preventDefault();

                // Get the chore name from the form
                const choreName = document.getElementById("chore-name").value;

                // Create a new chore object
                const chore = {
                    name: choreName
                };

                // Add the new chore to the table
                const newRow = createChoreRow(choresList.children.length + 1, chore);
                choresList.appendChild(newRow);

                // Clear the chore name field
                clearChoreForm();

                // Close the add chore modal
                modal.style.display = "none";

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../actions/add_chore_action.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const choreId = parseInt(xhr.responseText);
                        const chore = {
                            name: choreName
                        };
                        const newRow = createChoreRow(choreId, chore);
                        choresList.appendChild(newRow);
                        clearChoreForm();
                        modal.style.display = "none";
                    }
                };

                xhr.send("chore-name=" + encodeURIComponent(choreName));
            });
            // Add event listener to the chores list to handle delete and edit button clicks
            choresList.addEventListener("click", (event) => {
                if (event.target.classList.contains("delete-chore-btn")) {
                    // Handle delete button click
                    deleteChore(event);
                } else if (event.target.classList.contains("edit-chore-btn")) {
                    // Handle edit button click
                    openEditChoreModal(event);
                }
            });

            // Add event listener to the edit chore form for saving changes
            const editChoreForm = document.getElementById("edit-chore-form");
            editChoreForm.addEventListener("submit", (event) => {
                event.preventDefault();

                // Get the edited chore information from the form
                const choreId = document.getElementById("edit-chore-id").value;
                const editedChore = {
                    name: document.getElementById("edit-chore-name").value
                };

                // Update the table with the edited chore information
                updateChoreRow(choreId, editedChore);

                // Close the edit chore modal
                editChoreModal.style.display = "none";
            });

            // Function to create a new row for a chore in the table
            function createChoreRow(choreId, chore) {
                const newRow = document.createElement("tr");
                newRow.id = `chore-row-${choreId}`;
                newRow.innerHTML = `
          <td>${choreId}</td>
          <td>${chore.name}</td>
          <td>
            <button class="edit-chore-btn" id="edit-chore-btn-${choreId}">Edit</button>
            <button class="delete-chore-btn" id="delete-chore-btn-${choreId}">Delete</button>
          </td>
        `;
                return newRow;
            }

            // Function to clear the add chore form fields
            function clearChoreForm() {
                document.getElementById("chore-name").value = "";
            }

            // Function to delete a chore from the table
            function deleteChore(event) {
                const choreId = event.target.id.split("-")[3];
                const choreRow = event.target.parentElement.parentElement;

                // Remove the chore from the table
                choresList.removeChild(choreRow);
            }

            // Function to open the edit chore modal with the current chore information
            function openEditChoreModal(event) {
                const choreId = event.target.id.split("-")[3];
                const choreRow = event.target.parentElement.parentElement;
                const choreName = choreRow.children[1].textContent;

                // Set the current chore information in the edit chore form
                document.getElementById("edit-chore-id").value = choreId;
                document.getElementById("edit-chore-name").value = choreName;

                // Open the edit chore modal
                editChoreModal.style.display = "block";
            }

            // Function to update the table with edited chore information
            function updateChoreRow(choreId, editedChore) {
                const choreRow = document.getElementById(`chore-row-${choreId}`);
                choreRow.children[1].textContent = editedChore.name;
            }
        });
    </script>
</body>

</html>