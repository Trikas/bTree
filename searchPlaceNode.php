<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
if ($_POST['uid']) {
    try {
        $node = new PlaceNode($_POST['uid']);
        $node->startSortCollect();
        $resultCollection = $node->getResultCollection();
        $searchItem = $node->getUidSearch();
    } catch (Exception $exception) {
        echo $exception->getMessage();
        ?><br><a href="/">Вернуться на главную</a>
        <?php
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOW PLACE NODE</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>
<body>
<?php if (isset($resultCollection)): ?>
    <a href="/">Домой</a>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Путь</th>
        <th scope="col">Уровень</th>
        <th scope="col">ParentId</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($resultCollection as $item): ?>
            <?php if ($searchItem == $item->uid): ?>
                <tr class="table-info">
                    <th scope="row"><?=$item->uid?></th>
                    <td><?=$item->path?></td>
                    <td><?=$item->level?></td>
                    <td><?=$item->parent_id?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <th scope="row"><?=$item->uid?></th>
                    <td><?=$item->path?></td>
                    <td><?=$item->level?></td>
                    <td><?=$item->parent_id?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
</body>
</html>
