<?php
/**
 * Created by PhpStorm.
 * User: garjo_099
 * Date: 10.01.16
 * Time: 17:40
 */

/** Задача 1 */

$query = "SELECT c.id, c.name, com.cnt FROM (SELECT customers_id, COUNT(*) AS cnt FROM comments GROUP BY customers_id ORDER BY cnt DESC LIMIT 1) AS com JOIN customers AS c ON c.id = com.customers_id";



/** Задача 2 */

$query = "select t1.name,
	max(case when t2.attr='qty' then t2.value end) as `qty`,
	max(case when t2.attr='group' then t2.value end) as `group`
from table1 t1 inner join table2 t2
	on t1.pid=t2.pid
group by t1.name";



/** Задача 3 */

function squareMatrixToString($squareMatrix)
{
    $result = '<hr><table style="text-align: center">';

    $squareMatrixSize = count($squareMatrix);

    for($i = 0; $i < $squareMatrixSize; $i++)
    {
        $result .= '<tr>';
        for($j = 0; $j < $squareMatrixSize; $j++)
        {
            $result .= '<td>'.$squareMatrix[$i][$j] . '</td>';
        }
        $result .= '</tr>';
    }

    return $result .= '</table>';
}
/*** Generate squareMatrix ***/

$squareMatrixSize = 10;
$squareMatrix = array();

for($i = 0; $i < $squareMatrixSize; $i++)
{
    $negative = [];

    for($j = 0; $j < $squareMatrixSize; $j++)
    {
        $rand = 10 - rand(0, 20);

        $squareMatrix[$i][$j] = $rand;

    }



    /**
    rsort($negative);

    foreach($negative as $num)
        $squareMatrix[$i][] = $num;
     */
}





echo squareMatrixToString($squareMatrix);
// TO DO:

$tmp = [];

for($col = 0; $col < $squareMatrixSize; $col++)
{
    $plus = [];
    $minus = [];
    for($row = 0; $row < $squareMatrixSize; $row++)
    {
        $num = $squareMatrix[$row][$col];
        if($num >= 0)
            $plus[] = $num;
        else
            $minus[] = $num;
    }

    $continueRow = count($plus);
    for($row = 0; $row < $continueRow; $row++)
        $squareMatrix[$row][$col] = array_shift($plus);


    $toEnd = count($minus);
    for($row = $continueRow; $row < $squareMatrixSize; $row++)
        $squareMatrix[$row][$col] = array_shift($minus);

}


echo squareMatrixToString($squareMatrix);

