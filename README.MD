# MetaTagBuilder

MetaTagBuilder is a PHP script that allows users to create custom Open Graph or Twitter Cards by passing URL queries. It functions by interpreting the passed URL queries as HTML meta-tags.

## Usage

Every passed URL query is equivalent to one meta-tag. The key of the query is used as the `property` attribute of the meta tag, and the value is used as the `content` attribute.



```html
URL:
https://your-domain.com/?meta1=value1&meta2=value2

Meta Tags:
<meta content="value1" property="meta1">
<meta content="value2" property="meta2">
```

The user can create redirects on the website using the `redir` parameter:
```html
URL:
https://your-domain.com/?meta1=value1&redir=https://c4vxl.de/

Meta Tags:
<meta content="value1" property="meta1">
<meta http-equiv="refresh" content="0; url='https://c4vxl.de/'">
```
<br>

_**Note:** To debug a url with a redir parameter set, add `&debug` to the url:_

```
https://your-domain.com/?meta1=value1&debug&redir=https://c4vxl.de/
```

#### Custom Properties Example
The user can also add custom properties to the meta tag by separating them with a semicolon (`;`) after the value.

URL:
```
https://your-domain.com/?meta=value;customKey=customValue;customKey2=customValue2
```
Meta Tag:
```html
<meta content="value" property="meta" customKey="customValue" customKey2="customValue2">
```

Format:
The format for passing URL queries is as follows:
```
https://your-domain.com/?tag=value;additionalKey=value2&...
```

### Example
An example URL with meta tags:
```
https://your-domain.com/?title=Test&description=Hey!%20This%20is%20a%20test!&url=https://example.com/&image=https://example.com/image.jpg&theme-color=4FD4D8
```

### Installation
1. clone this Repository (```git clone https://github.com/c4vxl/MetaTagBuilder.git```)
2. Upload the `index.php` file to your server.
3. Visit the script URL with the desired meta tag parameters.

### Additional Resources
For a deeper understanding, I recommend reading the official documentation for [Open Graph](https://ogp.me/) and [Twitter Cards](https://developer.x.com/en/docs/twitter-for-websites/cards/overview/markup).

## License

This project is licensed under [Apache 2.0](LICENSE).

---

## Developer
This Project was Developed by [c4vxl](https://c4vxl.de)

<br><br>

_**Note**: In case you are wondering why I am using PHP instead of just a static webpage, it's because platforms like Discord's link embedding system do not allow query parameters on static webpages. Using PHP allows for dynamic generation of meta tags based on the passed URL queries, enabling users to customize Open Graph or Twitter Cards dynamically._
