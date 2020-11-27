<!DOCTYPE html>
<html>

<body>

    <?php

    $start = 0;
    $number = [];
    $operator = [];

    function split_text_test(){
        $right_text = "add 2";
        $assert = split_text($right_text);
        if($assert[0] == 'add' && $assert[1] == '2'){
            echo 'Split text function test is pass!! </br>';
        }else {
            echo 'Split text function test is error </br>';
        }
    }

    function prepare_data_from_file_test(){
        $num = [];
        $opt = [];
        $first = 0;
        $assert = prepare_data_from_file($num, $opt, $first, "unittestdata.txt");
        if($num[0] == 1 && $num[3] == 7 && $opt[0] =='add' && $opt[3] == 'multiply' && $first == 5){
            echo 'prepare data from file function test is pass!! </br>';
            
        }else {
            echo 'prepare data from file function test is error </br>';
        }
    }

    function main_test(){
        $num = [];
        $opt = [];
        $first = 0;
        $assert = prepare_data_from_file($num, $opt, $first, "unittestdata.txt");
        main($first, $num, $opt);
        if($first == 14){
            echo 'main function test is pass!! </br>';
        }else {
            echo 'main test is error </br>';
        }
    }

    function split_text($text)
    {
        return explode(" ", $text);
    }
    
    function prepare_data_from_file(&$num, &$opt, &$first, $file)
    {
        $myfile = fopen($file, "r") or die("Unable to open file!");

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
    }
    echo '-------------------------TEST------------------------------------- </br>';
    split_text_test();
    prepare_data_from_file_test();
    main_test();

    echo '-----------------------------Real Result-------------------------- </br>';
    prepare_data_from_file($number, $operator, $start, "datafile.txt");

    main($start, $number, $operator);
    echo "</br> Total is ".$start;

    ?>

</body>

</html>