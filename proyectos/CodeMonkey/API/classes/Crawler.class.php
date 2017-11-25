<?php
namespace Hackaton\classes;

class Crawler
{
    private $crud;
    private $params;
    private $response;

    public function __construct( $crud, $params )
    {
        error_reporting(0);
        $this->crud = $crud;
        $this->params = $params;

        $this->proccess();
    }

    public function proccess()
    {
        include("simple_html_dom.php");

        $crawled_urls = [];
        $found_urls = [];

        function rel2abs($rel, $base)
        {
            if (parse_url($rel, PHP_URL_SCHEME) != '')
                return $rel;

            if ($rel[0] == '#' || $rel[0] == '?')
                return $base . $rel;

            extract(parse_url($base));

            $path = preg_replace('#/[^/]*$#', '', $path);

            if ( $rel[0] == '/' )
                $path = '';

            $abs = "$host$path/$rel";

            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');

            for($n = 1; $n > 0; $abs = preg_replace($re,'/', $abs,-1,$n))
            {

            }

            $abs = str_replace("../", "", $abs);

            return $scheme . '://' . $abs;
        }


        function perfect_url($u, $b)
        {
            $bp = parse_url($b);

            if (($bp['path'] != "/" && $bp['path'] != "") || $bp['path'] == '')
            {
                if ($bp['scheme'] == "")
                    $scheme = "http";
                else
                    $scheme = $bp['scheme'];

                $b = $scheme . "://" . $bp['host'] . "/";
            }

            if (substr($u, 0, 2) == "//")
                $u = "http:" . $u;

            if (substr($u, 0, 4) != "http")
                $u = rel2abs($u, $b);

            return $u;
        }

        function crawl_site($u)
        {
            global $crawled_urls;
            global $found_urls;

            $uen = urlencode($u);

            print_r($crawled_urls);

            if ((array_key_exists($uen, $crawled_urls) == 0 || $crawled_urls[$uen] < date("YmdHis", strtotime('-25 seconds', time()))))
            {
                $html = file_get_html($u);
                $crawled_urls[$uen] = date("YmdHis");

                $_tmp = [];

                foreach($html->find("a") as $li)
                {
                    $url = perfect_url($li->href, $u);
                    $enurl = urlencode($url);

                    if ($url != '' && substr($url, 0, 4) != "mail" && substr($url, 0, 4) != "java" && array_key_exists($enurl, $found_urls) == 0)
                    {
                        $found_urls[$enurl] = 1;
                        // echo "<li><a target='_blank' href='" . $url . "'>" . $url . "</a></li>";
                        $_tmp[] = $url;
                    }
                }

                return $_tmp;
            }
        }

        function main ($url, $tag)
        {
            $html = new \simple_html_dom();
            $html->load_file($url);
            $_tmp = [];

            $titles = $html->find($tag);
            // $images = $html->find('img');

            foreach ($titles as $title)
                $_tmp[] = $title->innertext;

            return $_tmp;

            // foreach ($images as $image)
            //     echo '<img src="' . $image->attr['src'] . '" alt="">';
        }

        if (isset($this->params))
        {
            $url = 'https://' . $this->params[0] . '/';

            if ( !empty($url) )
            {
                $this->response['uri'] = crawl_site($url);

                if ( isset($this->params[1]) )
                    $this->response['tag_'.$this->params[1]] = main($url, $this->params[1]);
            }
        }
    }

    public function response()
    {
        return $this->response;
    }
}
