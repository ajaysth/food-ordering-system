<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper"></div>


<h1 class="fs-1 text-center">Manage User</h1>
        <br><br>

            <?php

                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }


            ?>
<br>
<br>
    <?php
    
    // Fetch categories from the database
    $sql = "SELECT id, fname,username,email,phone,address FROM tbl_users";
    $result = $conn->query($sql);

    // Initialize the $categories array
    $users = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    } else {
        echo "No categories found.";
    }

    $conn->close();
    ?>

    <table class="table table-striped" style="border-collapse: collapse; padding:3%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['fname'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['address'] . "</td>";
           
            
            echo "<td><button class='btn btn-outline-danger' onclick='confirmDelete(" . $user['id'] . ")'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>
    </div>


    <script>
        function confirmDelete(categoryId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'delete-user.php?id=' + categoryId;
            }
        }
    </script>
<?php include('partials/footer.php') ?>