# OsintCat for PHP

The official SDK for the [OsintCat API](https://docs.osintcat.net). Typed requests and responses for every endpoint. PHP 8.1+.

```sh
composer config repositories.osintcat vcs https://github.com/OsintCatHQ/osintcat-php
composer require osintcat/osintcat-php guzzlehttp/guzzle
```

The first line is needed until the SDK is listed on Packagist. The SDK sends requests through any PSR-18
HTTP client; Guzzle is one.

## API key

Create a key under [Account > Developer](https://www.osintcat.net/account/developer). A key is shown once; you choose its scopes and when it
expires. Keep it on the server: never ship it in a browser or mobile app.

The SDK reads the key from the `OSINTCAT_API_KEY` environment variable when you do not pass one, and sends it
in the `X-API-KEY` header.

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use OsintCat\OsintCatClient;
use OsintCat\Breach\Requests\SearchBreachRequest;
use OsintCat\Github\Requests\ProfileGithubRequest;

$client = new OsintCatClient(); // reads OSINTCAT_API_KEY; or new OsintCatClient(apiKey: 'cat_...')

$account = $client->account->get();
echo $account->accountInfo?->plan, PHP_EOL;

$breach = $client->breach->search(new SearchBreachRequest(['query' => 'user@example.com']));
echo $breach->resultsCount, PHP_EOL;

$profile = $client->github->profile(new ProfileGithubRequest(['username' => 'octocat']));
if ($profile->taken) {
    echo $profile->extraData?->name, PHP_EOL;
}
```

## Methods

| Method | Endpoint | What it does |
| --- | --- | --- |
| `$client->account->get()` | [`GET /api/user`](https://docs.osintcat.net/api-reference/endpoint/user) | Account |
| `$client->account->modules()` | [`GET /api/modules`](https://docs.osintcat.net/api-reference/endpoint/modules) | Modules |
| `$client->breach->search()` | [`GET /api/breach`](https://docs.osintcat.net/api-reference/endpoint/breach) | Breach Lookup |
| `$client->breach->databaseSearch()` | [`GET /api/database-search`](https://docs.osintcat.net/api-reference/endpoint/database-search) | Database Search |
| `$client->breach->domain()` | [`GET /api/domain`](https://docs.osintcat.net/api-reference/endpoint/domain) | Domain Lookup |
| `$client->email->lookup()` | [`GET /api/email-osint`](https://docs.osintcat.net/api-reference/endpoint/email-osint) | Email OSINT |
| `$client->phone->lookup()` | [`GET /api/phone-osint`](https://docs.osintcat.net/api-reference/endpoint/phone-osint) | Phone OSINT |
| `$client->ip->lookup()` | [`GET /api/ip`](https://docs.osintcat.net/api-reference/endpoint/ip) | IP Lookup |
| `$client->dns->resolve()` | [`GET /api/dns-resolver`](https://docs.osintcat.net/api-reference/endpoint/dns-resolver) | DNS Resolver |
| `$client->minecraft->player()` | [`GET /api/minecraft`](https://docs.osintcat.net/api-reference/endpoint/minecraft) | Minecraft Player |
| `$client->minecraft->leaks()` | [`GET /api/minecraft-lookup`](https://docs.osintcat.net/api-reference/endpoint/minecraft-osint) | Minecraft Leak Search |
| `$client->minecraft->profile()` | [`GET /api/minecraft-lookup-v2`](https://docs.osintcat.net/api-reference/endpoint/minecraft-profile) | Minecraft Profile |
| `$client->steam->profile()` | [`GET /api/steam-lookup`](https://docs.osintcat.net/api-reference/endpoint/steam) | Steam Profile |
| `$client->xbox->profile()` | [`GET /api/xbox-lookup`](https://docs.osintcat.net/api-reference/endpoint/xbox) | Xbox Profile |
| `$client->twitch->profile()` | [`GET /api/twitch`](https://docs.osintcat.net/api-reference/endpoint/twitch) | Twitch Profile |
| `$client->chess->lookup()` | [`GET /api/chess-osint`](https://docs.osintcat.net/api-reference/endpoint/chess) | Chess.com Lookup |
| `$client->github->profile()` | [`GET /api/github-lookup`](https://docs.osintcat.net/api-reference/endpoint/github) | GitHub Profile |
| `$client->reddit->profile()` | [`GET /api/reddit`](https://docs.osintcat.net/api-reference/endpoint/reddit) | Reddit Profile |
| `$client->x->profile()` | [`GET /api/twitter-osint`](https://docs.osintcat.net/api-reference/endpoint/twitter) | X (Twitter) Profile |
| `$client->tiktok->resolveShareLink()` | [`GET /api/tiktok-resolver`](https://docs.osintcat.net/api-reference/endpoint/tiktok-resolver) | TikTok Share Link |
| `$client->instagram->resolveShareLink()` | [`GET /api/instagram-resolver`](https://docs.osintcat.net/api-reference/endpoint/instagram-resolver) | Instagram Share Link |
| `$client->vin->query()` | [`GET /api/vin`](https://docs.osintcat.net/api-reference/endpoint/vin) | VIN Decoder |
| `$client->chile->person()` | [`GET /api/chilean-name`](https://docs.osintcat.net/api-reference/endpoint/chilean-name) | Chilean Person Search |
| `$client->chile->vehicle()` | [`GET /api/chilean-car`](https://docs.osintcat.net/api-reference/endpoint/chilean-car) | Chilean Vehicle Search |
| `$client->machineViewer->stats()` | [`GET /api/machine_viewer/stats`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Machine Viewer statistics |
| `$client->machineViewer->search()` | [`GET /api/machine_viewer/search`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Search machines |
| `$client->machineViewer->machine()` | [`GET /api/machine_viewer/machines/{machine_id}/info`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Machine details |
| `$client->machineViewer->files()` | [`GET /api/machine_viewer/machines/{machine_id}/files/treeview`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Machine files |
| `$client->machineViewer->file()` | [`GET /api/machine_viewer/files/{file_id}/info`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | File content |
| `$client->machineViewer->downloadFile()` | [`GET /api/machine_viewer/files/{file_id}/download`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Download a file |
| `$client->machineViewer->downloadMachine()` | [`GET /api/machine_viewer/machines/{machine_id}/download`](https://docs.osintcat.net/api-reference/endpoint/machine-viewer) | Download a machine |

## Errors

Any answer other than 2xx throws `OsintCat\Exceptions\OsintcatApiException`, with the status code and the
body the API answered with.

```php
use OsintCat\Exceptions\OsintcatApiException;

try {
    $client->breach->search(new SearchBreachRequest(['query' => 'user@example.com']));
} catch (OsintcatApiException $e) {
    echo $e->getCode(), ' ', json_encode($e->getBody()), PHP_EOL;
}
```

| Status | Meaning |
| --- | --- |
| 400 | The request is not valid (a missing or wrong parameter). |
| 401 | No API key, or an unknown one. |
| 402 | Your balance does not cover the lookup. |
| 403 | The key was revoked or has expired, lacks the scope, is used from an address it is not allowed from, or your plan does not include the module. |
| 404 | Nothing was found. |
| 429 | The daily allowance is used up (`LIMIT_REACHED`, resets at 00:00 UTC), or too many requests in a short time. |
| 424 | The lookup could not be completed: a data source failed or was too slow (`X-Upstream-Status` says which). |

Every error body carries `error` and usually `message`; some add `error_id` (quote it to support) or `code`.

## Retries

The SDK does not retry on its own. A lookup that is retried after a timeout may already have been counted
or charged, and a `429 LIMIT_REACHED` cannot succeed before the allowance resets at 00:00 UTC. Retry
yourself where it is safe for you.

## Timeouts

The SDK sets no timeout of its own. Set one for every call when you create the client, or for one call:

```php
$client = new OsintCatClient(options: ['timeout' => 60]);
$client->breach->search(new SearchBreachRequest(['query' => 'user@example.com']), ['timeout' => 120]);
```

Source code: [github.com/OsintCatHQ/osintcat-php](https://github.com/OsintCatHQ/osintcat-php). Issues are welcome there.

## Links

- [API documentation](https://docs.osintcat.net)
- [Create an API key](https://www.osintcat.net/account/developer)
- [Full method reference](./reference.md)

## License

MIT
