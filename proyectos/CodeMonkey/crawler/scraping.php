<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Crawling Test | Hackatour 2017 Cancún</title>
    </head>
    <body>
        <h1>Búsqueda de etiquetas HTML e imágenes en un sitio Web</h1>
        <form action="scraping.php" method="POST">
            <input name="url" placeholder="Ingrese su URL" />
            <input name="tag" placeholder="Ingrese la etiqueta HTML" />
            <input type="submit" name="submit" value="Buscar"/>
            <a href="/crawler/scraping.php">Recargar</a>
            <a href="/crawler/crawling.php">Cambiar</a>
        </form>
        <br>

        <?php

        require 'simple_html_dom.php';

        function main ($url, $tag)
        {
            $html = new simple_html_dom();
            $html->load_file($url);

            $titles = $html->find($tag);
            $images = $html->find('img');

            foreach ($titles as $title)
                echo $title->innertext;

            foreach ($images as $image)
                echo '<img src="' . $image->attr['src'] . '" alt="">';
        }

        if (isset($_POST['submit']))
        {
            $url = $_POST['url'];
            $tag = $_POST['tag'];

            if($url == '' OR $tag == '')
                echo "<h2>Ingrese datos válidos</h2>";
            else
            {
                echo "Resultados de búsqueda:";
                main($url, $tag);
            }
        }
        ?>
    </body>
</html>
