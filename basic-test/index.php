<!DOCTYPE html>
<html>

<body>

    <?php

    $start = 0;
    $number = [];
    $operator = [];

    function split_text($text)
    {
        return explode(" ", $text);
    }

    function prepare_data_from_file(&$num, &$opt, &$first)
    {
        $myfile = fopen("datafile.txt", "r") or die("Unable to open file!");

        while (!feof($myfile)) {
            $split_str = split_text((fgets($myfile)));
            echo $split_str[0] . " ";
            echo $split_str[1] . "<br>";
            if ($split_str[0] == 'apply') {
                $first = $split_str[1];
            } else {
                $num[] = $split_str[1];
                $opt[] = $split_str[0];
            }
        }
        fclose($myfile);
    }

    prepare_data_from_file($number, $operator, $start);

    ?>

</body>

</html>