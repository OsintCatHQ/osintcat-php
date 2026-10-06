# Reference
## Account
<details><summary><code>$client-&gt;account-&gt;get() -> ?UserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the account the API key belongs to: plan, plan expiry, and how many lookups are left today.

Does not count as a lookup.

Needs the `account:read` scope (keys with all scopes have it).

Errors:
- 401 `API key required`: No `X-API-KEY` header.
- 403 `Invalid API key`: The key does not exist or was revoked.
- 403 `insufficient_scope`: The key lacks the `account:read` scope.

Docs: https://docs.osintcat.net/api-reference/endpoint/user
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->account->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;account-&gt;modules() -> ?ModulesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists every module with its current state and whether your account can use it. Use it to check access before calling a lookup: a lookup for a module your plan does not include is refused with `403 ACCESS_DENIED`.

Does not count as a lookup.

Needs the `osint:read` scope.

Errors:
- 401 `Unauthorized`: Missing or unknown key.

Docs: https://docs.osintcat.net/api-reference/endpoint/modules
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->account->modules();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Breach
<details><summary><code>$client-&gt;breach-&gt;search($request) -> ?BreachResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches the breach indexes (including Snusbase, LeakCheck and IntelX) for a value and returns every matching record. The search is case-insensitive.

Results for the same query may come from a cache for up to two days.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/breach
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->breach->search(
    new SearchBreachRequest([
        'query' => 'user@example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — What to search for: an e-mail address, username, domain, phone number, IP address, name or password.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;breach-&gt;databaseSearch($request) -> ?DatabaseSearchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches stealer-log and combo-list collections for an e-mail address or a domain.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 424 `Upstream error`: The search backend answered with an error. Not charged.
- 424 `timeout error`: The search backend did not answer in time. Not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/database-search
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->breach->databaseSearch(
    new DatabaseSearchBreachRequest([
        'query' => 'user@example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The e-mail address or domain.
    
</dd>
</dl>

<dl>
<dd>

**$queryType:** `?string` — `email` or `domain`. Detected from `query` when left out.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;breach-&gt;domain($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns breach records whose e-mail addresses or URLs belong to a domain.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests are refused with `429 LIMIT_REACHED` until it resets at 00:00 UTC.

Errors:
- 404 `No results found`: Nothing was found for the domain.
- 424 `Upstream error`: The search could not be completed; the response carries an `error_id`.

Docs: https://docs.osintcat.net/api-reference/endpoint/domain
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->breach->domain(
    new DomainBreachRequest([
        'query' => 'example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The domain, e.g. `example.com`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Email
<details><summary><code>$client-&gt;email-&gt;lookup($request) -> ?EmailOsintResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Checks which websites and services an e-mail address is registered with and in which breaches it appears. Every request must state its purpose.

A request without a purpose (parameter `purpose`, header `X-Purpose`, or `Purpose: ...` at the end of your User-Agent) is refused with `400 USER_AGENT_IDENTITY_REQUIRED`.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `USER_AGENT_IDENTITY_REQUIRED`: No purpose given.
- 401 `API key required`: No `X-API-KEY` header.
- 402 `INSUFFICIENT_BALANCE`: The allowance is used up and your balance does not cover the lookup.
- 424 `Provider Error`: The lookup could not be completed. Not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/email-osint
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->email->lookup(
    new LookupEmailRequest([
        'query' => 'user@example.com',
        'purpose' => 'fraud prevention',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The e-mail address (`email` is accepted as well).
    
</dd>
</dl>

<dl>
<dd>

**$purpose:** `string` — Why you run the lookup, e.g. `fraud prevention`. Required unless sent as a header (below).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Phone
<details><summary><code>$client-&gt;phone-&gt;lookup($request) -> ?PhoneOsintResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns what is known about a phone number: whether it is valid, the carrier and line type, the country, linked online accounts and a risk score.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `phone_*`: The number cannot be a valid phone number; `code` says why (e.g. `phone_too_short`).
- 424 `Upstream provider error`: The lookup could not be completed.
- 424 `The request timed out.`: The lookup took too long.

Docs: https://docs.osintcat.net/api-reference/endpoint/phone-osint
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->phone->lookup(
    new LookupPhoneRequest([
        'query' => '+4915112345678',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The phone number in international format, e.g. `+4915112345678`. Spaces and dashes are allowed.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Ip
<details><summary><code>$client-&gt;ip-&gt;lookup($request) -> ?IpResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns what is known about an IP address: open ports and services seen on it, hostnames, and its location and network.

Results for the same address may come from a cache for up to two days.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/ip
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->ip->lookup(
    new LookupIpRequest([
        'query' => '8.8.8.8',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — An IPv4 or IPv6 address.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Dns
<details><summary><code>$client-&gt;dns-&gt;resolve($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resolves one or more hostnames to their IP addresses.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/dns-resolver
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dns->resolve(
    new ResolveDnsRequest([
        'query' => 'example.com,osintcat.net',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — A hostname, or several separated by commas.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Minecraft
<details><summary><code>$client-&gt;minecraft-&gt;player($request) -> ?MinecraftResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Combines the Minecraft profile of a player (UUID, name history, capes, skins) with records about them found in Minecraft server leaks.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/minecraft
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->minecraft->player(
    new PlayerMinecraftRequest([
        'query' => 'Notch',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — A Minecraft username (or the value matching `type`).
    
</dd>
</dl>

<dl>
<dd>

**$queryType:** `?string` — What `query` is for the leak search: `username` (default), `uuid`, `email` or `ip`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;minecraft-&gt;leaks($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches Minecraft server leaks for one value. Use [Minecraft Player](https://docs.osintcat.net/api-reference/endpoint/minecraft) for a profile plus leaks in one call.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `invalid query type`: `type` is missing or not one of the allowed values; `allowed_types` lists them.
- 424 `Upstream returned an empty response`: The search could not be completed; the response carries an `error_id`.

Docs: https://docs.osintcat.net/api-reference/endpoint/minecraft-osint
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->minecraft->leaks(
    new LeaksMinecraftRequest([
        'query' => 'Notch',
        'queryType' => LeaksMinecraftRequestType::Username->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The value to search for.
    
</dd>
</dl>

<dl>
<dd>

**$queryType:** `string` — One of `username`, `uuid`, `email`, `ip`, `password`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;minecraft-&gt;profile($request) -> ?MinecraftProfileResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a Minecraft account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/minecraft-profile
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->minecraft->profile(
    new ProfileMinecraftRequest([
        'username' => 'Notch',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The Minecraft username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Steam
<details><summary><code>$client-&gt;steam-&gt;profile($request) -> ?SteamResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a Steam account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/steam
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->steam->profile(
    new ProfileSteamRequest([
        'username' => 'gaben',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The Steam username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Xbox
<details><summary><code>$client-&gt;xbox-&gt;profile($request) -> ?XboxResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a Xbox account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/xbox
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->xbox->profile(
    new ProfileXboxRequest([
        'username' => 'Major Nelson',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The Xbox username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Twitch
<details><summary><code>$client-&gt;twitch-&gt;profile($request) -> ?TwitchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a Twitch account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/twitch
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->twitch->profile(
    new ProfileTwitchRequest([
        'username' => 'xqc',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The Twitch username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Chess
<details><summary><code>$client-&gt;chess-&gt;lookup($request) -> ?ChessResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the Chess.com profile of a player (ratings, clubs) and any records about the account found in the Chess.com leak.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/chess
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chess->lookup(
    new LookupChessRequest([
        'query' => 'hikaru',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — A Chess.com username or an e-mail address.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Github
<details><summary><code>$client-&gt;github-&gt;profile($request) -> ?GithubResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a GitHub account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/github
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->github->profile(
    new ProfileGithubRequest([
        'username' => 'octocat',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The GitHub username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Reddit
<details><summary><code>$client-&gt;reddit-&gt;profile($request) -> ?RedditResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Look up a Reddit account by its username and get the public profile.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Missing username parameter`: No `username` given.

Docs: https://docs.osintcat.net/api-reference/endpoint/reddit
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->reddit->profile(
    new ProfileRedditRequest([
        'username' => 'unidan',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$username:** `string` — The Reddit username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## X
<details><summary><code>$client-&gt;x-&gt;profile($request) -> ?TwitterResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the public profile of an X (Twitter) account and an automated, best-effort summary of its recent public posts (topics, language, tone, posting pattern). Treat the summary as unverified.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 404 `User '...' not found on X (Twitter).`: No account with that username. Not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/twitter
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->x->profile(
    new ProfileXRequest([
        'query' => 'jack',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The X username, with or without `@`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tiktok
<details><summary><code>$client-&gt;tiktok-&gt;resolveShareLink($request) -> ?TiktokResolverResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resolves a TikTok share link (e.g. `https://vm.tiktok.com/...`) to the account that shared it, with share details and the video.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Provide a valid TikTok short link via ?link=...`: No link, or not a TikTok link.
- 404 `No user found for this link`: The link carries no sharer.
- 424 `Could not resolve link`: The link could not be resolved right now.

Docs: https://docs.osintcat.net/api-reference/endpoint/tiktok-resolver
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tiktok->resolveShareLink(
    new ResolveShareLinkTiktokRequest([
        'link' => 'https://vm.tiktok.com/ZMexample/',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$link:** `string` — A TikTok share link. `url` or `query` are accepted as well.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Instagram
<details><summary><code>$client-&gt;instagram-&gt;resolveShareLink($request) -> ?InstagramResolverResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resolves an Instagram post or reel share link to the account that shared it and the author of the post. Profile links cannot be resolved.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `Provide a valid Instagram URL via ?link=...`: No link, not an Instagram link, or the link expired or points to a private post. Not charged.
- 422 `profile_link`: A profile link: only post and reel share links can be resolved. Not charged.
- 424 `(message)`: The link could not be resolved right now. Not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/instagram-resolver
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->instagram->resolveShareLink(
    new ResolveShareLinkInstagramRequest([
        'link' => 'https://www.instagram.com/reel/Cexample/?igsh=MWexample',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$link:** `string` — An Instagram post or reel share link (with its `igsh` parameter). `url` or `query` are accepted as well.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Vin
<details><summary><code>$client-&gt;vin-&gt;query($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Decodes vehicle identification numbers and answers catalogue questions (makes, models, manufacturers, vehicle variables). Choose what to do with `type`.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.

Errors:
- 400 `query parameter is required`: `query` missing where the chosen type needs it.
- 400 `Maximum 50 VINs allowed`: `batch` with more than 50 VINs.
- 400 `Invalid query type / Invalid search_type`: Unknown `type` or `search_type`.

Docs: https://docs.osintcat.net/api-reference/endpoint/vin
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->vin->query(
    new QueryVinRequest([
        'query' => '1HGCM82633A004352',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$operation:** `?string` — `decode` (default), `batch`, `wmi`, `makes`, `manufacturers`, `variables` or `canadian`.
    
</dd>
</dl>

<dl>
<dd>

**$query:** `?string` — The VIN (`decode`), VINs separated by new lines, up to 50 (`batch`), a WMI (`wmi`), or the make / manufacturer / variable name the chosen `search_type` needs. Not needed for `makes`+`all`, `manufacturers`+`all`/`parts`, `variables`+`list` and `canadian`.
    
</dd>
</dl>

<dl>
<dd>

**$modelYear:** `?float` — `decode`: model year, improves accuracy.
    
</dd>
</dl>

<dl>
<dd>

**$extended:** `?bool` — `decode`: `true` for the extended field set.
    
</dd>
</dl>

<dl>
<dd>

**$searchType:** `?string` — `makes`: `all`, `manufacturer`, `vehicletype`, `models`, `vehicletypes`. `manufacturers`: `all`, `details`, `wmis`, `parts`. `variables`: `list`, `values`.
    
</dd>
</dl>

<dl>
<dd>

**$year:** `?float` — `makes` with `manufacturer`/`models`, and `canadian`: model year.
    
</dd>
</dl>

<dl>
<dd>

**$vehicleType:** `?string` — `makes`+`models` and `manufacturers`+`wmis`: vehicle type filter.
    
</dd>
</dl>

<dl>
<dd>

**$mfrType:** `?string` — `manufacturers`+`all`: manufacturer type filter.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?float` — `manufacturers`+`all`/`parts`: page number.
    
</dd>
</dl>

<dl>
<dd>

**$partsType:** `?string` — `manufacturers`+`parts`: CFR part, default `565`.
    
</dd>
</dl>

<dl>
<dd>

**$fromDate:** `?string` — `manufacturers`+`parts`: start date (required there).
    
</dd>
</dl>

<dl>
<dd>

**$toDate:** `?string` — `manufacturers`+`parts`: end date (required there).
    
</dd>
</dl>

<dl>
<dd>

**$make:** `?string` — `canadian`: make.
    
</dd>
</dl>

<dl>
<dd>

**$model:** `?string` — `canadian`: model.
    
</dd>
</dl>

<dl>
<dd>

**$units:** `?string` — `canadian`: `Metric` (default) or `US`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Chile
<details><summary><code>$client-&gt;chile-&gt;person($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches Chilean public records for people by name.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests are refused with `429 LIMIT_REACHED` until it resets at 00:00 UTC.

Docs: https://docs.osintcat.net/api-reference/endpoint/chilean-name
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chile->person(
    new PersonChileRequest([
        'query' => 'Juan Perez',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — A full or partial name.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;chile-&gt;vehicle($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches Chilean vehicle records by licence plate.

Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests are refused with `429 LIMIT_REACHED` until it resets at 00:00 UTC.

Docs: https://docs.osintcat.net/api-reference/endpoint/chilean-car
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chile->vehicle(
    new VehicleChileRequest([
        'query' => 'ABCD12',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The licence plate.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## MachineViewer
<details><summary><code>$client-&gt;machineViewer-&gt;stats() -> ?MachineViewerStats</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

How many machines, files, passwords, tokens, cookies and payment cards the Machine Viewer holds.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->stats();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;search($request) -> ?MachineSearchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches machines by name, username, hostname or machine ID.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->search(
    new SearchMachineViewerRequest([
        'query' => 'DESKTOP',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — What to search for: a name, username, hostname or machine ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;machine($machineId) -> ?MachineInfoResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

One machine, with the e-mail addresses and tokens found on it.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->machine(
    '742e1f66-f449-4a6c-80d5-8f5eb8e9c2b5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$machineId:** `string` — Machine ID (a UUID), from `machineViewer.search`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;files($machineId) -> ?MachineFilesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Every file of a machine, with its path and size. Use a file's `id` with `machineViewer.file`.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->files(
    '742e1f66-f449-4a6c-80d5-8f5eb8e9c2b5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$machineId:** `string` — Machine ID (a UUID), from `machineViewer.search`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;file($fileId) -> ?MachineFileResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

One file, with its content as text.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->file(
    'aB3dE5fG7hI9jK1lM3nO',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fileId:** `string` — File ID, from `machineViewer.files`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;downloadFile($fileId) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

The file itself, as it was in the log.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->downloadFile(
    'file_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fileId:** `string` — File ID, from `machineViewer.files`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;machineViewer-&gt;downloadMachine($machineId) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Every file of a machine in one ZIP archive.

Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.

Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->machineViewer->downloadMachine(
    'machine_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$machineId:** `string` — Machine ID (a UUID), from `machineViewer.search`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

