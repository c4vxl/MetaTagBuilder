<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embed Builder for Discord</title>

    <?php
    /**
     * 
     * @author c4vxl
     * @website https://c4vxl.de/
     * @github https://github.c4vxl.de/
     * 
     * This PHP script allows users to create custom Open Graph or Twitter Cards.
     * It functions by reading the passed URL queries and interpreting them as HTML meta-tags.
     * 
     */

    function generate_meta_tags($query_string) {
        parse_str($query_string, $params);

        $meta_tags = "";

        foreach ($params as $key => $value) {
            // handle edge-cases
            if ($key === "theme-color") $value = "#" . ltrim($value, '#');

            // format key and value so it can be printed out as html
            $key = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // handle additional options for current meta-tag
            $sub_params = explode(";", $value);
            $value = array_shift($sub_params);
            $additional = "";
            foreach ($sub_params as $param) {
                $param = explode("=", $param, 2);
                if (count($param) !== 2) continue;

                list($k, $v) = $param;
                $k = htmlspecialchars($k, ENT_QUOTES, 'UTF-8');
                $v = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');

                $additional .= " $k='$v' ";
            }

            // add current metatag to list
            $meta_tags .= "<meta content='$value' property='$key' $additional />\n";
        }

        return $meta_tags;
    }

    if (!empty($_SERVER['QUERY_STRING'])) {
        $meta_tags = generate_meta_tags($_SERVER['QUERY_STRING']); // generate meta tags from url search params
        echo $meta_tags; // print meta-tags as html
    }
    ?>
</head>

<style>
    body {
        height: 100vh;
        width: 100vw;
        padding: 0;
        margin: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 100;
        display: flex;
        flex-direction: column;
    }
    .page__content {
        flex-grow: 1;
        position: relative;
        overflow-y: scroll;
    }
    .box {
        max-width: 90ch;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
    }
    p {
        word-break: break-all;
    }
    .footer {
        background-color: rgb(61, 62, 63);
        width: 100%;
        text-align: center;
        color: white;
    }
    .footer .links {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }
    .footer a {
        color: white;
        font-weight: bolder;
    }
</style>

<body>
    <!--Log meta tags-->
    <?php
    if (!empty($_SERVER['QUERY_STRING'])) {
        echo "Using the following tags:\n";
        echo nl2br(htmlspecialchars("\n$meta_tags", ENT_QUOTES, 'UTF-8'));
        exit;
    }
    ?>
    <!--End of log-->

    <div class="page__content">
        <div class="box">
            <div>
                <a>This PHP script allows users to create custom <a href="https://ogp.me/">Open Graph</a> or <a href="https://developer.x.com/en/docs/twitter-for-websites/cards/overview/markup">Twitter Cards</a>.</a>
                <br>
                <a>It functions by reading the passed URL queries and interpreting them as HTML meta-tags.</a>
            </div>

            <h1>Usage:</h1>
            <section>
                <p>Every passed URL Query is equivalent to one meta-tag. The Key of the query is being used as the property-Argument of the Meta tag and the value is being used as the content-Argument.</p>
                <div class="example">
                    <p>URL:<br>
                        <code><span class="url"></span><b>?meta1=value&meta2=value2</b></code>
                    </p>
                    <p>Meta Tags:<br>
                        <code>&lt;meta content=&quot;meta1&quot; property=&quot;value1&quot;&gt;&lt;br&gt;&lt;meta content=&quot;meta2&quot; property=&quot;value2&quot; /&gt;</code>
                        <br>
                        <code>&lt;meta content=&quot;meta2&quot; property=&quot;value2&quot;&gt;&lt;br&gt;&lt;meta content=&quot;meta2&quot; property=&quot;value2&quot; /&gt;</code>
                    </p>
                </div>
            </section>

            <br>

            <section>
                <p>The user is also able to add custom properties to the Meta Tag:</p>
                <div class="example">
                    <p>URL:<br>
                        <code><span class="url"></span><b>?meta=value;customKey=customValue;customKey2=customValue2</b></code>
                    </p>
                    <p>Meta Tag:<br>
                        <code>&lt;meta content=&quot;meta&quot; property=&quot;value&quot; customKey=&quot;customValue&quot; customKey2=&quot;customValue2&quot; /&gt;</code>
                    </p>
                </div>
            </section>


            <h1>Format:</h1>

            <p><code><span class="url"></span><b>?tag=value;additionalKey=value2&...</b></code></p>

            <h1>Example:</h1>
            <p></p>
            <p id="example__url"><code><span class="url"></span><b>?title=Test&description=Hey!%20This%20is%20a%20test!&url=https://c4vxl.de/&image=https://info.c4vxl.de/images/icons/c4vxl.png&theme-color=4FD4D8</b></code></p>

            <p><a id="try__example">Click here to try</a></p>
            <p><a href="" id="copy__example">Click here to copy example</a></p>
        </div>
    </div>

    <div class="footer">
        <div>
            <p>For deeper understanding I'd recommend reading the <a href="https://ogp.me/">Open Graph Documentation</a> and the <a href="https://developer.x.com/en/docs/twitter-for-websites/cards/overview/markup">Twitter Cards Documentation</a></p>
        </div>

        <div class="links">
            <p><a href="https://github.com/c4vxl/MetaTagBuilder/">Source Code</a></p>
            <p><a href="https://c4vxl.de/">Developer</a></p>
        </div>
    </div>    

    <script>
        const page_url = `${window.location.protocol}//${window.location.host}/`;
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.url').forEach(element => {
                element.textContent = page_url;
            });
        });

        const example_url = page_url + document.querySelector("#example__url").textContent;

        document.querySelector("#try__example").href = example_url;
        document.querySelector("#copy__example").addEventListener("click", (event) => {
            event.preventDefault();
            navigator.clipboard.write(example_url);
            alert("Example URL Copied.");
        });
    </script>
</body>
</html>
<!--About Page-->