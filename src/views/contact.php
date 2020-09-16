<?php
$number = '34334455';
$string = (new \App\model\User())->parseNumber($number);
echo '<pre>';
var_dump($string);
echo '</pre>';
?>
<table id="userlist" class="table">
    <thead>
    <tr>
        <th scope="col">First name</th>
        <th scope="col">Surname</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
    </tr>
    </thead>

    <tbody>
        <tr>
            <th><?= $user['firstname']?></th>
            <th><?= $user['lastname']?></th>
            <th><?= $user['email']?></th>
            <th><?= $user['phone']?></th>
        </tr>

    </tbody>

</table>
