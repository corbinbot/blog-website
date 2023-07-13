<div class="filter-box">
    <h4>Looking For Specific Blogs? &nbsp;</h4>
    <div class="inner-filter">


        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Filter by Category
            </button>
            <ul class="dropdown-menu">
                <li> <a class="dropdown-item" href="index.php?filter=all">For All</a></li>
                <?php
                $categories = getAllCategory($db);
                foreach ($categories as $ct) {
                    ?>
                <li><a class="dropdown-item" href="index.php?filter=<?= $ct['id'] ?>">For
                        <?= $ct['name'] ?></a></li>

                <?php
                }
                ?>
            </ul>
        </div>



    </div>
    <form action="index.php" method="post" style="display:flex; margin-left:10px">
        <input class="form-control" name="word" type="text">
        <button style="margin-left:10px" type="submit" name="search" class="btn btn-outline-primary mx-4">Search
            Blog</button>
    </form>
</div>