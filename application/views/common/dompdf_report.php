<table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Price</th>
        <th>Sale price</th>
        <th>Sale count</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $key => $val) { ?>

        <tr>
            <td><?= $val['id'] ?></td>
            <td><?= $val['name'] ?></td>
            <td><?= $val['price'] ?></td>
            <td><?= $val['sale_price'] ?></td>
            <td><?= $val['sales_count'] ?></td>
            <td><?= $val['sale_date'] ?></td>
        </tr>
    <?php } ?>
    </tbody>

</table>
</body>
</html>