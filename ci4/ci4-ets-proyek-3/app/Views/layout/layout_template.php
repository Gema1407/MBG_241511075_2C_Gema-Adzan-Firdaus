<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'MBG Monitoring' ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .main-wrapper {
            display: flex;
            flex: 1;
        }

        #sidebar-themed {
            min-width: 250px;
            max-width: 250px;
            background: linear-gradient(to bottom, #6a11cb, #2575fc);
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar-themed.active {
            margin-left: -250px;
        }

        #sidebar-themed .nav-link {
            transition: background-color 0.2s;
        }

        #sidebar-themed .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        #sidebar-themed .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s;
        }

        #content-container {
            padding: 20px;
        }

        @media (max-width: 768px) {
            #sidebar-themed {
                margin-left: -250px;
            }

            #sidebar-themed.active {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?= $this->include('layout/sidebar') ?>

        <div id="content">
            <?= $this->include('layout/navbar') ?>

            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar-themed').classList.toggle('active');
        });
    </script>
</body>

</html>