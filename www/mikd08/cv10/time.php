<?php
    session_start();
?>

<?php require "header.php"?>

<body>
<table>
      <tr>
        <th>City</th>
        <th>Time</th>
        <th>Difference</th>
      </tr>
      <tr>
        <td>New York</td>
        <td><?php echo date("m-d-Y H:i:s", time()-6*3600); ?></td>
        <td><?php echo "-".date("H:i:s", 6*3600); ?></td>
      </tr>
      <tr>
        <td>London</td>
        <td><?php echo date("d-m-Y H:i:s", time()+3600); ?></td>
        <td><?php echo "-".date("H:i:s", 3600); ?></td>
      </tr>
      <tr>
        <td>Tokyo</td>
        <td><?php echo date("Y-m-d H:i:s", time()+9*3600); ?></td>
        <td><?php echo "+".date("H:i:s", 9*3600); ?></td>
      </tr>
      <tr>
        <td>Ha Noi</td>
        <td><?php echo date("d-m-Y H:i:s", time()+7*3600); ?></td>
        <td><?php echo "+".date("H:i:s", 7*3600); ?></td>
      </tr>
      <tr>
        <td>Prague</td>
        <td><?php echo date("d-m-Y H:i:s", time()); ?></td>
        <td><?php echo "+".date("H:i:s", time()-time()); ?></td>
      </tr>
    </table>
</body>

<?php require "footer.php"?>