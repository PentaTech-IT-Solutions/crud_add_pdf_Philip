<?php
  session_start();
  // IF THE USER IS NOT LOGGED IN HE IS REDIRECTED TO INDEX.HTML
  if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
  }
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Team Members Dashboard | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
    .input-box {
        width: 100% !important;
    }

    .container {
        max-width: 90%;
        /* 500px; */
    }

    .user-details {
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }




    /* Styling for action buttons */
    .action-button {
        background-color: #4CAF50;
        /* Green background */
        color: white;
        /* White text */
        border: none;
        /* No border */
        padding: 5px 10px;
        /* Padding */
        text-align: center;
        /* Centered text */
        text-decoration: none;
        /* No underline */
        display: inline-block;
        /* Inline-block for horizontal alignment */
        font-size: 14px;
        /* Font size */
        margin: 2px;
        /* Margin between buttons */
        cursor: pointer;
        /* Pointer cursor on hover */
        border-radius: 5px;
        /* Rounded corners */
    }

    .action-button.delete-button {
        background-color: #f44336;
        /* Red background for delete button */
    }

    /* Ensuring buttons are displayed in a row */
    td>.action-button {
        display: inline-block;
    }

    .row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-left: 30px;
        margin-bottom: 25px;
        margin-top: 25px;
        

    }

    .pull-left{
      margin-left: 50px;
      background: #677C1A;
      color: #FFFFFF;
      height: 35px;
      width: 120px;
      border: none;
      border-radius: 5px;
    }

    .pull-left-logout{
      margin-left: 50px;
      background: #C12303;
      color: #FFFFFF;
      height: 35px;
      width: 100px;
      border: none;
      border-radius: 5px;
      text-align: center;
    }


    /* ----*/
    .action-buttons {
            display: flex;
            gap: 10px; /* Space between buttons */
        }

       
        .action-button.delete-button {
            background-color: #f44336; /* Red */
        }

        .action-button.edit-button {
            background-color: #008CBA; /* Blue */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Welcome to PentaTech IT-Solutions - Team Members Dashboard</div>
        <!-- <h1>Team Members Dashboard</h1> -->
        <div class="content">
            <div class="row">
              <div >
              <button class='action-button' onclick="window.location.href='add_member.php'">Add Member</button>
              </div>

              <div >
              <button class="pull-left-logout" onclick="logoutf()">Logout</button>
              </div>
              <div >
              <button class="pull-left" onclick="generatePDF()">Generate PDF</button>
              </div>
            </div>
            <div style="text-align: center;">
                <table id="membersTable" class="display">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>About</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'conn.php'; 
                

				$sql = "SELECT * FROM team_members";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                   $image = (!empty($row['image_url'])) ? '../uploads/'.$row['image_url'] : '../uploads/profile.jpg';
                    
              echo "
                  <tr>
                     <td>".$row['firstname']."</td>
					            <td>".$row['lastname']."</td>
					            <td>" .$row['position']."</td>
					            <td>" . $row['department']."</td>
					            <td>" . $row['about']."</td>
                  <td>
                  <img src='" .$row['image_url'] . "' width='65'>

                  </td>
                  <td>
                <div class='action-buttons'>
                <button class='action-button' onclick=\"location.href='edit_member.php?member_id=" . $row['id'] . "'\">Edit</button>
                <button class='action-button delete-button' onclick=\"deleteMember(" . $row['id'] . ")\">Delete</button>
                
                </div>
            </td>
                  
            </tr>
            ";
}
?>

                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#membersTable').DataTable();
        });

        function deleteMember(id) {
            if (confirm("Are you sure you want to delete this member?")) {
                location.href = 'delete_member.php?id=' + id;
            }
        }

        function generatePDF() {
            //window.location.href = 'print_pdf.php', '_blank';
            window.open('print_pdf.php', '_blank');

        }

        function logoutf() {
            window.location.href = 'logout.php';

        }
        </script>
    </div>
</body>

</html>