<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index of /PHPLearning</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container-fluid {
            padding: 20px;
        }
        .folder-card {
            text-align: center;
            transition: 0.3s;
            border: none;
            background: #ffffff;
        }
        .folder-card:hover {
            background: #ffcc80; /* Light Orange */
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        .folder-icon {
            font-size: 50px;
            color: #ffc107;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center mb-4">📁 Index of /PHPLearning</h2>
        
        <div class="row row-cols-1 row-cols-md-4 g-2">
            <!-- Parent Directory -->
            <div class="col">
                <a href="../">
                    <div class="card folder-card p-3">
                        <div class="card-body">
                            <i class="fas fa-folder folder-icon"></i>
                            <h5 class="card-title">Parent Directory</h5>
                        </div>
                    </div>
                </a>
            </div>

            <?php
                $dir = __DIR__; // Get current directory
                $files = scandir($dir);

                foreach ($files as $file) {
                    if ($file != "." && $file != ".." && is_dir($file)) {
                        echo "
                            <div class='col'>
                                <a href='$file/'>
                                    <div class='card folder-card p-3'>
                                        <div class='card-body'>
                                            <i class='fas fa-folder folder-icon'></i>
                                            <h5 class='card-title'>$file</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
