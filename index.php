<?php

require_once ('db.php');

// function Add
// hup khar jark form ma kep vai
if(isset($_REQUEST['btn_add'])){
  $name = $_REQUEST['name'];
  $surname = $_REQUEST['surname'];
  $email = $_REQUEST['email'];
  $tel = $_REQUEST['tel'];
  $department = $_REQUEST['department'];

  if(empty($name)) {
    $errorMsg = "please enter ";
  } elseif (empty($surname)){
    $errorMsg = "please enter ";
  }
  elseif (empty($email)){
    $errorMsg = "please enter ";
  }
  elseif (empty($tel)){
    $errorMsg = "please enter ";
  }
  elseif (empty($department)){
    $errorMsg = "please enter ";
  } else {

    try {
      if(!isset($errorMsg)){
        $insert_stmt = $conn->prepare("INSERT INTO employee(name, surname, email, tel, department) VALUES (:nname, :ssurname, :eemail, :ttel, :ddepartment) ");
        $insert_stmt->bindParam(':nname',$name);
        $insert_stmt->bindParam(':ssurname',$surname);
        $insert_stmt->bindParam(':eemail',$email);
        $insert_stmt->bindParam(':ttel',$tel);
        $insert_stmt->bindParam(':ddepartment',$department);

        if($insert_stmt->execute()){
          $insertMsg = "Insert Success....";
          header("refresh:1;index.php");
        }

      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}


// Function Update
if(isset($_REQUEST['update_id'])){
  
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM employee WHERE id = :id ");
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        // extract($row);
        echo $row['name'];
        echo $row['surname'];
        echo $row['email'];
        echo $row['tel'];
        echo $row['department'];
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
}

if(isset($_REQUEST['btn_update'])){
  $name_up = $_REQUEST['name'];
  $surname_up = $_REQUEST['surname'];
  $email_up = $_REQUEST['email'];
  $tel_up = $_REQUEST['tel'];
  $department_up = $_REQUEST['department'];

  if(empty($name_up)) {
    $error_upMsg = "please enter ";
  } elseif (empty($surname_up)){
    $error_upMsg = "please enter ";
  }
  elseif (empty($email_up)){
    $error_upMsg = "please enter ";
  }
  elseif (empty($tel_up)){
    $error_upMsg = "please enter ";
  }
  elseif (empty($department_up)){
    $error_upMsg = "please enter ";
  } else {

    try{
      if(!isset($error_upMsg)){
        $update_stmt = $conn->prepare("UPDATE employee SET name = :name_up, surname = :surname_up, email = :email_up, tel = :tel_up, department = :department_up WHERE id = :id");
        $update_stmt->bindParam(':name_up',$name_up);
        $update_stmt->bindParam(':surname_up',$surname_up);
        $update_stmt->bindParam(':email_up',$email_up);
        $update_stmt->bindParam(':tel_up',$tel_up);
        $update_stmt->bindParam(':department_up',$department_up);
        $update_stmt->bindParam(':id',$id);

        if($update_stmt->execute()){
          $updateMsg = "Update Success.....";
          // header("refresh:1;index.php");
        }
      
      }
      
    } catch (PDOException $e){
      echo $e->getMessage();
    }

  } 
}

// Function Delete 

if (isset($_REQUEST['delete_id'])) {
  $id = $_REQUEST['delete_id'];

  $select_stmt = $conn->prepare("SELECT * FROM employee WHERE id = :id");
  $select_stmt->bindParam(':id', $id);
  $select_stmt->execute();
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

  $delete_stmt = $conn->prepare('DELETE FROM employee WHERE id = :id');
  $delete_stmt->bindParam(':id', $id);
  $delete_stmt->execute();

  header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Bootstrap Form</title>
</head>
<body>

<style>
  /* style.css */
* { 
	margin: 0; 
	padding: 0; 
	box-sizing: border-box; 
} 

body { 
	font-family: Arial, sans-serif; 
	background-color: #f2f2f2; 
} 

.container { 
	margin: 20px auto; 
} 

.progress-container { 
	text-align: center; 
	margin-bottom: 30px; 
} 

#progressbar { 
	list-style-type: none; 
	display: flex; 
	justify-content: space-between; 
	color: lightgrey; 
} 

#progressbar li { 
	flex: 1; 
	text-align: center; 
	font-size: 15px; 
	font-weight: bold; 
	position: relative; 
} 

#progressbar li.active { 
	color: #2F8D46; 
} 

.progress { 
	height: 20px; 
	background-color: lightgray; 
	border-radius: 5px; 
	overflow: hidden; 
} 

.progress-bar { 
	background-color: #2F8D46; 
	width: 0; 
	height: 100%; 
	transition: width 0.4s ease-in-out; 
} 

.step-container fieldset { 
	background: white; 
	border: 1px solid #ccc; 
	border-radius: 5px; 
	box-sizing: border-box; 
	width: 100%; 
	margin: 0; 
	padding-bottom: 20px; 
	position: relative; 
	display: none; 
} 

.step-container fieldset:first-of-type { 
	display: block; 
} 

h2 { 
	color: #2F8D46; 
	margin-top: 10px; 
	text-align: center; 
} 

.next-step, 
.previous-step { 
	width: 100px; 
	font-weight: bold; 
	color: white; 
	border: 0 none; 
	border-radius: 5px; 
	cursor: pointer; 
	padding: 10px 5px; 
	margin: 10px 5px 10px 0px; 
	float: right; 
} 

.next-step { 
	background: #2F8D46; 
} 

.previous-step { 
	background: #616161; 
} 

.next-step:hover, 
.next-step:focus { 
	background-color: #1e6f3e; 
} 

.previous-step:hover, 
.previous-step:focus { 
	background-color: #4d4d4d; 
} 

.text { 
	color: #2F8D46; 
	font-weight: normal; 
} 

.finish { 
	text-align: center; 
}

</style>

<div class="container w-75 ">
<div class="container"> 
        <div class="progress-container"> 
            <ul id="progressbar"> 
                <li class="active" 
                    id="step1"> 
                    <strong>Step 1</strong> 
                </li> 
                <li id="step2"> 
                      <strong>Step 2</strong> 
                  </li> 
                <li id="step3"> 
                      <strong>Step 3</strong> 
                  </li> 
                <li id="step4"> 
                      <strong>Step 4</strong> 
                  </li> 
            </ul> 
            <div class="progress"> 
                <div class="progress-bar"></div> 
            </div> 
        </div> 
        <div class="step-container"> 
            <fieldset> 
                <h2>Welcome To GFG Step 1</h2> 
                <input type="button"
                       name="next-step"
                       class="next-step"
                       value="Next Step" /> 
            </fieldset> 
            <fieldset> 
                <h2>Welcome To GFG Step 2</h2> 
                <input type="button"
                       name="next-step" 
                       class="next-step" 
                       value="Next Step" /> 
                <input type="button"
                       name="previous-step" 
                       class="previous-step" 
                       value="Previous Step" /> 
            </fieldset> 
            <fieldset> 
                <h2>Welcome To GFG Step 3</h2> 
                <input type="button" 
                       name="next-step" 
                       class="next-step" 
                       value="Final Step" /> 
                <input type="button" 
                       name="previous-step" 
                       class="previous-step" 
                       value="Previous Step" /> 
            </fieldset> 
            <fieldset> 
                <div class="finish"> 
                    <h2 class="text"> 
                        <strong>FINISHED</strong> 
                    </h2> 
                </div> 
                <input type="button" 
                       name="previous-step" 
                       class="previous-step"
                       value="Previous Step" /> 
            </fieldset> 
        </div> 
    </div> 
</div>

<div class="d-flex row justify-content-center ">
  <div class="col-md-4">

  <!-- function check error -->
  <?php
    if (isset($errorMsg)){  
    ?>
      <div class="alert alert-danger">
        <strong>Wrong! <?php echo $errorMsg ?> </strong>
      </div>

    <?php } ?>

    <?php
    if (isset($error_upMsg)){  
    ?>
      <div class="alert alert-danger">
        <strong>Wrong! <?php echo $error_upMsg ?> </strong>
      </div>

    <?php } ?>

    <?php
    if (isset($insertMsg)){  
    ?>
      <div class="alert alert-success">
        <strong>Success! <?php echo $insertMsg ?> </strong>
      </div>

    <?php } ?>
    <!-- Form Insert -->

  <div class="container w-75 mt-5 shadow-sm p-3 mb-5 bg-body rounded">
  <h2 class="text-center fw-bold " style = "font-size: 16px;">Employee Information</h2>
  
  <form method="post" class="form-horizontal">
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input type="text" class="form-control" disabled name="id" value="<?php echo $row['id']; ?>">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
    </div>
    <div class="mb-3">
      <label for="surname" class="form-label">Surname</label>
      <input type="text" class="form-control" name="surname" value="<?php echo $row['surname']; ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
    </div>
    <div class="mb-3">
      <label for="tel" class="form-label">Telephone Number</label>
      <input type="tel" class="form-control" name="tel" value="<?php echo $row['tel']; ?>">
    </div>
    <div class="mb-3">
      <label for="department" class="form-label">Department</label>
      <select class="form-select" name="department">
        <option value="hr">Human Resources</option>
        <option value="finance">Finance</option>
        <option value="it">IT</option>
        <option value="it">NT</option>
        <!-- Add more options as needed -->
      </select>
    </div>
      <div class="d-flex row">
      <div class="col-md-3 justify-content-center align-items-center">
    <input class="btn btn-success" type="submit" name="btn_add" value="ADD" >
    </div>
    <div class="col-md-3 justify-content-center align-items-center">
    <input class="btn btn-success" type="submit" name="btn_update" value="UPDATE" >
    </div>
  </form>
      </div>
</div>

  </div>
  <!-- Table Sadaeng phon -->
  <div class="col-md-8 mt-5 align-items-top"> 
    <table class=" table table-striped">
      <thead class="text-center">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Surname</th>
          <th>Email</th>
          <th>Tel</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-start">
        <?php 

          // $sql = "SELECT id, name, surname, email, tel, department FROM employee";
          // $result = $conn->query($sql);
          $result = $conn->prepare("SELECT * FROM employee");
          $result->execute();

          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td><?php echo $row['id']; ?> </td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['surname']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['tel']; ?></td>
          <td><?php echo $row['department']; ?></td>
          <!-- Button Edit -->
          <td>
            <a href="?update_id=<?php echo $row['id'];?>" class="btn btn-warning">Edit</a>
        </td>
        <!-- Button Delete -->
        <td>
          <a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">Del</a>
        </td>
        </tr>

        <?php } ?>
      </tbody>
    </table>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // script.js 
document.addEventListener("DOMContentLoaded", function () { 
	const progressListItems = 
		document.querySelectorAll("#progressbar li"); 
	const progressBar = 
		document.querySelector(".progress-bar"); 
	let currentStep = 0; 

	function updateProgress() { 
		const percent = 
			(currentStep / (progressListItems.length - 1)) * 100; 
		progressBar.style.width = percent + "%"; 

		progressListItems.forEach((item, index) => { 
			if (index === currentStep) { 
				item.classList.add("active"); 
			} else { 
				item.classList.remove("active"); 
			} 
		}); 
	} 

	function showStep(stepIndex) { 
		const steps = 
			document.querySelectorAll(".step-container fieldset"); 
		steps.forEach((step, index) => { 
			if (index === stepIndex) { 
				step.style.display = "block"; 
			} else { 
				step.style.display = "none"; 
			} 
		}); 
	} 

	function nextStep() { 
		if (currentStep < progressListItems.length - 1) { 
			currentStep++; 
			showStep(currentStep); 
			updateProgress(); 
		} 
	} 

	function prevStep() { 
		if (currentStep > 0) { 
			currentStep--; 
			showStep(currentStep); 
			updateProgress(); 
		} 
	} 

	const nextStepButtons = 
		document.querySelectorAll(".next-step"); 
	const prevStepButtons = 
		document.querySelectorAll(".previous-step"); 

	nextStepButtons.forEach((button) => { 
		button.addEventListener("click", nextStep); 
	}); 

	prevStepButtons.forEach((button) => { 
		button.addEventListener("click", prevStep); 
	}); 
});

</script>
</body>
</html>

</body>
</html>