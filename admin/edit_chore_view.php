<?php
// Check if the user is logged in
include '../settings/core.php';

// Include the get_a_chore_action.php file
include '../actions/get_a_chore_action.php';

// Check if chore_id is provided in the GET URL
if(isset($_GET['chore_id'])) {
    // Retrieve chore ID from GET URL
    $choreId = $_GET['chore_id'];
    
    // Call getChoreById() function to retrieve chore details
    $chore = getChoreById($choreId);
    
    // Check if chore details are found
    if($chore) {
        // Display edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Chore</title>
        </head>
        <body>
            <h2>Edit Chore</h2>
            <form action="../actions/edit_a_chore_action.php" method="post">
                <input type="hidden" name="chore_id" value="<?php echo $chore['cid']; ?>">
                <label for="chore_name">Chore Name:</label>
                <input type="text" id="chore_name" name="chore_name" value="<?php echo $chore['chorename']; ?>" required>
                <button type="submit">Save Changes</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        // Chore not found, redirect to chore display page
        header("Location: ../view/chore_control_view.php");
        exit();
    }
} else {
    // Chore ID not provided, redirect to chore display page
    header("Location: ../view/chore_control_view.php");
    exit();
}
?>
