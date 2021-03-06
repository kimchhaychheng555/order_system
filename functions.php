<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/toastr.min.js"></script>

<?php
class ApplicationFunction
{

    function checkCurrentLoginUser()
    {
        include('config.php');


        $username = $_SESSION["username"];
        $password = $_SESSION["password"];

        $query = "SELECT id, fullname, username, password, image FROM data_user WHERE username = '$username' AND password = '$password'";
        $result = $dbConn->query($query);

        if ($result->num_rows > 0) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            return $result;
        }

        header("Location: login.php");
    }


    function backupDatabase()
    {
        include('config.php');


        // Get connection object and set the charset
        $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbDatabase);
        $conn->set_charset("utf8");


        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if (!empty($sqlScript)) {
            // Save the SQL script to a backup file
            $backup_file_name = $database_name . '_backup_' . time() . '.sql';
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);

            // Download the SQL backup file to the browser
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backup_file_name));
            ob_clean();
            flush();
            readfile($backup_file_name);
            exec('rm ' . $backup_file_name);
        }
    }

    function restoreDatabase()
    {

        // include('config.php');

        // $restore_file  = "C:/Users/Da/Downloads/_backup_1641909955.sql";
        // $server_name   = $dbServerName;
        // $username      = $dbUsername;
        // $password      = $dbPassword;
        // $database_name = $dbDatabase;

        // $cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
        // exec($cmd);
    }

    function loadingScreen()
    {
        echo '<div class="wrap-spinner">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>';
    }


    function toastr($type, $str)
    {
        echo '
            <script>    
            $(document).ready(function ' . $type . '() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "500",
                    "timeOut": "1800",
                    "extendedTimeOut": "2000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.' . $type . '("' . $str . '");
            });
        </script>';
    }
}