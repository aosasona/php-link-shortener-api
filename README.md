# LINK SHORTENER

This is a simple PHP API (no framework) that allows you to shorten links.

## Requirements

- PHP 7.0+
- MySQL
- Composer

## Run

To get started, you need to install all dependencies (only dotenv).

```bash
composer install
```

Then you need to create a .env file like the one in the sample

To serve this, API use the following command:

```bash
composer start
```

By default the API will run on port 17000.

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
  "ok": true,
  "message": "Short URL created successfully",
  "data": {
    "ref": "3Lkuv",
    "short_url": "http://localhost:17000/s/3Lkuv",
    "original_url": "https://google.com"
  }
}
```

---

- `GET` - `/view` or `/`: Get all links

**SAMPLE REQUEST**

```
http://localhost:17000/view
```

**SAMPLE RESPONSE**

```json
{
  "ok": true,
  "message": "5 urls found",
  "data": [
    {
      "ref": "UHZKz",
      "short_url": "http://localhost:17000/s/UHZKz",
      "original_url": "https://google.com",
      "created_at": "2022-06-18 23:13:59"
    },
    {
      "ref": "TTDAI",
      "short_url": "http://localhost:17000/s/TTDAI",
      "original_url": "https://google.com",
      "created_at": "2022-06-18 23:20:37"
    },
    {
      "ref": "c2ySY",
      "short_url": "http://localhost:17000/s/c2ySY",
      "original_url": "https://google.com",
      "created_at": "2022-06-18 23:24:33"
    }
  ]
}
```

---

- `GET` - `/view/:ref`: Get ONE link

**SAMPLE REQUEST**

```
http://localhost:17000/view/3Lkuv
```

**SAMPLE RESPONSE**

```json
{
  "ok": true,
  "message": "Short URL fetched!",
  "data": {
    "custom_ref": "3Lkuv",
    "short_url": "http://localhost:17000/s/3Lkuv",
    "original_url": "https://google.com",
    "created_at": "2022-06-18 23:27:51"
  }
}
```

Have Fun! And sorry if you find typos or punctuation errors, was in a bit of a hurry.
