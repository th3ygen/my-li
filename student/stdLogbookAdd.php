<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <title>Sandbox</title>
    <link rel="stylesheet" href="../styles/logbookAdd.css">
</head>

<body>
    <div class="container">

        <!-- SIDEFUCKINGBAR -->
        <nav id="sidebar">
            <div class="sidebar-heading text-center py-4 fs-1 fw-bold">
                <i class="fas fa-graduation-cap me-2"></i> MyLI
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="./stdBulletin.html">
                        <i style="width: 30px" class="far fa-newspaper"></i> Bulletin
                    </a>
                </li>
                <li>
                    <a href="#logbookSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i style="width: 30px" class="fas fa-book "></i>
                        Logbook
                    </a>
                    <ul class="collapse list-unstyled show" id="logbookSub">
                        <li>
                            <a class="active" href="./stdLogbookAdd.php">
                                <i style="width: 30px" class="fas fa-plus"></i>
                                Add Logbook
                            </a>
                        </li>
                        <li>
                            <a href="./stdLogbookView.php">
                                <i style="width: 30px" class="far fa-eye"></i>
                                View Logbook
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="./stdSvinfo.html">
                        <i style="width: 30px" class="fas fa-info "></i>
                        Supervisor Info
                    </a>
                </li>
                <li>
                    <a href="./stdReport.html">
                        <i style="width: 30px" class="fas fa-chart-pie"></i>
                        Report
                    </a>
                </li>
            </ul>
        </nav>

        <!-- NAVBAR -->
        <div id="content">
            <nav class="navbar navbar-expand-xl navbar-light bg-transparent py-4 px-1">
                <div class="d-flex align-items-center">
                    <h2 class="fs-2 m-0">Welcome Skywall3r-!</h2>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Ibn Skywall3r-
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li style="float: right"><a class="dropdown-item" href="/login.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- CONTENT -->
            <div class="container-fluid px-4">
                <div class="row g-5 my-4">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Logbook</h5>
                                <div class="col">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" placeholder="Title">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Date</label>
                                                <input type="date" class="form-control" id="datepicker" placeholder="6/9/1969">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="entry">Entry</label>
                                            <textarea class="form-control" rows="5" id="entry" name="text"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Publish</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <script>
        $('.datepicker').datepicker();
    </script>
</body>

</html>