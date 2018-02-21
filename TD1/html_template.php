<?php

function generate_html_page($h1, $title){
    
    $html = "<html>
                <head>
                    <meta charset='utf-8' />
                    <title>$title</title>
                </head>
                <body>
                    <h1>$h1</h1>
                </body>
            </html>";

    echo $html;
}

?>