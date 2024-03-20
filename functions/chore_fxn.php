<?php
include '../actions/get_all_chores_action.php';

$chores = getAllChores();

// Display the chores in a table
foreach ($chores as $chore) {
    echo "<tr>";
    echo "<td>{$chore['cid']}</td>";
    echo "<td>{$chore['chorename']}</td>";
    echo "<td>";
    echo "<a href='../admin/edit_chore_view.php?chore_id={$chore['cid']}'><button class='edit-chore-btn'>Edit</button></a>";
    echo "<a href='../actions/delete_chore_action.php?chore_id={$chore['cid']}'><button class='delete-chore-btn'>Delete</button></a>";
    echo "</td>";
    echo "</tr>";
}

echo '</tbody>';
echo '</table>';