<?php

include '../actions/get_all_chores_action.php';

$var_data = getAllChores();

// Display the chores in a table
echo '<table>';
echo '<thead><tr><th>Chore ID</th><th>Chore Name</th><th>Actions</th></tr></thead>';
echo '<tbody>';

foreach ($var_data as $chore) {
    echo '<tr>';
    echo '<td>' . $chore['choreID'] . '</td>';
    echo '<td>' . $chore['chorename'] . '</td>';
    echo '<td>';
    echo '<button class="edit-chore-btn" data-id="' . $chore['choreID'] . '">Edit</button>';
    echo '<button class="delete-chore-btn" data-id="' . $chore['choreID'] . '">Delete</button>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
