<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <table style="border: 1px solid black; border-collapse: collapse;">
        <thead>
            <tr style="border: 1px solid black; border-collapse: collapse;">
                <th>SID</th>
                <th>NAME</th>
            </tr>
        </thead>
        <?php
        $students  = array(
            array("sid" => "ST01", "name" => "Heng Dara"),
            array("sid" => "ST02", "name" => "Teng Sophea"),
            array("sid" => "ST03", "name" => "Chhet Kakada"),
        );

        foreach ($students as $student) {
            echo '<tr style="border: 1px solid black; border-collapse: collapse;">';

            foreach ($student as $key => $value) {
                echo '<td style="border: 1px solid black; border-collapse: collapse;">' . $student[$key] . '</td>';
            }

            echo '</td>';
        }
        ?>
    </table>


</body>

</html>