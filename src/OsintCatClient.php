<?php

namespace OsintCat;

use OsintCat\Account\AccountClient;
use OsintCat\Breach\BreachClient;
use OsintCat\Email\EmailClient;
use OsintCat\Phone\PhoneClient;
use OsintCat\Ip\IpClient;
use OsintCat\Dns\DnsClient;
use OsintCat\Minecraft\MinecraftClient;
use OsintCat\Steam\SteamClient;
use OsintCat\Xbox\XboxClient;
use OsintCat\Twitch\TwitchClient;
use OsintCat\Chess\ChessClient;
use OsintCat\Github\GithubClient;
use OsintCat\Reddit\RedditClient;
use OsintCat\X\XClient;
use OsintCat\Tiktok\TiktokClient;
use OsintCat\Instagram\InstagramClient;
use OsintCat\Vin\VinClient;
use OsintCat\Chile\ChileClient;
use OsintCat\MachineViewer\MachineViewerClient;
use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use Exception;

class OsintCatClient
{
    /**
     * @var AccountClient $account
     */
    public AccountClient $account;

    /**
     * @var BreachClient $breach
     */
    public BreachClient $breach;

    /**
     * @var EmailClient $email
     */
    public EmailClient $email;

    /**
     * @var PhoneClient $phone
     */
    public PhoneClient $phone;

    /**
     * @var IpClient $ip
     */
    public IpClient $ip;

    /**
     * @var DnsClient $dns
     */
    public DnsClient $dns;

    /**
     * @var MinecraftClient $minecraft
     */
    public MinecraftClient $minecraft;

    /**
     * @var SteamClient $steam
     */
    public SteamClient $steam;

    /**
     * @var XboxClient $xbox
     */
    public XboxClient $xbox;

    /**
     * @var TwitchClient $twitch
     */
    public TwitchClient $twitch;

    /**
     * @var ChessClient $chess
     */
    public ChessClient $chess;

    /**
     * @var GithubClient $github
     */
    public GithubClient $github;

    /**
     * @var RedditClient $reddit
     */
    public RedditClient $reddit;

    /**
     * @var XClient $x
     */
    public XClient $x;

    /**
     * @var TiktokClient $tiktok
     */
    public TiktokClient $tiktok;

    /**
     * @var InstagramClient $instagram
     */
    public InstagramClient $instagram;

    /**
     * @var VinClient $vin
     */
    public VinClient $vin;

    /**
     * @var ChileClient $chile
     */
    public ChileClient $chile;

    /**
     * @var MachineViewerClient $machineViewer
     */
    public MachineViewerClient $machineViewer;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param ?string $apiKey The apiKey to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        ?string $apiKey = null,
        ?array $options = null,
    ) {
        $apiKey ??= $this->getFromEnvOrThrow('OSINTCAT_API_KEY', 'Please pass in apiKey or set the environment variable OSINTCAT_API_KEY.');
        $defaultHeaders = [
            'X-API-KEY' => $apiKey,
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'OsintCat',
            'User-Agent' => 'osintcat/osintcat/1.0.0',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->account = new AccountClient($this->client, $this->options);
        $this->breach = new BreachClient($this->client, $this->options);
        $this->email = new EmailClient($this->client, $this->options);
        $this->phone = new PhoneClient($this->client, $this->options);
        $this->ip = new IpClient($this->client, $this->options);
        $this->dns = new DnsClient($this->client, $this->options);
        $this->minecraft = new MinecraftClient($this->client, $this->options);
        $this->steam = new SteamClient($this->client, $this->options);
        $this->xbox = new XboxClient($this->client, $this->options);
        $this->twitch = new TwitchClient($this->client, $this->options);
        $this->chess = new ChessClient($this->client, $this->options);
        $this->github = new GithubClient($this->client, $this->options);
        $this->reddit = new RedditClient($this->client, $this->options);
        $this->x = new XClient($this->client, $this->options);
        $this->tiktok = new TiktokClient($this->client, $this->options);
        $this->instagram = new InstagramClient($this->client, $this->options);
        $this->vin = new VinClient($this->client, $this->options);
        $this->chile = new ChileClient($this->client, $this->options);
        $this->machineViewer = new MachineViewerClient($this->client, $this->options);
    }

    /**
     * @param string $env
     * @param string $message
     * @return string
     */
    private function getFromEnvOrThrow(string $env, string $message): string
    {
        $value = getenv($env);
        return $value ? (string) $value : throw new Exception($message);
    }
}
