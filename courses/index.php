<?php
    require(dirname(dirname(__FILE__)) . '/init.php');

    use App\Course;
    use App\Teacher;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Add a class</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <span class="navbar-text text-white px-3">
                    PDC10 - Class Management
                </span>
            </div>
        </nav>

        <nav class="nav flex-column bg-dark">
            <a class="nav-link active" aria-current="page" href="#">Classes</a>
            <a class="nav-link" href="#">Students</a>
            <a class="nav-link" href="#">Teachers</a>
            <a class="nav-link" href="#">Class Rosters</a>
        </nav>

            <table class="table table-dark table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Class Code</th>
            <th scope="col">Teacher ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($courses as $course)
                {   
                $id = $course['teacherID'];
                $teacher = new Teacher('');
                $teacher->setConnection($connection);
                $teacherInfo = $teacher->getById($id);
            ?>
            <tr>
                <th scope="row"><?php echo $course['id'] ?></th>
                <td><?php echo $course['name'] ?></td>
                <td><?php echo $course['description'] ?></td>
                <td><?php echo $course['classCode'] ?></td>
                <td><?php echo $course['teacherID'] ?></td>
                <td><?php echo $teacherInfo['name'] ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
        </table>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>