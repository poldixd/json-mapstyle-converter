# poldixd/json-mapstyle-converter

Converts JSON Style Schemes for Google Maps to Styles for Google Static Maps.

From this:

```json
[
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]
```

To this:

```
&style=element:geometry|color:0x212121&style=element:labels.icon|visibility:off
```

You can use JSON Style Schemes from [snazzymaps.com](https://snazzymaps.com/) or [mapstyle.withgoogle.com](https://mapstyle.withgoogle.com/).

I converted this [JavaScript Tool](http://jsfiddle.net/s6Dyp/18/) to a PHP Class.

## Usage

```php
$converter = new poldixd\JsonMapstyleConverter\JsonMapstyleConverter();

echo $converter->convert('[{"elementType": "geometry", "stylers": [ { "color": "#212121"}]},{"elementType": "labels.icon","stylers": [ {"visibility": "off"}]}]');

// &style=element:geometry|color:0x212121&style=element:labels.icon|visibility:off
```