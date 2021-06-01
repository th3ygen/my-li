<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <title>Coordinator | Lecturers</title>
    <link rel="stylesheet" href="../styles/sandbox.css">

    <style>
        #updateStdList {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding-left: 0;
        }

        #updateStdList>li {
            display: flex;
            justify-content: space-between;

            transition: .3s all;
        }

        #updateStdList>li:hover {
            background: white;
        }

        #updateStdList>li.no-hov:hover {
            background: initial;
        }
    </style>
</head>

<body>
    <?php
    include('../common/db.php');

    if (!isset($_SESSION['username'])) {
        if ($_SESSION['role'] != 'admin') {
            header('Location: http://' . $CONFIGS['HOSTNAME'] . $CONFIGS['ROOT_PATH'] . '/login.html');
        }
        header('Location: http://' . $CONFIGS['HOSTNAME'] . $CONFIGS['ROOT_PATH'] . '/login.html');
    }

    $query = 'SELECT * FROM staff WHERE 1';

    $staffs = array();
    if ($res = $mysqli->query($query)) {
        if ($res->num_rows > 0) {
            while ($staff = $res->fetch_assoc()) {
                array_push($staffs, $staff);
            }
        }
    }

    /* $mysqli = new mysqli('localhost', 'root', '', 'myli') or die(mysqli_error($mysqli));
    $query = "SELECT * FROM student";

    $result = $mysqli->query($query); */

    ?>


    <!-- ################################################################################################ -->
    <!-- ADD Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../MyLi/process.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="name">Name</label>
                            <input type="text" name="stdName" class="form-control" id="name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="matric">Matric ID</label>
                            <input type="text" name="stdMatricId" class="form-control" id="matric" placeholder="Enter Matric ID" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" name="stdEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group py-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="stdPhone" class="form-control" id="phone" placeholder="012-3456789" required>
                        </div>
                        <div class="form-group py-2">
                            <select name="stdProg" class="custom-select custom-select-lg mb-3" required>
                                <option value="" selected disabled hidden>Program</option>
                                <option value="BCS">BCS</option>
                                <option value="BCG">BCG</option>
                                <option value="BCN">BCN</option>
                                <option value="DCS">DCS</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- UPDATE MODAL -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Student-Lecturer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="u_staffId" value="">

                    <div class="form-group py-2">
                        <label for="name">Name</label>
                        <input type="text" name="supervisorName" class="form-control" id="u_staffName" placeholder="Enter Name">
                    </div>
                    <div class="form-group py-2">
                        <label for="matric">Supervisee</label>
                        <ol id="updateStdList" style="width: 100%; background: #e6e6e6; overflow-y: auto; max-height: 50vh;">

                        </ol>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>
                    <button type="submit" id="updateSubmit" name="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="./process.php" method="POST">
                    <div class="modal-body">
                        <h4>Are you sure want to delete this Student?</h4>
                        <input type="hidden" name="deleteMe" id="deleteMe">
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SANDBOX Modal -->
    <div class="modal fade" id="sandboxModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./update.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group py-2">
                            <label for="name">Name</label>
                            <input type="text" name="stdName" class="form-control" id="stdName" placeholder="Enter Name">
                        </div>
                        <div class="form-group py-2">
                            <label for="matric">Matric ID</label>
                            <input type="text" name="stdMatricId" class="form-control" id="stdMatricId" placeholder="Enter Matric ID">
                        </div>
                        <div class="form-group py-2">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" name="stdEmail" class="form-control" id="stdEmail" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="form-group py-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="stdPhone" class="form-control" id="stdPhone" placeholder="012-3456789">
                        </div>
                        <div class="form-group py-2">
                            <select name="stdProg" class="custom-select custom-select-lg mb-3" id=stdProg>
                                <option selected>Program</option>
                                <option value="BCS">BCS</option>
                                <option value="BCG">BCG</option>
                                <option value="BCN">BCN</option>
                                <option value="DCS">DCS</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                            <label for="stdName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="stdName" id="stdName" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="stdMatricId" class="form-label">Matric ID</label>
                            <input type="text" class="form-control" name="stdMatricId" id="stdMatricId" placeholder="Enter Matric ID">
                        </div>
                        <div class="mb-3">
                            <label for="stdEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="stdEmail" id="stdEmail" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="stdPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="stdPhone" id="stdPhone" placeholder="Enter Phone">
                        </div>
                        <div class="mb-3">
                            <label for="stdProg" class="form-label">Programme</label>
                            <select name="stdProg" class="form-select" aria-label="Default select example">
                                <option selected>Programme</option>
                                <option value="BCS">BCS</option>
                                <option value="BCG">BCG</option>
                                <option value="BCN">BCN</option>
                                <option value="DCS">DCS</option>
                            </select>
                        </div> -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ################################################################################################ -->

    <div class="container">

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-heading text-center py-4 fs-1 fw-bold">
                <i class="fas fa-graduation-cap me-2"></i> MyLI
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="./sandbox.php">
                        <i style="width: 30px" class="fab fa-accusoft"></i>
                        User List
                    </a>
                </li>
                <li>
                    <a href="./report.html">
                        <i style="width: 30px" class="fas fa-chart-pie"></i>
                        Report
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Content -->
        <div id="content">

            <?php
            if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message'])
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>


            <div class="bg" style="z-index: -1;"></div>

            <!-- Navbar -->
            <nav class="navbar navbar-expand-xl navbar-light bg-transparent py-4 px-1">
                <div class="d-flex align-items-center">
                    <h2 class="fs-2 m-0" style="color:white;">Welcome <?php echo $_SESSION['username'] ?></h2>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" style="color:white;" href="http://localhost/sites/my-li/controllers/auth/logout.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i> <?php echo $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li style="float: right"><a class="dropdown-item" href="/login.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4" style="z-index: 2;">
                <!-- CARD -->
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">1337</h3>
                                <p class="fs-5">BCS</p>
                            </div>

                            <div class="std-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">69</h3>
                                <p class="fs-5">BCN</p>
                            </div>
                            <div class="sv-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">420</h3>
                                <p class="fs-5">BCG</p>
                            </div>
                            <div class="coor-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">1337</h3>
                                <p class="fs-5">DCS</p>
                            </div>
                            <div class="fac-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TABLE -->
                <div class="row g-5 my-4">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Student-Lecturer List</h5>
                                <div class="col">
                                    <!-- ADD MODAL TRIGGER -->
                                    <div class="icons">
                                        <i class="som-btn fas fa-plus fa-lg" style="float: right; padding: 10px; cursor: pointer" data-toggle="modal" data-target="#addModal"></i>
                                    </div>

                                    <table id="testTable" class="table bg-white rounded shadow-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="50px">No</th>
                                                <th scope="col">Supervisor</th>
                                                <th scope="col">Supervisee</th>
                                                <th scope="col" width="250px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $x = 0;
                                            foreach ($staffs as $staff) {
                                                $query = 'SELECT * FROM student WHERE supervisorId = ' . $staff['id'] . ' AND supervisorId >= 0';

                                                $list = '<ol>';
                                                if ($res = $mysqli->query($query)) {
                                                    if ($res->num_rows > 0) {
                                                        while ($student = $res->fetch_assoc()) {
                                                            $list .= '<li>[' . $student['matricId'] . '] ' . $student['stdName'] . '</li>';
                                                        }
                                                    }
                                                }
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$x; ?></td>
                                                    <td><?php echo $staff['name']; ?></td>
                                                    <td><?php echo $list; ?></td>
                                                    <td>
                                                        <button class="btn btn-info editBtn" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $staff['id']; ?>"><i class="far fa-edit"></i> Edit</button>
                                                        <button class="btn btn-danger"><i class="far fa-trash-alt deleteBtn"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>



    <!-- Popper.JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->

    <!-- jQuery CDN -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


    <!-- Table js -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


    <script>
        async function addStdToList(svId) {
            const selectStd = document.querySelector('#selectStd').value;

            const res = await $.get(`http://localhost/sites/my-li/coordinator/assignStudent.php?id=${svId}&matricId=${selectStd}`);

            if (res === '403') {
                return alert('Exceed limit of 5 students');
            }

            return updateStdList(svId);
        }

        async function updateStdList(id) {
            let list = '';

            const data = await $.get(`http://localhost/sites/my-li/coordinator/getstudents.php?id=${id}`);

            if (data !== '') {

                data.toString().split(',').forEach(i => {
                    const val = i.split('|');

                    list += `<li data-id="${val[0]}"><span>[${val[0]}] ${val[1]}</span><div class="btn btn-danger btn-remove-supervisee" onclick="removeStd(this)"><i class="far fa-trash-alt"></i></div></li>`
                });
            } else {
                list = 'No student';
            }

            list = await appendStudentDD(id, list);

            $('#updateStdList').html(list);

            return list;

        }

        async function appendStudentDD(id, list) {
            let stds = '';

            const data = await $.get('http://localhost/sites/my-li/coordinator/getAllStudents.php?filter=freeonly');

            data.toString().split(',').forEach(i => {
                const std = i.split('|');
                stds += `<option value=${std[0]}>[${std[0]}] ${std[1]}</option>`;
            });

            list += `<li class="no-hov">
            <select id="selectStd">
                ${stds}
            </select>
            <input type="button" value="Assign student" onclick="addStdToList('${id}')"/>
            </li>`;

            return list;
        }

        function removeStd(e) {
            $(e).parent().remove();
        }

        $(document).ready(function() {
            $('#testTable').DataTable();

            $('.deleteBtn').on('click', function() {
                $('#deleteModal').modal('show');

                $tr = $(this).closest('tr');

                let data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                $('#deleteMe').val(data[1]);

            });

            /* <div class="modal-body">
                <input type="hidden" id="u_staffId" name="id" value="">
                <input type="hidden" id="u_deletingIds" name="deletingIds" value="">
                <div class="form-group py-2">
                    <label for="name">Name</label>
                    <input type="text" name="supervisorName" class="form-control" id="u_staffName" placeholder="Enter Name">
                </div>
                <div class="form-group py-2">
                    <label for="matric">Supervisee</label>
                    <ol id="updateStdList" style="width: 100%; background: #e6e6e6; overflow-y: auto; max-height: 50vh;">

                    </ol>
                </div>
            </div> */
            $('#updateSubmit').on('click', () => {
                const id = $('#u_staffId').val();
                const name = $('#u_staffName').val();

                const ids = [];
                $('#updateStdList').children().each((x, e) => {
                    ids.push(`"${e.dataset.id}"`);
                });

                $.get(`http://localhost/sites/my-li/coordinator/updatelecturer.php?id=${id}&name=${name}&ids=${ids.join(',')}`, (data, status) => {
                    window.location.reload();
                });
            });


            $('.editBtn').on('click', async e => {
                const {
                    id
                } = e.target.dataset;

                $('#u_staffId').val(id);

                let list = await updateStdList(id);

                $('#updateStdList').html(list);
            });


        });
    </script>

    <!-- <script src="./scripts/index.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

</body>

</html>