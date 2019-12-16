<nav>

    <link rel="stylesheet" media="all" href="<?php echo url_for('/styles/public.css'); ?>" />

    <?php $nav_subjects = find_all_subjects(['visible' => true]); ?>

    <ul class="subjects">
        <!-- this is just a simple while loop looping through and displaying the results as links -->
        <?php while ($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
            <!-- if nav sbject is not visible, go to the next loop -->
            
            <li>
                <!-- this is just some fat a tag with the menu names being inked back to the page -->
                <a href="<?php echo url_for('index.php'); ?>">
                    <?php echo ht($nav_subject['menu_name']); ?>
                </a>

                <?php $nav_pages = find_pages_by_subject_id($nav_subject['id'], ['visible' => true]); ?>

                <ul class="pages">
                    <!-- basically a 2d array youre looping through, use the subject id as the param , while nav_page has an assoc array value, keep looping -->
                    <?php while ($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
                        <li class="<?php if ($nav_page['id'] == $page_id) {
                                                echo "selected";
                                            }; ?>">

                            <a href="<?php echo url_for('index.php?id=' . u($nav_page['id'])); ?>">
                                <?php echo ht($nav_page['page_name']); ?>
                            </a>

                        </li>
                    <?php } // while $nav_pages 
                        ?>
                </ul>
            </li>
        <?php } // while $nav_subjects 
        ?>
        <?php mysqli_free_result($nav_pages); ?>
    </ul>
    <?php mysqli_free_result($nav_subjects); ?>
</nav>