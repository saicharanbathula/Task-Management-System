<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2; 
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; 
        }
        .suggestion-urgent {
            background-color: #ffcccb; 
        }

        .suggestion-normal {
            background-color: #ccffcc; 
        }
        
        .suggestion-info {
            background-color: #add8e6; 
        }
    </style>
</head>
<body>
    <h1>Suggestions</h1>

    <table>
        <thead>
            <tr>
                <th>User ID</th>  
                <th>User Name</th>
                <th>Email</th>  
                <th>Suggestion</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $qry = $conn->query("SELECT u.id AS user_id, u.firstname, u.lastname, u.email, s.suggestion, s.created_at 
                                 FROM suggestions s 
                                 INNER JOIN users u ON s.user_id = u.id 
                                 ORDER BY s.created_at DESC");

            while ($row = $qry->fetch_assoc()) {
                $user_name = $row['firstname'] . ' ' . $row['lastname']; 
                $suggestion_class = 'suggestion-normal'; 
                if (strpos($row['suggestion'], 'urgent') !== false) {
                    $suggestion_class = 'suggestion-urgent'; 
                } elseif (strpos($row['suggestion'], 'info') !== false) {
                    $suggestion_class = 'suggestion-info'; 
                }

                echo "<tr class='{$suggestion_class}'>
                        <td>{$row['user_id']}</td>  <!-- Display User ID -->
                        <td>{$user_name}</td>
                        <td>{$row['email']}</td>  <!-- Display Email -->
                        <td>{$row['suggestion']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
