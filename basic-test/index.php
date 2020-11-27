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

    function main(&$first, &$num, &$opt)
    {
        $i = 0;
        foreach ($opt as $item) {
            switch ($item) {
                case 'add':
                    $first += $num[$i];
                    break;
                case 'multiply':
                    $first *= $num[$i];
                    break;
                case 'subtract':
                    $first -= $num[$i];
                    break;
                case 'divide':
                    $first /= $num[$i];
                    break;
            }
            $i +=1;
        }
        echo "Total is ".$first;
    }

    prepare_data_from_file($number, $operator, $start);

    main($start, $number, $operator);

    ?>

</body>

</html>