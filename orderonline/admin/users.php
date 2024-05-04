<?php
include 'db_connect.php';

// Check if the delete request is received
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM user_info WHERE user_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();

    // Since this is an AJAX request, we don't need to redirect. Instead, we can just return success response.
    echo 'Success';
    exit; // Stop further PHP execution since we are handling this request through AJAX.
}

// Fetch users from the database
$result = $conn->query("SELECT * FROM user_info ORDER BY user_id ASC");
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="card col-lg-12">
                <div class="card-body">
                    <table class="table table-striped table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th class="text-center">Srno</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['user_id']; ?></td>
                                    <td><?php echo $user['first_name'] .' '. $user['last_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit_user" href="mailto:<?php echo $user['email']; ?>">Reply</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $user['user_id']; ?>">Delete</a>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ensure dropdowns are correctly initialized
        $(function() {
            $('.dropdown-toggle').dropdown();
        });

        $('.delete_user').click(function(){
            var delete_id = $(this).data('id');
            // Confirm the deletion
            if (confirm('Are you sure you want to delete this user?')) {
                // AJAX request to handle the delete operation without reloading the page
                $.ajax({
                    url: window.location.href, // Use the current URL
                    type: 'POST',
                    data: { delete_id: delete_id },
                    success: function(response) {
                        // Upon successful deletion, reload the page to refresh the list of users
                        location.reload();
                    }
                });
            }
        });
    </script>
</body>
</html>
