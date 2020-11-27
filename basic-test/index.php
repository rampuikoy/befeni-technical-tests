<!DOCTYPE html>
<html>

<body>

    <?php
        function prepare_data_from_file(&$num, &$opt){
            $myfile = fopen("datafile.txt", "r") or die("Unable to open file!");
            // Output one line until end-of-file
            while (!feof($myfile)) {
                echo fgets($myfile) . "<br>";
            }
            fclose($myfile);
        }

        prepare_data_from_file();
    ?>

</body>

</html>