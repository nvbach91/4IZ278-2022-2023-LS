<?php 
require_once('index.php');
$i=0;
?>
<nav aria-label="Pages ourProducts">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="<?php if($page>1){echo '?page='.$page-1;} ?>">Previous</a></li>
    <?php while($totalPages>$i):
        $i++;?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php endwhile ?>
    <li class="page-item"><a class="page-link" href="<?php if($page<$totalPages){echo '?page='.$page+1;} ?>">Next</a>
    </li>
  </ul>
</nav>