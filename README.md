# PHP LINK SHORTENER

This is a simple PHP API that allows you to shorten links.

## Requirements

- PHP 7.0+
- MySQL
- Composer

## Run

To serve this API use the following command:

```bash
composer run start --timeout 0
```

By default the API will run on port 17000, you can also run it without the --timeout flag.

## Endpoints

- `POST` - `/create`: Shorten a link

**SAMPLE REQUEST**

```json
{
  "url": "https://www.google.com"
}
```

**SAMPLE RESPONSE**

```json
{
  "url": "https://www.google.com",
  "short": "http://localhost:17000/s/xB0yj"
}
```
