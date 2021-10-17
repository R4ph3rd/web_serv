<?php
    include('./classes/Blog/Table/Article.php');

    include('./components/Header.php');

    // include('./classes/DB.php');

    $articles = $blog->query('SELECT * FROM articles', 'Blog\Table\Article');

    var_dump($articles);

    echo '<ul>';
    foreach($articles as $article){
        echo '<li class="article">
            <a href="'.$article->url.'"><h3>'.$article->titre.'</h3></a>
            <p>'.$article->content.'</p>
            <span>'.$article->date.'</span>
        </li>
        ';
    }
    echo '</ul>';

    // endforeach;
?>
</body>
</html>