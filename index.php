<?php
    $conn = mysqli_connect('localhost','root','root', 'userslist', '3306');
    $users_qry = mysqli_query(
        $conn,
        'SELECT users.id, first_name, last_name, GROUP_CONCAT(teams.name) AS `teams_name` 
                    FROM users 
                    LEFT JOIN teams_users ON (teams_users.user_id = users.id) 
                    LEFT JOIN teams ON (teams.id = teams_users.team_id) 
                GROUP BY users.id'
    );
?>

<!doctype html>
<html lang="en">
<head>
    <title>Users List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Users List</h1>
    </div>
    <div class="container">

        <?php if (mysqli_num_rows($users_qry) > 0) { ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Team(s)</th>
                </tr>
                <?php while ($user = mysqli_fetch_assoc($users_qry)){ ?>
                    <tr>
                        <td><?=$user['id']?></td>
                        <td><?=$user['first_name']?> <?=$user['last_name']?></td>
                        <td><?=$user['teams_name']?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="text-center">
                <i>
                    Users not found
                </i>
            </div>
        <?php } ?>
    </div>
</body>
</html>