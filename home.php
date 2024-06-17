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
    <link rel="stylesheet" href="./styles/modal.css" />
    <link rel="stylesheet" href="./styles/frmbtn.css" />
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

   /*=================*/
   /* Modal styling */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    animation: fadeIn 0.5s;
    transition: opacity 0.5s ease;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    animation: fadeIn 0.5s;
}

.close {
    color: #111111;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #520202;
    text-decoration: none;
    cursor: pointer;
}

.user-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.field-group {
    display: flex;
    flex-direction: column;
}

fieldset {
    border: none;
    padding: 0;
    margin-bottom: 10px;
}

.details {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="file"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: none;
    height: 100px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

    
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Welcome! - Team Members Dashboard</div>
        <!-- <h1>Team Members Dashboard</h1> -->
        <div class="content">
            <div class="row">
                <div>
                    <!--<button class='action-button' onclick="window.location.href='add_member.php'">Add Member</button>-->
                    <button class='action-button' id="openModal2">Add Member</button>
                </div>

                <div>
                    <button class="pull-left-logout" onclick="logoutf()">Logout</button>
                </div>
                <div>
                    <button class="pull-left" onclick="generatePDF()">Generate PDF</button>
                </div>

                <div>
                    <button class="trigger-button" id="openModal">Send Email</button>
                    <!--<button class="pull-left-email" onclick="sendMail()">Send email</button>-->
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

        <!--Email modal form-->
        <div id="contactModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="contact" action="mail.php" method="post">
                <div class="title">Send email</div>
                
                    <fieldset>
                        <input placeholder="Your name" name="name" type="text" tabindex="1" autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your department" name="department" type="text" tabindex="2" autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Email Address" name="email" type="email" tabindex="3">
                    </fieldset>
                    <fieldset>
                        <input type="datetime-local" id="birthdaytime" name="emaildatetime">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Type your subject line" type="text" name="subject" tabindex="4">
                    </fieldset>
                    <fieldset>
                        <textarea name="message" placeholder="Type your Message Details Here..."
                            tabindex="5"></textarea>
                    </fieldset>
                    <fieldset>
                        <button  class="button" style="background-color: #4CAF50; " type="submit" name="send" id="contact-submit">Send</button>
                    </fieldset>
                </form>
            </div>
        </div>
<!--End of Email modal form-->


 <!--Add member modal form-->
 <div id="contactModal2" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal2">&times;</span>
        <form id="contact" action="add_member_handler.php" method="post" enctype="multipart/form-data">
            <div class="title">Add Team Member</div>

            <div class="user-details">
                <div class="field-group">
                    <fieldset>
                        <span class="details">First Name</span>
                        <input type="text" name="firstname" placeholder="First name" tabindex="1" required >
                    </fieldset>
                    <fieldset>
                        <span class="details">Last Name</span>
                        <input type="text" name="lastname" placeholder="Last name" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <span class="details">Position</span>
                        <input type="text" name="position" placeholder="Position" tabindex="3" required>
                    </fieldset>
                </div>
                <div class="field-group">
                    <fieldset>
                        <span class="details">Department</span>
                        <input type="text" name="department" placeholder="Department" tabindex="4" required>
                    </fieldset>
                    <fieldset>
                        <span class="details">About</span>
                        <textarea name="about" placeholder="Write something about yourself..." tabindex="5" required></textarea>
                    </fieldset>
                    <fieldset>
                        <span class="details">Profile Picture</span>
                        <input type="file" name="image" tabindex="6" required>
                    </fieldset>
                </div>
            </div>
            <fieldset>
                <input style="background-color: #4CAF50; color: white;" type="submit" name="add_member" value="Add Member">
            </fieldset>
        </form>
    </div>
</div>
<!-- End of modal form -->


<!-- Edit team member modal -->
<div id="contactModal3" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal3">&times;</span>
        <div class="title">Edit Team Member</div>
        <div class="content">
            <form method="POST" action="edit_member_handler.php" enctype="multipart/form-data">
                <div class="user-details">
                    <input type="hidden" name="member_id" value="">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" name="firstname" value="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" name="lastname" value="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Position</span>
                        <input type="text" name="position" value="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Department</span>
                        <input type="text" name="department" value="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">About</span>
                        <textarea name="about" required></textarea>
                    </div>
                    <div class="input-box">
                        <span class="details">Profile Picture</span>
                        <input type="file" name="profile_picture">
                    </div>
                    <div>
                        <img src="" alt="Current Profile Picture" width="150">
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Update" name="update_member">
                </div>
            </form>
        </div>
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

        function sendMail() {
            //window.location.href = 'print_pdf.php', '_blank';
            window.open('phpmailer/index.php', '_blank');

        }


        function logoutf() {
            window.location.href = 'logout.php';

        }

        //=======Get modal element========
        var modal = document.getElementById("contactModal");

        // Get open modal button
        var openModalButton = document.getElementById("openModal");

        // Get close button
        var closeModalButton = document.getElementById("closeModal");

        // Listen for open click
        openModalButton.onclick = function() {
            modal.classList.add("show");
        }

        // Listen for close click
        closeModalButton.onclick = function() {
            modal.classList.remove("show");
        }

        // Listen for outside click
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove("show");
            }
        }
        //====End of modal element=====

        //========================================================

         //=======Get modal element for add new member========
         var modal2 = document.getElementById("contactModal2");

        // Get open modal button
        var openModalButton2 = document.getElementById("openModal2");

        // Get close button
        var closeModalButton2 = document.getElementById("closeModal2");

        // Listen for open click
        openModalButton2.onclick = function() {
            modal2.classList.add("show");
        }

        // Listen for close click
        closeModalButton2.onclick = function() {
            modal2.classList.remove("show");
        }

        // Listen for outside click
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.classList.remove("show");
            }
        }
        //====End of modal element for add new member=====



         //========================================================

         //=======Get modal element for Edit member========
         // Function to open the Edit modal and pass the member_id
function openEditModal(member_id) {
    var modal3 = document.getElementById("contactModal3");
    var member_id_input = document.querySelector("input[name='member_id']");
    member_id_input.value = member_id;

    // Fetch member details via AJAX or directly set in the form (if preloaded)
    fetch('get_member.php?member_id=' + member_id)
        .then(response => response.json())
        .then(data => {
            // Set form fields with fetched data
            document.querySelector("input[name='firstname']").value = data.firstname;
            document.querySelector("input[name='lastname']").value = data.lastname;
            document.querySelector("input[name='position']").value = data.position;
            document.querySelector("input[name='department']").value = data.department;
            document.querySelector("textarea[name='about']").value = data.about;
            document.querySelector("img[src]").src = data.image_url; // Update the current profile picture

            modal3.style.display = "block"; // Show the modal
        })
        .catch(error => console.error('Error fetching member data:', error));
}

// Close the modal for Edit member
var closeModalButton3 = document.getElementById("closeModal3");
closeModalButton3.onclick = function() {
    var modal3 = document.getElementById("contactModal3");
    modal3.style.display = "none"; // Hide the modal
}

window.onclick = function(event) {
    var modal3 = document.getElementById("contactModal3");
    if (event.target == modal3) {
        modal3.style.display = "none"; // Hide the modal
    }
}

        //====End of modal element for Edit member=====
        </script>
    </div>
</body>

</html>