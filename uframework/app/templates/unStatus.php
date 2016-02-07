<div style="border-style:solid;
            border:1px;">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Author</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $status->getUser(); ?></td>
                <td><?php echo $status->getMessage(); ?></td>
                <td><?php echo $status->getDate(); ?></td>
            </tr>
        </tbody>
    </table>
    <a href="/statuses">'<input type='button' class='btn btn-primary' value='Liste statuts'/></a>
</div>