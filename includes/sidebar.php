<div class="col-4">

  <div class="related-card mb-3">
    <h3 style="margin:10px">Related Posts</h3>
    <!-- <h5 class="card-header">Featured</h5> -->
    <div>
      <?php

      $postQuery = "SELECT * FROM posts  
ORDER BY RAND() LIMIT 2";
      $runPQ = mysqli_query($db, $postQuery);
      while ($post = mysqli_fetch_assoc($runPQ)) {

        ?>
        <div class="card-body" style="border-bottom: 1px solid #e1d6d6;">
          <h5 class="card-title"><?php echo $post['title'] ?></h5>
          <a href="post.php?title=<?= str_replace(" ", "-", $post['title']) ?>&id=<?php echo $post['id'] ?>"
            class="btn btn-primary">Read More</a>
        </div>

        <?php

      }

      ?>
    </div>
  </div>




</div>